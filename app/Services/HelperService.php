<?php

namespace App\Services;

use App\Models\JssiArticle;

class HelperService
{
    public function paginateCollection(object $collection, int $paginateNum): object
    {
        if (count($collection) > 0) {
            return $collection->toQuery()->paginate($paginateNum);
        }

        return $collection;
    }

    public function getArticleCountForeachCollection(object $collections): array
    {
        $articleCounts = [];

        foreach ($collections as $collection) {
            if (count($collection->authorsInstitutions) == 0) {
                $articleCounts[$collection->id] = 0;
            }

            $totalArticlesPerCollection = 0;

            foreach ($collection->authorsInstitutions as $authorsInstitution) {
                $totalArticlesPerCollection += count($authorsInstitution->articleAuthorsInstitutions);
            }

            $articleCounts[$collection->id] = $totalArticlesPerCollection;
        }

        return $articleCounts;
    }

    public function getCollectionArticles(object $collection): object
    {
        $articles = [];

        foreach ($collection->authorsInstitutions as $authorsInstitution) {
            foreach ($authorsInstitution->articleAuthorsInstitutions as $articleAuthorsInstitution) {
                $articles[] = $articleAuthorsInstitution->article;
            }
        }

        return collect($articles)->unique();
    }

    public function getPaginatedArticles(object $collection)
    {

        return JssiArticle::whereIn('id', $collection->pluck('id'))->paginate(20);
    }
}
