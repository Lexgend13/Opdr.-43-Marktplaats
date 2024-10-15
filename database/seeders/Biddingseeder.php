<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bidding;

class Biddingseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bidding::factory()->count(60)->create();
    }
}
