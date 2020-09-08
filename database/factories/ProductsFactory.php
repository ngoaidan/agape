<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    $categories = \App\Models\Category::get('id')->toArray();

    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'details' => $faker->name,
        'price' => $faker->numberBetween(10000, 10000000),
        'description' => $faker->text,
        'image' => $faker->randomElement(['posts/post1.jpg', 'posts/post2.jpg', 'posts/post3.jpg', 'posts/post4.jpg']),
//        'images' => $faker->randomElement(['posts/post1.jpg', 'posts/post2.jpg', 'posts/post3.jpg', 'posts/post4.jpg']),
        'images' => "['posts/post1.jpg', 'posts/post2.jpg', 'posts/post3.jpg', 'posts/post4.jpg']",
        'category_id' => $categories[array_rand($categories)]['id'],
        'status' => $faker->randomElement(['PUBLISHED', 'DRAFT', 'PENDING']),
        'featured' => (bool)random_int(0, 1),
    ];
});
