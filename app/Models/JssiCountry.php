<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JssiCountry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jssi_countries';

    protected $fillable = [
        'code',
        'name'
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string'
    ];
}
