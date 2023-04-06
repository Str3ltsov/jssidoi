<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiIssue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_issues';

    protected $fillable = [
        'volume',
        'number',
        'date',
        'doi',
        'print',
        'online',
        'cover',
        'visible',
        'views',
        'downloads'
    ];

    protected $casts = [
        'volume' => 'integer',
        'number' => 'integer',
        'date' => 'date',
        'doi' => 'string',
        'print' => 'string',
        'online' => 'string',
        'cover' => 'string',
        'visible' => 'boolean',
        'views' => 'integer',
        'downloads' => 'integer'
    ];
}
