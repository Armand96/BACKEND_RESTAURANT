<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('item_id', 7);
            $table->string('item_name', 50)->default('');
            $table->string('item_img_name', 75)->default('');
            $table->string('menu_id', 20)->default('');
            $table->integer('price', false, true)->default(0);
            $table->boolean('show')->default(true);
            $table->boolean('out_of_stock')->default(false);
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
        Schema::dropIfExists('items');
    }
}
