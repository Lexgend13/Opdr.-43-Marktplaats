<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Article;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bidding>
 */
class BiddingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->first()->id,
            'article_id' => Article::where('id', '!=', 1)->inRandomOrder()->first()->id
        ];
    }
}
