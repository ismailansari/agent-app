<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // TODO: issue with dir permission will be fixed later
//        $imageFaker = new ImageFaker(new Picsum());
//        $dest = storage_path('app/public/images/posts');
//        if (!\File::exists($dest)) {
//            \File::makeDirectory($dest, 0777, true, true);
//        }
        $postTitles = [
            "Routing",
            "Controllers",
            "Middleware",
            "Views",
            "Blade Templates",
            "Eloquent ORM",
            "Database Migrations",
            "Eloquent Relationships",
            "Form Validation",
            "Authentication",
            "Authorization",
            "Events and Listeners",
            "Queues",
            "File Storage",
            "Testing",
            "RESTful API Development",
            "CRUD Operations",
            "Error Handling",
            "Laravel Mix",
            "Artisan Console",
            "Task Scheduling",
            "Localization and Internationalization",
            "Laravel Echo and Broadcasting",
            "Package Development",
            "Laravel Horizon",
            "Laravel Passport",
            "Laravel Nova",
            "Laravel Vapor",
            "Laravel Forge",
            "Laravel Dusk",
            "Laravel Sanctum",
            "Laravel Telescope",
            "Laravel Socialite",
            "Laravel Cashier",
            "Laravel Scout",
            "Laravel Echo Server",
            "Laravel Tinker",
            "Laravel Valet",
            "Laravel Homestead",
            "Laravel Mix",
            "Laravel Notifications",
            "Laravel Policies",
        ];

        $title = $postTitles[array_rand($postTitles)]; // $this->faker->sentence;
        $slug = Str::slug($title);
        $createdAt = $updatedAt = \now();

        return [
            'title' => $title,
            'slug' => $slug,
            'meta_description' => $title . ', ' . $this->faker->sentence, // $this->faker->paragraph(2)
            'description' => $this->faker->paragraph(rand(25, 100)),
//            'featured_image' => $imageFaker->image($dest, 750, 750, false),
            'is_publish' => 1,
            'category_id' => rand(1, 4),
            'author_id' => 2,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
