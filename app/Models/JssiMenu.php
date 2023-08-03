<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiMenu extends Model
{
    use HasFactory;

    protected $table = 'jssi_menus';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'title',
        'alias',
        'class',
        'visible',
        'weight',
        'link_count',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'title' => 'string',
        'alias' => 'string',
        'class' => 'string',
        'visible' => 'boolean',
        'weight' => 'integer',
        'link_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
