<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poss', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('product_name')->nullable();
            $table->integer('product_qty')->nullable();
            $table->double('product_price', 20, 2)->nullable();
            $table->double('sub_total', 20, 2)->nullable();
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
        Schema::dropIfExists('poss');
    }
}
