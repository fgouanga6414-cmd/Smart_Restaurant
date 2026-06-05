<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';

    protected $fillable = [
        'Food_name',
        'Food_detail',
        'Food_price',
        'time',
        'image',
        'category',
        'ingredients', // JSON array ["farine","oeufs","lait"]
    ];

    protected $casts = ['ingredients' => 'array'];
}