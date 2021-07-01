<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(100)->create()->each(function(Post $post){

            // Por cada post que se genere, se generara 4 etiquetas
            Image::factory(4)->create([
                'imageable_id' => $post->id,
                'imageable_type' => Post::class
            ]);

            // Relacion de muchos a muchos con los tags usando el metodo attach
            $post->tags()->attach([
                rand(1, 4),
                rand(5, 8)
            ]);

        });
    }
}
