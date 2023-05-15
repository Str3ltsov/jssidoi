<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiJELCategory extends Model
{
    //  $table->char('category', 2);
    //         $table->string('description');
    protected $table = 'jssi_jel_categories';

    protected $fillable = [
        'name',
        'description'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(JssiJELSubcategory::class);
    }
}
