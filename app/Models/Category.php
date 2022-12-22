<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];


    public function foodItem()
    {
        return $this->hasMany(FoodItem::class, 'category_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
