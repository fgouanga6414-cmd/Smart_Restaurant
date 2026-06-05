<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;

class EmployeController extends Controller
{
    const CATEGORIES = [
        'Burgers', 'Pizza', 'Desserts', 'Boissons',
        'Café', 'Jus', 'Pâtes', 'Salades', 'Sandwichs', 'Autres'
    ];

    public function dashboard()
    {
        $foods  = Food::latest()->get();
        $orders = Order::with(['items.food', 'user'])
            ->orderByDesc('created_at')
            ->get();

        // Commandes actives groupées par catégorie pour la section cuisine
        $activeOrders = Order::with(['items.food'])
            ->whereIn('status', ['pending', 'confirmed', 'preparing'])
            ->orderByDesc('created_at')
            ->get();

        // Items actifs groupés par catégorie
        $itemsByCategory = [];
        foreach (self::CATEGORIES as $cat) {
            $items = [];
            foreach ($activeOrders as $order) {
                foreach ($order->items as $item) {
                    if ($item->food && $item->food->category === $cat) {
                        $items[] = [
                            'order_id'     => $order->id,
                            'daily_number' => $order->daily_number,
                            'food_name'    => $item->food->Food_name,
                            'quantity'     => $item->quantity,
                            'item_id'      => $item->id,
                            'prepared'     => (bool)$item->prepared,
                            'status'       => $order->status,
                            'status_label' => $order->status_label,
                            'status_color' => $order->status_color,
                        ];
                    }
                }
            }
            if (count($items) > 0) {
                $itemsByCategory[$cat] = $items;
            }
        }

        return view('employe.dashboard', compact('foods', 'orders', 'activeOrders', 'itemsByCategory'));
    }

    public function addFood(Request $request)
    {
        $request->validate([
            'Food_name'   => 'required|string|max:255',
            'Food_detail' => 'nullable|string',
            'Food_price'  => 'required|numeric|min:0',
            'prep_time'   => 'nullable|integer|min:1|max:180',
            'category'    => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('food_img'), $imageName);
        }

        Food::create([
            'Food_name'   => $request->Food_name,
            'Food_detail' => $request->Food_detail,
            'Food_price'  => $request->Food_price,
            'prep_time'   => $request->prep_time ?? 15,
            'category'    => $request->category ?? 'Autres',
            'ingredients' => $this->parseIngredients($request->ingredients),
            'image'       => $imageName,
        ]);

        return back()->with('success', 'Plat ajoute avec succes !');
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'Food_name'   => 'required|string|max:255',
            'Food_detail' => 'nullable|string',
            'Food_price'  => 'required|numeric|min:0',
            'prep_time'   => 'nullable|integer|min:1|max:180',
            'category'    => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $food = Food::findOrFail($id);
        $food->Food_name   = $request->Food_name;
        $food->Food_detail = $request->Food_detail;
        $food->Food_price  = $request->Food_price;
        $food->prep_time   = $request->prep_time ?? $food->prep_time ?? 15;
        $food->category    = $request->category ?? $food->category ?? 'Autres';
        $food->ingredients = $this->parseIngredients($request->ingredients) ?? $food->ingredients;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('food_img'), $imageName);
            $food->image = $imageName;
        }

        $food->save();
        return response()->json(['success' => true, 'message' => 'Plat modifie avec succes !']);
    }

    public function deleteFood($id)
    {
        Food::findOrFail($id)->delete();
        return back()->with('success', 'Plat supprime.');
    }

    public function updateOrderStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
        ]);

        $updateData = ['status' => $request->status];

        if ($request->status === 'preparing' && !$order->preparation_started_at) {
            $totalPrep = $order->items->sum(fn($i) => ($i->time ?? 15) * $i->quantity);
            $updateData['preparation_started_at'] = now();
            $updateData['estimated_prep_minutes'] = $totalPrep ?: 15;
        }

        $order->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis a jour.',
            'status'  => $order->status,
        ]);
    }

    // Marquer un item comme préparé
    public function markItemPrepared(Request $request, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);
        $item->prepared = !$item->prepared; // toggle
        $item->save();

        return response()->json([
            'success'  => true,
            'prepared' => $item->prepared,
        ]);
    }

    private function parseIngredients(?string $raw): ?array
    {
        if (!$raw || trim($raw) === '') return null;
        return array_values(array_filter(
            array_map(fn($s) => strtolower(trim($s)), explode(',', $raw))
        ));
    }
}