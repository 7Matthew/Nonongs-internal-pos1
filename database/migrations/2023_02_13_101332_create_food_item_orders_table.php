<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_item_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orders_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('food_item_id')->constrained('food_items')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('item_price')->nullable()->defualt(0);
            $table->decimal('quantity')->nullable()->defualt(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_item_orders');
    }
};
