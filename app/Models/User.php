<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Item;
use App\Models\Orders;
use App\Models\FoodItem;
use App\Models\Sales_reports;
use App\Models\Trend_reports;
use App\Models\Inventory_reports;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Transaction_reports;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relation to orders
    public function orders(){
        return $this->hasMany(Orders::class, 'user_id');
    }
    public function food_item(){
        return $this->hasMany(FoodItem::class, 'user_id');
    }
    public function item(){
        return $this->hasMany(Item::class, 'user_id');
    }
    public function transaction_report(){
        return $this->hasMany(Transaction_reports::class, 'user_id');
    }
    public function inventory_report(){
        return $this->hasMany(Inventory_reports::class, 'user_id');
    }
    public function sales_report(){
        return $this->hasMany(Sales_reports::class, 'user_id');
    }
    public function trend_report(){
        return $this->hasMany(Trend_reports::class, 'user_id');
    }
}
