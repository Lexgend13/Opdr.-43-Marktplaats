<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = Storage::allFiles();
        //$publicPath = Storage::allFiles();

        // Log or output the path
        //Log::info('Public storage path: ' . $publicPath);
        //dd('Public storage path:', $publicPath, '$images: ', $images);

        
        $imagePath = null;
        if (rand(0,1)) {
            $imagePath = $images[array_rand($images)];
        } else {
            $imagePath = 0;
        }
        return [
            'title' => $this->faker->sentence,
            'body' => implode("\n", $this->faker->sentences(40)),
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->first()->id,
            'image_path' => $imagePath,
            'is_promoted' => $this->faker->boolean
        ];
    }
}
