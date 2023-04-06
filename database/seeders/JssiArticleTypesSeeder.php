<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiArticleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jssi_article_types')->insert([
            ['title' => 'Paper'],
            ['title' => 'Introduction'],
            ['title' => 'Foreword']
        ]);
    }
}
