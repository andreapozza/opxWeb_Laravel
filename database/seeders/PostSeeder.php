<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(! User::find(1))
        {
            User::factory(1)->create();
        }
        Post::factory(30)->afterCreating(function(Post $post) {
            $post->page()->create(['slug' => $post->title]);
        })->create();
    }
}
