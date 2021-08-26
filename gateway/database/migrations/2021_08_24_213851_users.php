<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users.users', function (Blueprint $table) {
            $table->integer('id', true, false)->signed();
            $table->string('name', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255)->unique();
            $table->integer('profile_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users.users');
    }
}
