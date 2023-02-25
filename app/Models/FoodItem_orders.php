<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem_orders extends Model
{
    use HasFactory;

    protected $table = 'food_item_orders';
    protected $fillable = ['food_item_id','order_id', 'quantity'];
}
