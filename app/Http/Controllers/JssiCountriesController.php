<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiCountriesController extends Controller
{
    public function index()
    {
        return view('jssi.countries.index');
    }

    public function show(int $id)
    {
        return view('jssi.countries.show')
            ->with('id', $id);
    }
}
