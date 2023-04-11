<?php

namespace Database\Seeders;

use App\Models\JssiCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JssiCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JssiCountry::factory()->count(100)->create();
    }
}
