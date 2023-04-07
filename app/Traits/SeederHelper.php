<?php

namespace App\Traits;

trait SeederHelper
{
    /*
     * Returns views less than downloads
     */
    public function getRandomViewsBiggerThanDownloads(int $randomViews, int $randomDownloads): int
    {
        if ($randomViews < $randomDownloads) {
            $randomViews = rand(100, 10000);
            return $this->getRandomViewsBiggerThanDownloads($randomViews, $randomDownloads);
        } else {
            return $randomViews;
        }
    }
}
