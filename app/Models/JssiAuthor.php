<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JssiAuthor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_authors';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'orcid',
        'subscribed_journals',
        'subscribed_events'
    ];

    protected $casts = [
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'orcid' => 'string',
        'subscribed_journals' => 'integer',
        'subscribed_events' => 'integer'
    ];

    public function authorsInstitutions(): BelongsToMany
    {
        return $this->belongsToMany(JssiInstitution::class, 'jssi_authors_institutions', 'author_id', 'institution_id');
    }

    public function scopeFirstNameLike(Builder $query, $firstName): Builder
    {
        return $query->where('first_name', 'like', "$firstName%");
    }

    public function scopeLastNameLike(Builder $query, $lastName): Builder
    {
        return $query->where('last_name', 'like', "$lastName%");
    }

    public function fullName(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}