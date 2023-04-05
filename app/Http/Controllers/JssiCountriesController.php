<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiCountriesController extends Controller
{
    public function index()
    {
        return view('jssi.countries.index');
    }
}
