<?php

namespace App\Services;

use App\Models\JssiInstitution;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Error;

class JssiInstitutionService extends HelperService
{
    public final function getJssiInstitutions(): object
    {
        return JssiInstitution::all();
    }

    public final function getFilteredJssiInstitutions(int $paginateNum): object
    {
        return QueryBuilder::for(JssiInstitution::class)
            ->allowedSorts('title')
            ->allowedFilters([
                AllowedFilter::scope('title like'),
            ])
            ->paginate($paginateNum);
    }

    public final function getJssiInstitutionById(int $id): object
    {
        $institution = JssiInstitution::find($id);

        if (!$institution) {
            throw new Error('Failed to find institution by id');
        }

        return $institution;
    }
}
