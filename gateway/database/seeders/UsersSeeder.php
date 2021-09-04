<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = DB::table('users.users')->whereEmail('brunofgodoi@outlook.com.br')->get();
        if ($user->isEmpty()) {
            DB::table('users.users')->insert([
                'name' => "Bruno Feliciano de Godoi",
                'email' => "brunofgodoi@outlook.com.br",
                'password' =>  Hash::make('101292'),
                'profile_id' => 1,
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $user = DB::table('users.users')->whereEmail('diogooliveiracoelho@gmail.com')->get();
        if ($user->isEmpty()) {
            DB::table('users.users')->insert([
                'name' => "Diogo Oliveira Coelho",
                'email' => "diogooliveiracoelho@gmail.com",
                'password' =>  Hash::make('654321'),
                'profile_id' => 1,
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
