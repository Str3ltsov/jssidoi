<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiInstitution extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_institutions';

    protected $fillable = [
        'title',
        'website',
        'city',
        'country_id'
    ];

    protected $casts = [
        'title' => 'string',
        'website' => 'string',
        'city' => 'string',
        'country_id' => 'string'
    ];

    public function country(): HasOne
    {
        return $this->hasOne(JssiCountry::class, 'id', 'country_id');
    }

    public function authorsInstitutions(): HasMany
    {
        return $this->hasMany(JssiAuthorsInstitution::class, 'institution_id');
    }

    public function scopeTitleLike(Builder $query, $title): Builder
    {
        return $query->where('title', 'like', "$title%");
    }
}
