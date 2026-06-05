<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatuses extends Command
{
    protected $signature   = 'orders:update-statuses';
    protected $description = 'Change automatiquement le statut des commandes';

    public function handle(): void
    {
        $now = now();

        $orders = Order::whereNotIn('status', ['delivered', 'cancelled', 'ready'])
                       ->get();

        foreach ($orders as $order) {
            $elapsed = $order->created_at->diffInSeconds($now); // ✅ secondes
            $current = $order->status;
            $new     = $current;
            $upd     = [];

            // pending → confirmed après 40 secondes
            if ($current === 'pending' && $elapsed >= 40) {
                $new = 'confirmed';
            }

            // confirmed → preparing après 80 secondes (40+40)
            if ($current === 'confirmed' && $elapsed >= 80) {
                $new = 'preparing';
            }

            if ($new !== $current) {
                $upd['status'] = $new;
                if ($new === 'preparing' && !$order->preparation_started_at) {
                    $upd['preparation_started_at'] = $now;
                    // recalcule le temps estimé depuis les items
                    $maxPrep = $order->items->sum(fn($i) => $i->time ?? 15); // ✅ somme
                    if (!$maxPrep) $maxPrep = 15;
                    $upd['estimated_prep_minutes'] = $maxPrep;
                }
                $order->update($upd);
                $this->info("Commande #{$order->id} : {$current} → {$new}");
            }
        }

        $this->info('Terminé.');
    }
}