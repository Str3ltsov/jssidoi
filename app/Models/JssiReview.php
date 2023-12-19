<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiReview extends Model
{
    protected $table = 'jssi_reviews';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'author_id',
        'article_id',
        'content',
        'reviewer_id',
        'evaluation',
        'originality',
        'methodology',
        'structure',
        'language',
        'advice',
        'generalComment',
    ];

    protected $casts = [
        'author_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'article_id' => 'integer',
        'isVisible' => 'boolean',
        'reviewer_id' => 'integer',
        'evaluation' => 'integer',
        'originality' => 'integer',
        'methodology' => 'integer',
        'structure' => 'integer',
        'language' => 'integer',
        'advice' => 'integer',
        'generalComment' => 'string',
    ];

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'reviewer_id');
    }
    public function article(): HasOne
    {
        return $this->hasOne(JssiArticle::class, 'id', 'article_id');
    }
}
