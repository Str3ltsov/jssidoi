<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiKeyword extends Model
{

    protected $table = "jssi_keywords";

    protected $fillable = [
        'keyword',
    ];

    protected $casts = [
        'keyword' => 'string',
    ];

    public $timestamps = false;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(JssiArticle::class, 'jssi_articles_keywords', 'keyword_id', 'article_id');
    }
}