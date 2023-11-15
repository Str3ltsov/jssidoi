<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiReview extends Model
{
    protected $table = 'jssi_reviews';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'title',
        'author_id',
        'article_id',
        'content',
        'isVisible',
    ];

    protected $casts = [
        'author_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'article_id' => 'integer',
        'isVisible' => 'boolean',
    ];

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
    public function article(): HasOne
    {
        return $this->hasOne(JssiArticle::class, 'id', 'article_id');
    }
}
