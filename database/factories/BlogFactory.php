<?php

namespace Database\Factories;

use App\Models\blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "users_id" => User::all()->random()->id,
            "title" => $this->faker->sentence(random_int(3,5)),
            "body" => $this->faker->text(1000)
        ];
    }
}

