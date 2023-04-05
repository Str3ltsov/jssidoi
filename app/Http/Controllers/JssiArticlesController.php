<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiArticlesController extends Controller
{
    public function index()
    {
        return view('jssi.articles.index');
    }

    public function show(int $id)
    {
        return view('jssi.articles.show')
            ->with('id', $id);
    }
}
