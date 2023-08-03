<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            JssiArticleTypesSeeder::class,
            JssiIssuesSeeder::class,
            JssiArticlesSeeder::class,
            JssiAuthorsSeeder::class,
            JssiCountriesSeeder::class,
            JssiInstitutionsSeeder::class,
            JssiAuthorsInstitutionsSeeder::class,
            JssiArticlesAuthorsInstitutionsSeeder::class
        ]);
    }
}
