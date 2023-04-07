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
            $randomViews = $this->getRandomNumber();
            return $this->getRandomViewsBiggerThanDownloads($randomViews, $randomDownloads);
        } else {
            return $randomViews;
        }
    }
}
