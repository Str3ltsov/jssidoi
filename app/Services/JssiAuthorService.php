<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiArticlesAuthorsInstitution;
use App\Models\JssiAuthor;
use Error;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class JssiAuthorService extends HelperService
{
    public final function getJssiAuthors(): object
    {
        return JssiAuthor::all();
    }

    public final function getFilteredJssiAuthors(int $paginateNum): object
    {
        return QueryBuilder::for(JssiAuthor::class)
            ->allowedSorts('first_name', 'last_name')
            ->allowedFilters([
                AllowedFilter::scope('first_name like'),
                AllowedFilter::scope('last_name like')
            ])
            ->paginate($paginateNum);
    }

    public final function getJssiAuthorById(int $id): object
    {
        $author = JssiAuthor::find($id);

        if (!$author) {
            throw new Error('Failed to find jssi author by id');
        }

        return $author;
    }

    public final function getArticleCountForeachAuthor(object $authors): array
    {
        $articleCounts = [];

        foreach ($authors as $author) {
            if (count($author->authorsInstitutions) == 0) {
                $articleCounts[$author->id] = 0;
            }
            foreach ($author->authorsInstitutions as $authorsInstitution) {
                $articleCounts[$author->id] = count($authorsInstitution->articleAuthorsInstitutions);
            }
        }

        return $articleCounts;
    }

    public final function getAuthorArticles(object $author): object
    {
        $articles = [];

        foreach ($author->authorsInstitutions as $authorsInstitution) {
            foreach ($authorsInstitution->articleAuthorsInstitutions as $articleAuthorsInstitution) {
                $articles[] = $articleAuthorsInstitution->article;
            }
        }

        return collect($articles);
    }
}
