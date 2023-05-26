<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiKeyword;

class KeywordService extends HelperService
{

    public final function getPaginatedKeywords($amount)
    {
        return JssiKeyword::paginate($amount);
    }

    public function handleKeywords(JssiArticle $article, string $keywordInput): void
    {
        $keywordsArray = explode(',', $keywordInput);
        $keywordsArray = array_map('trim', $keywordsArray);
        $keywordsArray = array_map('ucfirst', $keywordsArray);

        $keywords = [];

        foreach ($keywordsArray as $keyword) {
            $keywordModel = JssiKeyword::firstOrCreate(['keyword' => $keyword]);
            $keywords[] = $keywordModel->id;
        }
        // dd($keywordInput, $keywordsArray, $keywords);

        $article->keywords()->sync($keywords);

    }

    public function getKeywordList(int $articleId): string
    {
        $article = JssiArticle::findOrFail($articleId);
        $keywords = $article->keywords()->pluck('keyword')->implode(', ');

        return $keywords;
    }

    public function getArticleCounts($keywords)
    {
        $articleCounts = [];

        foreach ($keywords as $keyword) {
            // dd();
            if ($keyword->articles->count() == 0) {
                $articleCounts[$keyword->id] = 0;
            }
            $articleCounts[$keyword->id] = $keyword->articles()->count();

        }

        return $articleCounts;
    }

    public function getArticleList($keywordId)
    {
        return JssiKeyword::findOrFail($keywordId)->articles;
    }
}

?>