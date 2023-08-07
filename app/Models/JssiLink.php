<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiLink extends Model
{
    use HasFactory;

    protected $table = 'jssi_links';

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'parent_id',
        'menu_id',
        'title',
        'class',
        'link',
        'visible',
        'queue',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'menu_id' => 'integer',
        'title' => 'string',
        'class' => 'string',
        'link' => 'string',
        'visible' => 'boolean',
        'queue' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function menu(): HasOne
    {
        return $this->hasOne(JssiMenu::class, 'id', 'menu_id');
    }
}
