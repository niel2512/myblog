<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Method call untuk memanggil kelas seeder tambahan
        $this->call([
            CategorySeeder::class, 
            UserSeeder::class, 
            PostSeeder::class
        ]);

        // Post::factory(30)->recycle([
            // Category::factory(3)->create(),
            // Category::all(),
            // User::factory(5)->create()
            // User::all()
        // ])->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
