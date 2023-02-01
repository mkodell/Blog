<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
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
        ]);

        $category = Category::factory()->create([
            'name' => 'Life',
        ]);

        $category = Category::factory()->create([
            'name' => 'Hobby',
        ]);

        $post = Post::factory()->create([
            'user_id' => '1',
            'category_id' => '1',
            'title' => 'Test 1',
            'thumbnail' => 'thumbnails/background.jpeg',
            'excerpt' => 'This is the first factory generated post',
            'body' => 'This is the first factory generated post since adding the thumbnail and status feature.',
            'status' => 'draft',
            'created_at' => now(),
            'updated' => NULL,
            'published_at' => NULL,
        ]);

        $post = Post::factory()->create([
            'user_id' => '2',
            'category_id' => '2',
            'title' => 'Test 2',
            'thumbnail' => 'thumbnails/screenshot.png',
            'excerpt' => 'This is the second factory generated post',
            'body' => 'This is the second factory generated post since adding the thumbnail and status feature.',
            'status' => 'published',
            'published_at' => now()->subHour(1),
            'created_at' => now()->subHour(1),
            'updated' => NULL,
        ]);

        $comment = Comment::factory()->create([
            'post_id' => '2',
            'user_id' => '2',
            'body' => 'Hello, hello, hello, everyone!',
            'created_at' => now()->subMinutes(55),
            'posted' => now()->subMinutes(55),
        ]);

        $comment = Comment::factory()->create([
            'post_id' => '2',
            'user_id' => '1',
            'body' => 'Hello, janed! I\'m a huge fan!',
            'created_at' => now()->subMinutes(50),
            'posted' => now()->subMinutes(50),
            'updated' => now(),
        ]);
    }
}
