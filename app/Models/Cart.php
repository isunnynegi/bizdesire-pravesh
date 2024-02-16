<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'subtotal',
        'tax',
        'disount',
        'total'
    ];

    function cartItems(){
        return $this->hasMany(CartDetail::class, 'cart_id');
    }
}
