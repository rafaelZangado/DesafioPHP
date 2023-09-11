<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        //Add grupo Admin
        \App\Models\User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(123456),
                'nivel' => 1,
        ]);      
    }  
}
