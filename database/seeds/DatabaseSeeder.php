<?php

use App\Comment;
use App\Post;
use App\Posttag;
use App\Tag;
use App\User;
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
        // $this->call(UserSeeder::class);
        factory(User::class, 1)->create();
        factory(Tag::class, 7)->create();
        factory(Post::class, 25)->create();
        factory(Posttag::class, 200)->create();
        factory(Comment::class, 50)->create();
    }
}
