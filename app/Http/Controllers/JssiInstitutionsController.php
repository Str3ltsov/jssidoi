<?php

namespace App\Http\Controllers;

use App\Services\JssiArticleService;
use App\Services\JssiInstitutionService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiInstitutionsController extends Controller
{
    public function __construct(public JssiInstitutionService $institutionService, public JssiArticleService $articleService) {}

    public function index(Request $request): View|Application|Factory|Foundation\Application
    {
        $institutions = $this->institutionService->getFilteredJssiInstitutions(25);

        return view('jssi.institutions.index')
            ->with([
                'institutions' => $institutions,
                'filter' => $request->query()['filter'] ?? [],
                'articleCounts' => $this->institutionService->getArticleCountForeachCollection($institutions)
            ]);
    }

    public function show(int $id)
    {
        $institution = $this->institutionService->getJssiInstitutionById($id);
        $articles = $this->institutionService->getCollectionArticles($institution);

        return view('jssi.institutions.show')
            ->with([
                'articles' => $articles,
                'authors' => $this->articleService->getArticlesAuthors($articles)
            ]);
    }
}
