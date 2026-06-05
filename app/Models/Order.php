<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'daily_number', 'status', 'type',
        'subtotal', 'tax', 'service_fee', 'discount_used', 'total',
        'loyalty_points_earned', 'notes',
        'preparation_started_at', 'estimated_prep_minutes',
    ];

    protected $casts = [
        'preparation_started_at' => 'datetime',
    ];

    /* ── Relations ── */
    public function user()   { return $this->belongsTo(User::class); }
    public function items()  { return $this->hasMany(OrderItem::class); }
    public function review() { return $this->hasOne(Review::class); }

    /* ── Accesseurs ── */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'En attente',
            'confirmed' => 'Confirmée',
            'preparing' => 'En préparation',
            'ready'     => 'Prête !',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
            default     => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'   => '#f59e0b',
            'confirmed' => '#3b82f6',
            'preparing' => '#C8956C',
            'ready'     => '#10b981',
            'delivered' => '#6b7280',
            'cancelled' => '#ef4444',
            default     => '#6b7280',
        };
    }

    public function getRemainingMinutesAttribute(): int
    {
        if (!$this->preparation_started_at || $this->status === 'ready') return 0;
        $elapsed = now()->diffInMinutes($this->preparation_started_at);
        return max(0, ($this->estimated_prep_minutes ?? 20) - $elapsed);
    }

    public function getProgressPercentAttribute(): int
    {
        $mins = $this->estimated_prep_minutes ?? 0;
        if (!$this->preparation_started_at || $mins === 0) return 0;
        $elapsed = now()->diffInMinutes($this->preparation_started_at);
        return min(100, (int)(($elapsed / $mins) * 100));
    }
}