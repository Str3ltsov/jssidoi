<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiArticleReviews extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_article_reviews';

    protected $fillable = [
        'article_id',
        'review_id',
    ];

    protected $casts = [
        'article_id' => 'integer',
        'review_id' => 'integer',

    ];

    public function article(): HasOne
    {

        return $this->hasOne(JssiArticle::class, 'id', 'article_id');
    }

    public function reviews(): HasOne
    {
        return $this->hasOne(JssiReview::class, 'id', 'review_id');
    }
}
