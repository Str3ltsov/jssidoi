<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiArticleType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_article_types';

    protected $fillable = ['name'];

    protected $casts = ['name' => 'string'];
}
