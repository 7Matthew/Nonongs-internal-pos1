<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem_ingredients extends Model
{
    use HasFactory;

    protected $table = 'food_item_item';
    protected $fillable = ['food_item_id','item_id', 'quantity'];
}
