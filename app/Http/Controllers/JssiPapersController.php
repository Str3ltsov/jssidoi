<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiPapersController extends Controller
{
    public function index()
    {
        return view('jssi.papers.index');
    }

    public function show(int $id)
    {
        return view('jssi.papers.show')
            ->with('id', $id);
    }
}
