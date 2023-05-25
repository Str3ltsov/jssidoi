<?php

namespace App\Models;

use Database\Seeders\JssiArticlesSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiArticle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_articles';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'issue_id',
        'article_type_id',
        'title',
        'received',
        'accepted',
        'published',
        'abstract',
        'content',
        'start_page',
        'end_page',
        'file',
        'doi',
        'elsevierid',
        'hal',
        'note',
        'funding',
        'visible',
        'views',
        'downloads'
    ];

    protected $casts = [
        'issue_id' => 'integer',
        'article_type_id' => 'integer',
        'title' => 'string',
        'received' => 'date',
        'accepted' => 'date',
        'published' => 'date',
        'abstract' => 'string',
        'content' => 'string',
        'start_page' => 'integer',
        'end_page' => 'integer',
        'file' => 'string',
        'doi' => 'string',
        'elsevierid' => 'string',
        'hal' => 'string',
        'note' => 'string',
        'funding' => 'string',
        'visible' => 'boolean',
        'views' => 'integer',
        'downloads' => 'integer'
    ];

    public function issue(): HasOne
    {
        return $this->hasOne(JssiIssue::class, 'id', 'issue_id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(JssiArticleType::class, 'id', 'article_type_id');
    }

    public function articlesAuthorsInstitutions(): HasMany
    {
        return $this->hasMany(JssiArticlesAuthorsInstitution::class, 'article_id');
    }

    public function jelCodes(): BelongsToMany
    {
        return $this->belongsToMany(JssiJELCode::class, 'jssi_article_jel_codes', 'article_id', 'jel_code_id');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(JssiKeyword::class, 'jssi_articles_keywords', 'article_id', 'keyword_id');
    }

    public function incrementViewCount()
    {
        $this->increment('views');
    }
}