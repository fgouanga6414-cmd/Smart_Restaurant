<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

/* ══ Page d'accueil publique ══ */
Route::get('/', [UserController::class, 'index']);

/* ══ Routes authentifiées (client + employé + admin) ══ */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    /* Dashboard (redirige selon usertype dans UserController::home) */
    Route::get('/dashboard', [UserController::class, 'home'])->name('dashboard');

    /* Commandes — client passe une commande depuis le dashboard */
    Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');

    /* Statut d'une commande (polling) */
    Route::get('/order/status/{order}', [OrderController::class, 'status'])->name('order.status');

    /* Avis client */
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
});

/* ══ Commandes depuis la page d'accueil (peut être invité) ══ */
Route::post('/commandes', [OrderController::class, 'store'])->name('order.store');

/* ══ Admin ══ */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/addFood',          [AdminController::class, 'addFood'])->name('admin.addFood');
    Route::post('/addFood',         [AdminController::class, 'postAddFood'])->name('admin.postAddFood');
    Route::get('/showFood',         [AdminController::class, 'showFood'])->name('admin.showFood');
    Route::get('/deleteFood/{id}',  [AdminController::class, 'deleteFood'])->name('admin.deleteFood');
    Route::get('/editFood/{id}',    [AdminController::class, 'editFood'])->name('admin.editFood');
    Route::post('/editFood/{id}',   [AdminController::class, 'posteditFood'])->name('admin.posteditFood');
    Route::get('/admin/dashboard',                    [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/employe/{user}/role',         [AdminController::class, 'updateEmployeRole'])->name('admin.updateEmployeRole');
    Route::get('/admin/employe/{user}/delete',        [AdminController::class, 'deleteEmploye'])->name('admin.deleteEmploye');
    Route::post('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
});

/* ══ Employé ══ */
Route::middleware(['auth'])->group(function () {
    Route::get('/employe/dashboard',          [EmployeController::class, 'dashboard'])->name('employe.dashboard');
    Route::post('/employe/addFood',           [EmployeController::class, 'addFood'])->name('employe.addFood');
    Route::post('/employe/updateFood/{id}',   [EmployeController::class, 'updateFood'])->name('employe.updateFood');
    Route::get('/employe/deleteFood/{id}',    [EmployeController::class, 'deleteFood'])->name('employe.deleteFood');
    Route::post('/employe/item/{id}/prepared', [EmployeController::class, 'markItemPrepared']);
    
    /* Mise à jour statut commande */
    Route::post('/orders/{order}/status',     [EmployeController::class, 'updateOrderStatus'])->name('updateOrderStatus');

    /* Marquer prête */
    Route::post('/employee/order/{order}/ready', [OrderController::class, 'markReady'])->name('order.ready');
});