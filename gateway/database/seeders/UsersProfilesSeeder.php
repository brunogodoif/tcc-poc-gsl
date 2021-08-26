<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $profile = DB::table('users.profiles')->whereDescription('Administrador')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "Administrador",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $profile = DB::table('users.profiles')->whereDescription('BackOffice')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "BackOffice",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ]);
        }

        $profile = DB::table('users.profiles')->whereDescription('Clientes')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "Clientes",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ]);
        }

        $profile = DB::table('users.profiles')->whereDescription('Fornecedores')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "Fornecedores",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ]);
        }

        $profile = DB::table('users.profiles')->whereDescription('Colaboradores')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "Colaboradores",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ]);
        }

        $profile = DB::table('users.profiles')->whereDescription('App Client')->get();
        if ($profile->isEmpty()) {
            DB::table('users.profiles')->insert([
                'description' => "App Client",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ]);
        }
    }
}
