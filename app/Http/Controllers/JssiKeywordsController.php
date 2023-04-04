<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiKeywordsController extends Controller
{
    public function index()
    {
        return view('jssi.keywords.index');
    }
}
