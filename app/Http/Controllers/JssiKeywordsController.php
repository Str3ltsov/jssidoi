<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiKeywordsController extends Controller
{
    public function index()
    {
        return view('jssi.keywords.index');
    }

    public function show(int $id)
    {
        return view('jssi.keywords.show')
            ->with('id', $id);
    }
}
