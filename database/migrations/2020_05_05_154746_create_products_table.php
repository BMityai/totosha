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
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('cost_price');
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('discount_price')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('art_no')->nullable();
            $table->integer('count');
            $table->integer('sales_count')->default(0);
            $table->text('description');
            $table->boolean('recommended')->default(false);
            $table->boolean('new')->default(true);
            $table->boolean('coming_soon')->default(false);
            $table->boolean('is_active')->default(true);
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
