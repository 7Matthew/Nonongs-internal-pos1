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
        Schema::create('food_item_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_item_id')->constrained('food_items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('quantity', 11,2)->unsigned();
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
        Schema::dropIfExists('food_item_item');
    }
};
