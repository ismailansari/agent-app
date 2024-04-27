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
        //TODO: issues due to permission will be fixed later
        // Create users
//        $imageFaker = new ImageFaker(new FakePeople());
//        $dest = storage_path('app/public/images/user');
//        if (!\File::exists($dest)) {
//            \File::makeDirectory($dest, 0777, true, true);
//        }
        $createdAt = $updatedAt = \now();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@laravel-blog.com',
                'gender' => 'male',
                'password' => Hash::make('admin@laravel-blog.com'),
                //'profile_image' => $imageFaker->image($dest, 300, 300, false),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ],
            [
                'name' => 'Muhammad Ismail',
                'email' => 'link2ismail@gmail.com',
                'gender' => 'male',
                'password' => Hash::make('link2ismail'),
                //'profile_image' => $imageFaker->image($dest, 300, 300, false),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]

        ];

        $role = [0 => 'admin', 1 => 'author'];
        foreach ($users as $key => $userData) {
            $user = User::create($userData);
            $user->assignRole($role[$key]);
        }
        /*
        $user = User::create([
            'name' => fake()->name('male'),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['male', 'female']),
            'password' => Hash::make('87654321'),
            // 'profile_image' => $imageFaker->image($dest, 300, 300, false),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);
        $user->assignRole('author');
        */
    }
}
