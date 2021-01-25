<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $isPublished = rand(1, 5) > 1;

    return [
        'category_id'       => rand(1, 11),
        'user_id'           => (rand(1, 5) == 5) ? 1 : 2,
        'title'             => $title,
        'slug'              => Str::slug($title),
        'excerpt'           => $faker->text(rand(100, 150)),
        'content_raw'       => $txt,
        'content_html'      => $txt,
        'is_published'      => $isPublished,
        'published_at'      => $isPublished ? now() : null,
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
