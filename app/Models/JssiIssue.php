<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiIssue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_issues';

    protected $dateFormat = 'Y-m-d';

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

    public function articles(): HasMany
    {
        return $this->hasMany(JssiArticle::class, 'issue_id', 'id');
    }
}
