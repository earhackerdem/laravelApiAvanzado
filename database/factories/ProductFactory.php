<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(10_000,60_000),
            'category_id' => function () {
                return Category::query()->inRandomOrder()->first()->id;
            },
            'created_by' => function () {
                return User::query()->inRandomOrder()->first()->id;
            },
        ];
    }
}
