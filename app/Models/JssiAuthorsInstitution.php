<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JssiAuthorsInstitution extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_authors_institutions';

    protected $fillable = [
        'author_id',
        'institution_id'
    ];

    protected $casts = [
        'author_id' => 'integer',
        'institution_id' => 'integer'
    ];

    public function author(): HasOne
    {
        return $this->hasOne(JssiAuthor::class, 'id', 'author_id');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(JssiInstitution::class, 'id', 'institution_id');
    }

    public function articleAuthorsInstitutions(): HasMany
    {
        return $this->hasMany(JssiArticlesAuthorsInstitution::class, 'authors_institution_id', 'id');
    }
}