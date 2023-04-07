<?php

namespace App\Models;

use Database\Seeders\JssiArticlesSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->hasOne(JssiIssue::class, 'issue_id', 'id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(JssiArticleType::class, 'article_type_id', 'id');
    }
}
