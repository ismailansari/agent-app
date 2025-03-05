<?php

namespace Database\Seeders;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\FakePeople;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdAt = $updatedAt = \now();

        $users = [
            [
                'name' => 'Muhammad Ismail',
                'email' => 'link2ismail@gmail.com',
                'gender' => 'male',
                'password' => Hash::make('link2ismail'),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]
        ];

        $role = [0 => 'agent', 1 => 'customer'];
        foreach ($users as $key => $userData) {
            $user = User::create($userData);
            $user->assignRole($role[$key]);
        }
    }
}
