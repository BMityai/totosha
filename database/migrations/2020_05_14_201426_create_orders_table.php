<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('user_id')->nullable();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('phone');
            $table->string('mail');
            $table->integer('region_id');
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('street');
            $table->string('building')->nullable();
            $table->string('apartment')->nullable();
            $table->integer('delivery_type_id');
            $table->integer('payment_form_id');
            $table->text('comment')->nullable();
            $table->integer('order_status_id')->default(1);
            $table->integer('received_bonus')->nullable();
            $table->integer('spent_bonus')->nullable();
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
