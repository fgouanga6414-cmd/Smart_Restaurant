<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Order;
use App\Models\Review;

class UserController extends Controller
{
    public function index()
    {
        $foods   = Food::all();
        $reviews = Review::with('user')->latest()->take(20)->get()
            ->map(function ($r) {
                $r->name = $r->user ? $r->user->name : ($r->name ?? 'Anonyme');
                return $r;
            });
        return view('home', compact('foods', 'reviews'));
    }

    public function home()
    {
        $user = Auth::user();

        if ($user->usertype === 'admin') {
            return app(AdminController::class)->dashboard();
        }

        if ($user->usertype === 'employe') {
            return redirect()->route('employe.dashboard');
        }

        $foods = Food::all();

        // Détection allergènes : foods qui correspondent aux allergènes du client
        $userAllergenes  = $user->allergenes ?? [];
        $allergicFoodIds = [];
        if (!empty($userAllergenes)) {
            foreach ($foods as $food) {
                $ingredients = array_map('strtolower', $food->ingredients ?? []);
                foreach ($userAllergenes as $allergen) {
                    if (in_array(strtolower($allergen), $ingredients)) {
                        $allergicFoodIds[] = $food->id;
                        break;
                    }
                }
            }
        }

        $activeOrder = Order::where('user_id', $user->id)
            ->whereNotIn('status', ['delivered', 'cancelled'])
            ->with('items.food')
            ->latest()
            ->first();

        $orderHistory = Order::where('user_id', $user->id)
            ->with(['items.food', 'review'])
            ->latest()
            ->take(30)
            ->get();

        $reviewHistory = Review::where('user_id', $user->id)
            ->with(['order.items.food'])
            ->latest()
            ->take(20)
            ->get();
           // Calcul des plats allergiques pour ce client
$userAllergenes  = $user->allergenes ?? [];
$allergicFoodIds = [];

if (!empty($userAllergenes)) {
    foreach ($foods as $food) {
        $ingredients = array_map('strtolower', $food->ingredients ?? []);
        foreach ($userAllergenes as $allergen) {
            if (in_array(strtolower($allergen), $ingredients)) {
                $allergicFoodIds[] = $food->id;
                break;
            }
        }
    }
}
        return view('dashboard', compact(
            'user', 'foods', 'activeOrder',
            'orderHistory', 'reviewHistory',
            'allergicFoodIds', 'userAllergenes'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'photo'     => 'nullable|image|max:2048',
            'allergenes'=> 'nullable|string', // CSV "gluten, lactose, noix"
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Parse allergènes CSV → JSON
     if ($request->has('allergenes')) {
    $raw = trim($request->allergenes);
    $data['allergenes'] = $raw === '' ? null : array_values(array_filter(
        array_map(fn($s) => strtolower(trim($s)), explode(',', $raw))
    ));
      }

        // Photo — stockée dans public/avatars/
        if ($request->hasFile('photo')) {
            // Créer le dossier si nécessaire
            if (!file_exists(public_path('avatars'))) {
                mkdir(public_path('avatars'), 0755, true);
            }
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('avatars'), $filename);
            $data['profile_photo_path'] = 'avatars/' . $filename;
        }

        $user->update($data);

        return response()->json([
            'success'  => true,
            'message'  => 'Profil mis a jour.',
            'photoUrl' => $user->profile_photo_path ? asset($user->profile_photo_path) : null,
        ]);
    }
}