<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Anonymous',
                'username' => 'Anonymous',
                'email' => 'anonymous@yahoo.com',
                'password' => Hash::make('0'),
                'notifications' => '0'
            ],
            [
                'name' => 'hasArticles',
                'username' => 'bothBoostedAndPlain',
                'email' => 'Articles@yahoo.com',
                'password' => Hash::make('0'),
                'notifications' => '1'
            ],
            [
                'name' => 'hasArticles2',
                'username' => 'bothBoostedAndPlain2',
                'email' => 'Articles2@yahoo.com',
                'password' => Hash::make('0'),
                'notifications' => '0'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);       
        }
        User::factory()->count(20)->create();
    }
}
