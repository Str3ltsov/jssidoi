<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiPapersController extends Controller
{
    public function index()
    {
        return view('jssi.papers.index');
    }
}
