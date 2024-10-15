<?php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ArticleSeeder::class,
            CategorySeeder::class,
            BiddingSeeder::class,
            MessageSeeder::class
        ]);

         // Get all articles and categories
         $articles = Article::all();
         $categories = Category::all();
 
         // Loop through articles
         foreach ($articles as $article) {
             // Attach random categories to each article
             $article->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
         }
     }
}
