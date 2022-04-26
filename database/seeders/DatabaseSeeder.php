<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
        $user = User::factory()->create([
            'name' => 'Meredith Odell',
            'username' => 'mkodell',
            'email' => 'meredith.odell@sourcetoad.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatars/MeredithAvatar.jpg',
        ]);

        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'username' => 'janed',
            'email' => 'janedoe@example.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatars/JaneAvatar.jpeg',
        ]);

        $category = Category::factory()->create([
            'name' => 'Work',
            'slug' => 'work',
        ]);

        $category = Category::factory()->create([
            'name' => 'Home',
            'slug' => 'home',
        ]);

        $category = Category::factory()->create([
            'name' => 'Hobby',
            'slug' => 'hobby',
        ]);

        $post = Post::factory()->create([
            'user_id' => '1',
            'category_id' => '1',
            'slug' => 'test-1',
            'title' => 'Test #1',
            'thumbnail' => 'thumbnails/background.jpeg',
            'excerpt' => 'This is the first factory generated post',
            'body' => 'This is the first factory generated post since adding the thumbnail and status feature.',
            'status' => 'draft'
        ]);

        $post = Post::factory()->create([
            'user_id' => '2',
            'category_id' => '2',
            'slug' => 'test-2',
            'title' => 'Test #2',
            'thumbnail' => 'thumbnails/screenshot.png',
            'excerpt' => 'This is the second factory generated post',
            'body' => 'This is the second factory generated post since adding the thumbnail and status feature.',
            'status' => 'published'
        ]);
    }
}
