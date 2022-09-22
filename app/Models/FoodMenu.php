<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table='food_items';
    protected $primaryKey='id';
    protected $fillable = ['name', 'price', 'stocks'];
}
