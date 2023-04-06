<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiIssuesSeeder extends Seeder
{
    private function getRandomNumber(): int
    {
        return rand(100, 10000);
    }

    private function getRandomViewsBiggerThanDownloads(int $randomViews, int $randomDownloads): int
    {
        if ($randomViews < $randomDownloads) {
            $randomViews = $this->getRandomNumber();
            return $this->getRandomViewsBiggerThanDownloads($randomViews, $randomDownloads);
        } else {
            return $randomViews;
        }
    }

    private function insertJssiIssues(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= rand(3, 4); $j++) {
                $unformatedDate = fake()->dateTimeBetween('-10 years');
                $randomViews = $this->getRandomNumber();
                $randomDownloads = $this->getRandomNumber();

                DB::table('jssi_issues')->insert([
                    'volume' => $i,
                    'number' => $j,
                    'date' => $unformatedDate->format('Y-m-d'),
                    'doi' => "10.9770/jesi.{$unformatedDate->format('Y')}.$i.$j",
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
    public function run(): void
    {
        $this->insertJssiIssues();
    }
}
