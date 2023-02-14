<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $primaryKey='id';

    //relationship to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function food_item()
    {
        return $this->belongsToMany(FoodItem::class);
    }
}
