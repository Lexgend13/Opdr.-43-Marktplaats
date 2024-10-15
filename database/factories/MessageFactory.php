<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->first()->id,
            'writer' => User::where('id', '!=', 1)->inRandomOrder()->first()->name,
            'text' => $this->faker->sentences(4, true)
        ];
    }
}
