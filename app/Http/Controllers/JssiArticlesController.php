<?php

namespace App\Http\Controllers;

use App\Services\JssiArticleService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiArticlesController extends Controller
{
    public function __construct(public JssiArticleService $service) {}

    public function index(): View|Application|Factory|Foundation\Application
    {
        $articles = $this->service->paginateCollection(
            $this->service->getJssiArticles(),
            10,
            'id',
            'desc'
        );

        return view('jssi.articles.index')
            ->with('articles', $articles);
    }

    public function show(int $id): View|Application|Factory|Foundation\Application
    {
        return view('jssi.articles.show')
            ->with('article', $this->service->getJssiArticleById($id));
    }
}
