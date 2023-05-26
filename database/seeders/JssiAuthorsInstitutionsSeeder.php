<?php

namespace Database\Seeders;

use App\Models\JssiAuthorsInstitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JssiAuthorsInstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JssiAuthorsInstitution::factory()->count(200)->create();
    }
}
