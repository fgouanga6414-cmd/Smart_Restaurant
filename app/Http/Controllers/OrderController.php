<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store order from homepage (anonymous users)
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'        => 'required|in:dine_in,take_away,delivery',
            'items'       => 'required|array|min:1',
            'items.*.id'  => 'required|integer',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $today      = now()->toDateString();
            $lastOrder  = Order::whereDate('created_at', $today)->orderBy('daily_number', 'desc')->first();
            $dailyNumber = $lastOrder ? $lastOrder->daily_number + 1 : 1;

            $total   = 0;
            $maxPrep = 0; // ✅ temps total de la commande

            foreach ($request->items as $item) {
                $food     = Food::find($item['id']);
                $prepTime = $food ? ($food->prep_time ?? 15) : 15;
                $total   += $item['price'] * $item['qty'];
                $maxPrep += $prepTime * $item['qty']; 
            }

            $order = Order::create([
                'daily_number'           => $dailyNumber,
                'type'                   => $request->type,
                'total'                  => $total,
                'status'                 => 'pending',
                'user_id'                => null,
                'estimated_prep_minutes' => $maxPrep, // ✅ sauvegardé
            ]);

            foreach ($request->items as $item) {
                $food     = Food::find($item['id']);
                $prepTime = $food ? ($food->prep_time ?? 15) : 15;
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id'  => $item['id'],
                    'quantity' => $item['qty'],
                    'price'    => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                    'time'     => $prepTime, // ✅ colonne correcte
                ]);
            }

            DB::commit();

            return response()->json([
                'success'      => true,
                'message'      => 'Commande créée avec succès',
                'order_number' => $dailyNumber,
                'order_id'     => $order->id,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Place order from authenticated user dashboard
     */
    public function place(Request $request)
    {
        $request->validate([
            'type'              => 'required|in:dine_in,take_away,delivery',
            'items'             => 'required|array|min:1',
            'items.*.food_id'   => 'required|integer',
            'items.*.quantity'  => 'required|integer|min:1',
            'discount_used'     => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $user         = auth()->user();
            $discountUsed = $request->discount_used ?? 0;

            $total      = 0;
            $maxPrep    = 0; // ✅ temps total de la commande
            $orderItems = [];

            foreach ($request->items as $item) {
                $food = Food::find($item['food_id']);
                if ($food) {
                    $prepTime  = $food->prep_time ?? 15;
                    $subtotal  = $food->Food_price * $item['quantity'];
                    $total    += $subtotal;
                    $maxPrep  += $prepTime * $item['quantity'];
                    $orderItems[] = [
                        'food_id'  => $item['food_id'],
                        'quantity' => $item['quantity'],
                        'price'    => $food->Food_price,
                        'subtotal' => $subtotal,
                        'time'     => $prepTime, // ✅ colonne correcte
                    ];
                }
            }

            $finalTotal = max(0, $total - $discountUsed);

            $today       = now()->toDateString();
            $lastOrder   = Order::whereDate('created_at', $today)->orderBy('daily_number', 'desc')->first();
            $dailyNumber = $lastOrder ? $lastOrder->daily_number + 1 : 1;

            $order = Order::create([
                'daily_number'           => $dailyNumber,
                'type'                   => $request->type,
                'total'                  => $finalTotal,
                'original_total'         => $total,
                'discount_used'          => $discountUsed,
                'status'                 => 'pending',
                'user_id'                => $user->id,
                'estimated_prep_minutes' => $maxPrep, // ✅ sauvegardé
            ]);

            foreach ($orderItems as $item) {
                OrderItem::create(array_merge($item, ['order_id' => $order->id]));
            }

            // Points de fidélité
            $pointsEarned = floor($finalTotal / 50);
            $user->increment('loyalty_points', $pointsEarned);
            $user->increment('total_spent', $finalTotal);
            $this->updateLoyaltyBadge($user);

            DB::commit();

            return response()->json([
                'success'      => true,
                'message'      => 'Commande #' . $dailyNumber . ' créée ! +' . $pointsEarned . ' points',
                'order_number' => $dailyNumber,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Suivi en temps réel — appelé par le polling JS toutes les 10s
     * Change aussi le statut automatiquement selon le temps écoulé
     */
    public function status(Order $order)
    {
        $now     = now();
        $elapsed = $order->created_at->diffInSeconds($now);
        $current = $order->status;
        $new     = $current;

        // pending → confirmed après 40 secondes
        if ($current === 'pending' && $elapsed >= 40) {
            $new = 'confirmed';
        }

        // confirmed → preparing après 80 secondes (40+40)
        if ($current === 'confirmed' && $elapsed >= 80) {
            $new = 'preparing';
        }

        // ⛔ ready ne se change JAMAIS automatiquement

        if ($new !== $current) {
            $upd = ['status' => $new];
            if ($new === 'preparing' && !$order->preparation_started_at) {
                $upd['preparation_started_at'] = $now;
                // ✅ utilise estimated_prep_minutes déjà sauvegardé à la création
                // si manquant, recalcule depuis les items avec la bonne colonne 'time'
                if (!$order->estimated_prep_minutes) {
                    $upd['estimated_prep_minutes'] = $order->items->sum(fn($i) => $i->time ?? 15) ?: 15;
                }
            }
            $order->update($upd);
            $order->refresh();
        }

        // Calcul progression et temps restant
        $progressPercent  = 0;
        $remainingSeconds = 0;

        if ($order->status === 'preparing' && $order->preparation_started_at) {
            $totalSecs        = ($order->estimated_prep_minutes ?? 15) * 60;
            $prepElapsed      = (int)$order->preparation_started_at->diffInSeconds($now);
            $remainingSeconds = max(0, $totalSecs - $prepElapsed); // ✅ réduit avec le temps
            $ratio            = $totalSecs > 0 ? min(1, $prepElapsed / $totalSecs) : 0;
            $progressPercent  = (int)($ratio * 100);

        } elseif ($order->status === 'confirmed') {
            $remainingSeconds = max(0, 80 - $elapsed);
            $progressPercent  = 25;

        } elseif ($order->status === 'pending') {
            $remainingSeconds = max(0, 40 - $elapsed);
            $progressPercent  = 5;

        } elseif ($order->status === 'ready') {
            $progressPercent  = 100;
            $remainingSeconds = 0;
        }

        return response()->json([
            'status'            => $order->status,
            'status_label'      => $order->status_label,
            'status_color'      => $order->status_color,
            'progress_percent'  => min(99, $progressPercent),
            'remaining_seconds' => (int)$remainingSeconds,
            'remaining_minutes' => (int)ceil($remainingSeconds / 60),
            'nearly_ready'      => ($order->status === 'preparing' && $progressPercent >= 85),
        ]);
    }

    /**
     * Ancienne méthode getStatus — gardée pour compatibilité
     */
    public function getStatus(Order $order)
    {
        return $this->status($order);
    }

    private function updateLoyaltyBadge($user)
    {
        $points = $user->loyalty_points;
        if ($points >= 500)      $badge = 'Gold';
        elseif ($points >= 200)  $badge = 'Silver';
        elseif ($points >= 50)   $badge = 'Bronze';
        else                     $badge = 'Nouveau';

        $user->loyalty_badge = $badge;
        $user->save();
    }
}