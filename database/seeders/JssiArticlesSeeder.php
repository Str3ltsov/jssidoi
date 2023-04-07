<?php

namespace Database\Seeders;

use App\Enums\ArticleTypesEnum;
use App\Services\JssiIssueService;
use App\Traits\SeederHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiArticlesSeeder extends Seeder
{
    use SeederHelper;

    private function getRandomArticleType(): int
    {
        $articleTypes = [1, 3];
        return $articleTypes[rand(0, 1)];
    }

    private function insertJssiArticles(object $service): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $issue = $service->getJssiIssueById($i);

            for ($j = 1; $j <= rand(3, 50); $j++) {
                $rndArticleType = $this->getRandomArticleType();
                $doiDate = fake()->dateTimeBetween('-10 years')->format('Y');
                $rndHalNumber = rand(1000, 9999);
                $randomViews = rand(100, 10000);
                $randomDownloads = rand(100, 10000);

                DB::table('jssi_articles')->insert([
                    'issue_id' => $i,
                    'article_type_id' => $rndArticleType,
                    'title' => fake()->text(50),
                    'received' => $rndArticleType == ArticleTypesEnum::FOREWORD
                        ? null
                        : fake()->dateTimeBetween('-10 years')->format('Y-m-d'),
                    'accepted' => $rndArticleType == ArticleTypesEnum::FOREWORD
                        ? null
                        : fake()->dateTimeBetween('-1 years')->format('Y-m-d'),
                    'published' => $rndArticleType == ArticleTypesEnum::FOREWORD
                        ? null
                        : fake()->dateTimeBetween('-6 months')->format('Y-m-d'),
                    'abstract' => fake()->text(300),
                    'doi' => "10.9770/jssi.$doiDate.{$issue->volume}({$issue->number})",
                    'hal' => "hal-0169{$rndHalNumber}",
                    'note' => fake()->text(100),
                    'funding' => fake()->text(100),
                    'visible' => true,
                    'views' => $this->getRandomViewsBiggerThanDownloads($randomViews, $randomDownloads),
                    'downloads' => $randomDownloads
                ]);
            }
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(JssiIssueService $service): void
    {
        $this->insertJssiArticles($service);
    }
}
