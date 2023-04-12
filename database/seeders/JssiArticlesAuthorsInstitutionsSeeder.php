<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiArticlesAuthorsInstitutionsSeeder extends Seeder
{
    private function insertJssiArticleAuthorsInstitutions(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= rand(1, 20); $j++) {
                DB::table('jssi_articles_authors_institutions')->insert([
                    'article_id' => $i,
                    'authors_institution_id' => rand(1, 200),
                    'sequence' => $j
                ]);
            }
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertJssiArticleAuthorsInstitutions();
    }
}
