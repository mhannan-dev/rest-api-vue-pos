<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->comment('PK on categories table')->constrained();
            $table->foreignId('supplier_id')->comment('PK of suppliers table')->constrained();
            $table->string('title', 255);
            $table->string('code');
            $table->string('root')->nullable();
            $table->double('buying_price', 20, 2);
            $table->double('selling_price', 20, 2);
            $table->date('buying_date')->nullable();
            $table->string('product_image')->nullable();
            $table->string('buying_quantity');
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
        Schema::dropIfExists('products');
    }
}
