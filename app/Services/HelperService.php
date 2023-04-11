<?php

namespace App\Services;

class HelperService
{
    public function paginateCollection(object $collection, int $paginateNum): object
    {
        if (count($collection) > 0) {
            return $collection->toQuery()->paginate($paginateNum);
        }

        return $collection;
    }
}
