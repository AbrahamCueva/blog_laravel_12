<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abraham',
            'email' => 'ricoabraham879@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        Category::factory(5)->create();
        Post::factory(150)->create();
        Tag::factory(10)->create();
    }
}
