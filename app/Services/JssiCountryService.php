<?php

namespace App\Services;

use App\Models\JssiCountry;
use Spatie\QueryBuilder\QueryBuilder;
use Error;

class JssiCountryService extends HelperService
{
    public final function getJssiCountries(): object
    {
        return JssiCountry::all();
    }

    public final function getFilteredJssiCountries(int $paginateNum): object
    {
        return QueryBuilder::for(JssiCountry::class)
            ->allowedSorts('name')
            ->paginate($paginateNum);
    }

    public final function getJssiCountryById(int $id): object
    {
        $country = JssiCountry::find($id);

        if (!$country) {
            throw new Error('Failed to find jssi country by id');
        }

        return $country;
    }
}
