<?php

namespace Database\Seeders;

use App\Models\JssiInstitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JssiInstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JssiInstitution::factory()->count(100)->create();
    }
}
