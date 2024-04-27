<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagsString = "laravel,service provider,controllers,middleware,eloquent,arrays,database,url,promises,async await,Math,axios,Use Effect,Use State,Hooks,React LifeCycle";
        $tagsArray = explode(',', $tagsString);
        $tagData = [];
        $createdAt = $updatedAt = \now();
        foreach ($tagsArray as $tag) {
            $slug = strtolower(str_replace(' ', '-', $tag));
            $tagData[] = ['name' => strtolower($tag), 'slug' => $slug, 'created_at' => $createdAt, 'updated_at' => $updatedAt];
        }

        Tag::insert($tagData);
    }
}
