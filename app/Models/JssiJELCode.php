<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JssiJELCode extends Model
{
    protected $table = 'jssi_jel_codes';

    protected $fillable = [
        'name',
        'description',
        'jel_subcategory_id',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'jel_subcategory_id' => 'integer',
    ];

    public $timestamps = false;

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(JssiJELSubcategory::class);
    }
}
