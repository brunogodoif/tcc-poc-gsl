<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight.shipping_weight', function (Blueprint $table) {
            $table->integer('id', true, false)->signed();
            $table->integer('distance_initial');
            $table->integer('distance_final');
            $table->decimal('prince_ton', 16, 2);
            $table->decimal('above_200', 16, 2);
            $table->decimal('between_151_200', 16, 2);
            $table->decimal('between_101_150', 16, 2);
            $table->decimal('between_71_100', 16, 2);
            $table->decimal('between_51_70', 16, 2);
            $table->decimal('between_31_50', 16, 2);
            $table->decimal('between_21_30', 16, 2);
            $table->decimal('between_11_20', 16, 2);
            $table->decimal('between_1_10', 16, 2);
            $table->decimal('percentage_shipping_value', 2, 2);
            $table->integer('deadline');
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
        Schema::dropIfExists('public.shipping_weight');
    }
}
