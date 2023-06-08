<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiArticlesAuthorsInstitution extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_articles_authors_institutions';

    protected $fillable = [
        'article_id',
        'authors_institution_id',
        'sequence'
    ];

    protected $casts = [
        'article_id' => 'integer',
        'authors_institution_id' => 'integer',
        'sequence' => 'integer'
    ];

    public function article(): HasOne
    {
        return $this->hasOne(JssiArticle::class, 'id', 'article_id');
        
    }

    public function authorsInstitution(): HasOne
    {
        return $this->hasOne(JssiAuthorsInstitution::class, 'id', 'authors_institution_id');
    }
}
