<?php

namespace Database\Seeders;

use App\Models\JssiMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JssiMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JssiMenu::factory()->count(2)->create();
    }
}
