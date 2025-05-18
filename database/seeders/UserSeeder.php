<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // disini untuk membuat user custom 
        User::factory()->create([
            'name'=>'Niel',
            'username'=>'niel1',
            'email'=>'niel@gmail.com',
            'password'=> Hash::make('password123')
            //sisanya diambil dari factory user
        ]);
        // disini untuk menambah 5 user random baru
        User::factory(5)->create();
    }
}
