<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiAuthorsController extends Controller
{
    public function index()
    {
        return view('jssi.authors.index');
    }

    public function show(int $id)
    {
        return view('jssi.authors.show')
            ->with('id', $id);
    }
}
