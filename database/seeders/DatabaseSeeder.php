<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TruckSeeder::class);
        $this->call(RoleSeeder::class);
        DB::table('users')->insert(['role_id'=>1,'email'=>'admin@gmail.com','password'=>Hash::make('admin'),'name'=>'admin']);
         \App\Models\User::factory(10)->create();
        $this->call(OrderSeeder::class);
//
    }
}
