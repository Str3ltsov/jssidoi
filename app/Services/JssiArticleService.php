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

    public final function getArticlesAuthors(object $articles): object
    {
        $articlesAuthors = [];

        foreach ($articles as $article) {
            $authors = [];

            foreach ($article->articlesAuthorsInstitutions as $articlesAuthorsInstitution) {
                $authors[] = $articlesAuthorsInstitution->authorsInstitution->author;
            }

            $articlesAuthors[$article->id] = $authors;
        }

        return collect($articlesAuthors);
    }

    public final function getArticleAuthorsInstitutions(object $article): object
    {
        $authorsInstitutions = [];

        foreach ($article->articlesAuthorsInstitutions as $articlesAuthorsInstitution) {
            $authorsInstitutions[] = $articlesAuthorsInstitution->authorsInstitution;
        }

        return collect($authorsInstitutions);
    }

    public function paginateCollection(
        object $collection, int $paginateNum, string $orderVar = 'id', string $orderDir = 'asc'): object
    {
        return $collection->toQuery()->orderBy($orderVar, $orderDir)->paginate($paginateNum);
    }
}
