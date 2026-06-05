<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'required|string|min:1|max:1000',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Seul le propriétaire peut laisser un avis
        abort_if($order->user_id !== Auth::id(), 403);

        // Une seule review par commande
        if ($order->review) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez deja laisse un avis pour cette commande.',
            ], 422);
        }

        Review::create([
            'user_id'  => Auth::id(),
            'order_id' => $request->order_id,
            'name'     => Auth::user()->name,   // pour le carousel public
            'rating'   => $request->rating,
            'comment'  => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre avis !',
        ]);
    }
}