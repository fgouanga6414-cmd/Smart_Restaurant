<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard client — passe au dashboard employé si role = 'employe'.
     */
    public function index()
    {
        $user = Auth::user();

        /* Redirection vers le dashboard employé si applicable */
        if ($user->role === 'employe' || $user->role === 'admin') {
            return redirect()->route('employe.dashboard');
        }

        /* ── Fidélité ── */
        $pts      = $user->loyalty_points ?? 0;
        $badge    = $user->loyalty_badge  ?? 'Nouveau';
        $nextPts  = $user->next_level_points ?? 50;
        $spent    = $user->total_spent ?? 0;
        $discount = floor($pts / 10) * 20;

        /* ── Commande active (la plus récente non livrée ni annulée) ── */
        $activeOrder = Order::where('user_id', $user->id)
            ->whereNotIn('status', ['delivered', 'cancelled'])
            ->with('items.food')
            ->latest()
            ->first();

        if ($activeOrder) {
            $steps   = ['pending','confirmed','preparing','ready','delivered'];
            $idx     = array_search($activeOrder->status, $steps) ?: 0;
            $activeOrder->progress_percent  = (int) round(($idx / (count($steps) - 1)) * 100);
            $activeOrder->remaining_minutes = max(0, (count($steps) - 1 - $idx) * 10);

            $labels = [
                'pending'   => 'En attente',
                'confirmed' => 'Confirmee',
                'preparing' => 'En preparation',
                'ready'     => 'Prete',
                'delivered' => 'Livree',
                'cancelled' => 'Annulee',
            ];
            $activeOrder->status_label = $labels[$activeOrder->status] ?? $activeOrder->status;
        }

        /* ── Historique (toutes les commandes) ── */
        $orderHistory = Order::where('user_id', $user->id)
            ->with(['items.food', 'review'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($order) {
                $labels = [
                    'pending'   => 'En attente',
                    'confirmed' => 'Confirmee',
                    'preparing' => 'En preparation',
                    'ready'     => 'Prete',
                    'delivered' => 'Livree',
                    'cancelled' => 'Annulee',
                ];
                $order->status_label = $labels[$order->status] ?? $order->status;
                return $order;
            });

        /* ── Avis laissés ── */
        $reviewHistory = Review::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        /* ── Liste des plats (pour la section Commander du dashboard) ── */
        $foods = Food::all();

        return view('dashboard', compact(
            'user',
            'pts',
            'badge',
            'nextPts',
            'spent',
            'discount',
            'activeOrder',
            'orderHistory',
            'reviewHistory',
            'foods'
        ));
    }
}