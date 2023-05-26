<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiJELSubcategory extends Model
{

    // $table->string('subcategory');
    //         $table->string('description');
    //         $table->unsignedBigInteger('jel_category_id');
    protected $table = 'jssi_jel_subcategories';

    protected $fillable = [
        'name',
        'description',
        'jel_category_id',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'jel_category_id' => 'integer',
    ];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(JssiJELCategory::class);
    }

    public function jelCodes(): HasMany
    {
        return $this->hasMany(JssiJELCode::class);
    }
}
