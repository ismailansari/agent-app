<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdAt = Carbon::now();
        $updatedAt = Carbon::now();

        Category::insert([
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ],
            [
                'name' => 'Javascript',
                'slug' => 'javascript',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ],
            [
                'name' => 'ReactJs',
                'slug' => 'reactjs',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ],
        ]);
    }
}
