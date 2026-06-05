<?php
// ══════════════════════════════════════════════
// app/Models/OrderItem.php
// ══════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','food_id','quantity','unit_price','subtotal'];

    public function order() { return $this->belongsTo(Order::class); }
    public function food()  { return $this->belongsTo(Food::class); }
}


// ══════════════════════════════════════════════
// app/Models/Review.php
// ══════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id','order_id','rating','comment'];

    public function user()  { return $this->belongsTo(User::class); }
    public function order() { return $this->belongsTo(Order::class); }
}