<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Damoon\Blog\Models\Blog>
 */
class BlogFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 3),
            'title' => fake()->title,
            'description' => fake()->text,
            'body' => fake()->realTextBetween(200, 250),
            'meta_title' => fake()->title,
            'meta_description' => fake()->text(100),
            'confirmed' => [null, false, true][mt_rand(0, 2)],
        ];
    }
}
