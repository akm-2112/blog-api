<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $categories = Category::all();
        $tags = Tag::all();

        Post::factory(50)->create()->each(function ($post) use ($categories,$tags){
            $post->category()->attach($categories->random(1)->first()->id);
            $post->tag()->attach($tags->random(rand(2,4))->pluck('id')->toArray());
        });

    }
}
