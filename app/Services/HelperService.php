<?php

namespace App\Services;

class HelperService
{
    public final function paginateCollection(object $collection, int $paginateNum): object
    {
        return $collection->toQuery()->paginate($paginateNum);
    }
}
