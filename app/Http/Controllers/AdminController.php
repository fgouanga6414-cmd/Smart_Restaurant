<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    const CATEGORIES = [
        'Burgers', 'Pizza', 'Desserts', 'Boissons',
        'Café', 'Jus', 'Pâtes', 'Salades', 'Sandwichs', 'Autres'
    ];

    public function dashboard()
    {
        $foods  = Food::latest()->get();
        $orders = Order::with(['items.food', 'user'])->orderByDesc('created_at')->get();
        $users  = User::where('usertype', 'employe')->orderByDesc('created_at')->get();

        // ── Statistiques générales ──
        $totalOrders    = Order::count();
        $totalRevenue   = Order::where('status', 'delivered')->sum('total');
        $todayOrders    = Order::whereDate('created_at', today())->count();
        $todayRevenue   = Order::whereDate('created_at', today())->where('status', 'delivered')->sum('total');
        $pendingOrders  = Order::whereIn('status', ['pending', 'confirmed', 'preparing'])->count();
        $totalEmployes  = User::where('usertype', 'employe')->count();
        $totalClients   = User::where('usertype', 'client')->count();
        $totalFoods     = Food::count();

        // ── Items les plus commandés ──
        $topFoods = DB::table('order_items')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->select('food.Food_name', 'food.image', 'food.category', DB::raw('SUM(order_items.quantity) as total_qty'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->groupBy('food.id', 'food.Food_name', 'food.image', 'food.category')
            ->orderByDesc('total_qty')
            ->limit(8)
            ->get();

        // ── Ventes par jour (7 derniers jours) ──
        $salesByDay = Order::where('status', 'delivered')
            ->where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, SUM(total) as revenue, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ── Ventes par mois (12 derniers mois) ──
        $salesByMonth = Order::where('status', 'delivered')
            ->where('created_at', '>=', now()->subMonths(12))
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as revenue, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')->orderBy('month')
            ->get();


            $monthLabels = $salesByMonth->map(function($m) {
                return $m->year . '-' . str_pad($m->month, 2, '0', STR_PAD_LEFT);
            })->values();
        // ── Commandes par statut ──
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        return view('admin.dashboard', compact(
            'foods', 'orders', 'users',
            'totalOrders', 'totalRevenue', 'todayOrders', 'todayRevenue',
            'pendingOrders', 'totalEmployes', 'totalClients', 'totalFoods',
            'topFoods', 'salesByDay', 'salesByMonth', 'ordersByStatus', 'monthLabels'
        ));
    }

    // ── MENU ──
    public function addFood() { return view('admin.addFood'); }

    public function postAddFood(Request $request)
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

        return redirect()->back()->with('success', 'Plat ajouté avec succès !');
    }

    public function showFood()
    {
        $foods = Food::latest()->get();
        return view('admin.showFood', compact('foods'));
    }

    public function deleteFood($id)
    {
        Food::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Plat supprimé.');
    }

    public function editFood($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.editFood', compact('food'));
    }

    public function posteditFood(Request $request, $id)
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
        return redirect()->back()->with('success', 'Plat modifié avec succès !');
    }

    // ── EMPLOYÉS ──
    public function updateEmployeRole(Request $request, User $user)
    {
        $request->validate(['usertype' => 'required|in:employe,client,admin']);
        $user->update(['usertype' => $request->usertype]);
        return response()->json(['success' => true, 'message' => 'Rôle mis à jour.']);
    }

    public function deleteEmploye(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Compte supprimé.');
    }

    private function parseIngredients(?string $raw): ?array
    {
        if (!$raw || trim($raw) === '') return null;
        return array_values(array_filter(
            array_map(fn($s) => strtolower(trim($s)), explode(',', $raw))
        ));
    }
    public function changePassword(Request $request)
{
    $request->validate([
        'current_password'      => 'required',
        'password'              => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!\Hash::check($request->current_password, $user->password)) {
        return response()->json(['success' => false, 'message' => 'Mot de passe actuel incorrect.']);
    }

    $user->update(['password' => \Hash::make($request->password)]);

    return response()->json(['success' => true, 'message' => 'Mot de passe mis à jour !']);
}
}