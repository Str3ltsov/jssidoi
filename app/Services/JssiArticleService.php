<?php

namespace App\Services;

use App\Models\JssiArticle;
use Error;

class JssiArticleService extends HelperService
{
    public final function getJssiArticles(): object
    {
        return JssiArticle::all();
    }

    public final function getJssiArticleById(int $id): object
    {
        $article = JssiArticle::find($id);

        if (!$article) {
            throw new Error('Failed to find jssi article by id');
        }

        return $article;
    }

    public function paginateCollection(
        object $collection, int $paginateNum, string $orderVar = 'id', string $orderDir = 'asc'): object
    {
        return $collection->toQuery()->orderBy($orderVar, $orderDir)->paginate($paginateNum);
    }
}
