<?php

namespace Database\Factories;

use Damoon\Blog\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Damoon\Blog\Models\Blog>
 */
class BlogFactory extends Factory
{
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        $this->model = Blog::class;

        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
    }

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
