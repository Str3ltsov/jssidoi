<?php

namespace Database\Seeders;

use App\Models\JssiAuthor;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JssiAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JssiAuthor::factory()->count(100)->create();
    }
}
