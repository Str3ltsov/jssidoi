<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiJELCategory extends Model
{
    protected $table = 'jssi_jel_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

    public $timestamps = false;

    public function subcategories(): HasMany
    {
        return $this->hasMany(JssiJELSubcategory::class);
    }
}