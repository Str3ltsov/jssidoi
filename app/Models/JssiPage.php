<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiPage extends Model
{
    use HasFactory;

    protected $table = 'jssi_pages';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'isVisible',
    ];

    protected $casts = [
        'author' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
        'isVisible' => 'boolean',
    ];

}
