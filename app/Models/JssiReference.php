<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JssiReference extends Model
{
    protected $table = "jssi_references";

    protected $fillable = [
        'reference',
        'link',
        'article_id',
    ];

    protected $casts = [
        'reference' => 'string',
        'link' => 'string',
        'article_id' => 'integer'
    ];

    public $timestamps = false;

    public function articles(): BelongsTo
    {
        return $this->belongsTo(JssiArticle::class);
    }







}