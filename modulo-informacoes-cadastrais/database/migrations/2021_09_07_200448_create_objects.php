<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects.objects', function (Blueprint $table) {
            $table->integer('id', true, false)->signed();
            $table->string('tracking_code', 60)->unique();
            $table->string('localization_source');
            $table->string('localization_destiny');
            $table->decimal('total_invoice', 16, 2);
            $table->integer('weight');
            $table->decimal('shipping_cost', 16, 2);
            $table->date('dispatch_date');
            $table->integer('deadline_in_days');
            $table->date('expected_delivery_date');
            $table->string('type_transport');
            $table->string('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects.objects');
    }
}
