<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Database\Factories\PostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(10)->create();

        /**
         * @var Post $post
         */
        foreach ($posts as $post) {
            $tags = Tag::query()->inRandomOrder()->take(\rand(1,5))->pluck('id');
            $post->tags()->attach($tags);;
        }
    }
}
