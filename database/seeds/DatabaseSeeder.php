<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class, 7)->create();
        factory(Post::class, 25)->create();
        factory(Comment::class, 50)->create();

        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'level' => 2
        ]);
        $post = Post::create([
            'slug' => 'test-post-slug',
            'title' => 'Test Post Slug',
            'summary' => 'Just a test post.',
            'content' => 'Text post with some content <br /> looking for errors',
            'is_featured' => true,
            'published_at' => now(),
            'user_id' => $user->id
        ]);

    }
}
