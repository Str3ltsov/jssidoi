<?php

namespace App\Http\Controllers;

use App\Services\JssiArticleService;
use App\Services\KeywordService;
use Illuminate\Http\Request;

class JssiKeywordsController extends Controller
{
    protected $keywordService, $articleService;
    public function __construct(KeywordService $keywordService, JssiArticleService $articleService)
    {
        $this->keywordService = $keywordService;
        $this->articleService = $articleService;
    }
    public function index()
    {
        $keywords = $this->keywordService->getPaginatedKeywords(20);
        $articleCounts = 0;

        return view('jssi.keywords.index')->with([
            'keywords' => $keywords,
            'articleCounts' => $this->keywordService->getArticleCounts($keywords),
        ]);
    }

    public function show(int $id)
    {
        $articles = $this->keywordService->getArticleList($id);

        return view('jssi.keywords.show')
            ->with([
                'id' => $id,
                'articles' => $articles,
                'authors' => $this->articleService->getArticlesAuthors($articles),
            ]);
    }
}