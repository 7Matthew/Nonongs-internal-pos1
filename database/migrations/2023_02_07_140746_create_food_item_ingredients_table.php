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
        Schema::create('food_item_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained('food_items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('items')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_item_ingredients');
    }
};
