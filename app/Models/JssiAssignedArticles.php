<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiAssignedArticles extends Model
{
    use HasFactory;

    protected $table = 'jssi_assigned_articles';

    protected $fillable = [
        'article_id',
        'user_id',
    ];

    protected $casts = [
        'article_id' => 'integer',
        'review_id' => 'integer',

    ];

    public function article(): HasOne
    {

        return $this->hasOne(JssiArticle::class, 'id', 'article_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
