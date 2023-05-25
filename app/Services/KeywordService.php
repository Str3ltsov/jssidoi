<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiKeyword;

class KeywordService
{

    public function handleKeywords(string $keywordInput): array
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

        return $keywords;

    }

    public function getKeywordList(int $articleId): string
    {
        $article = JssiArticle::findOrFail($articleId);
        $keywords = $article->keywords()->pluck('keyword')->implode(', ');

        return $keywords;
    }
}

?>
