<?php

namespace App\Http\Controllers;

use App\Services\JssiArticleService;
use App\Services\JssiAuthorService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiAuthorsController extends Controller
{
    public function __construct(public JssiAuthorService $authorService, public JssiArticleService $articleService) {}

    public function index(Request $request): View|Application|Factory|Foundation\Application
    {
        $authors = $this->authorService->getFilteredJssiAuthors(20);

        return view('jssi.authors.index')
            ->with([
                'authors' => $authors,
                'filter' => $request->query()['filter'] ?? [],
                'articleCounts' => $this->authorService->getArticleCountForeachCollection($authors)
            ]);
    }

    public function show(int $id): View|Application|Factory|Foundation\Application
    {
        $author = $this->authorService->getJssiAuthorById($id);
        $articles = $this->authorService->getCollectionArticles($author);

        return view('jssi.authors.show')
            ->with([
                'articles' => $articles,
                'authors' => $this->articleService->getArticlesAuthors($articles)
            ]);
    }
}
