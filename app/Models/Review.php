<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'name',
        'rating',
        'comment',
    ];

    public function user()  { return $this->belongsTo(User::class); }
    public function order() { return $this->belongsTo(Order::class); }

    /* Nom à afficher dans le carousel public */
    public function getNameAttribute($value): string
    {
        return $value ?? optional($this->user)->name ?? 'Anonyme';
    }
}