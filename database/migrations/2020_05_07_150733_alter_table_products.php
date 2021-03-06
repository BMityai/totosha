<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('note')->nullable()->after('sales_count');
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('depth')->nullable();
            $table->string('material_id')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->string('age_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('depth');
            $table->dropColumn('material');
            $table->dropColumn('manufacturer');
            $table->dropColumn('age');
        });
    }
}
