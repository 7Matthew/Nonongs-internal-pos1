<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpiredItem extends Model
{
    use HasFactory;

    protected $table = 'expired_items';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
