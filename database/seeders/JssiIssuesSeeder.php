<?php

namespace Database\Seeders;

use App\Traits\SeederHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssiIssuesSeeder extends Seeder
{
    use SeederHelper;

    private function insertJssiIssues(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            for ($j = 1; $j <= rand(3, 4); $j++) {
                $unformatedDate = fake()->dateTimeBetween('-10 years');
                $randomViews = rand(100, 10000);
                $randomDownloads = rand(100, 10000);

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
