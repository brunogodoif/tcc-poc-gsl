<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects.objects_tracking', function (Blueprint $table) {
            $table->integer('id', true, false)->signed();
            $table->string('tracking_code', 60);
            $table->string('localization_current_address');
            $table->string('localization_current_lat_long');
            $table->date('date');
            $table->time('time');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects.objects_tracking');
    }
}
