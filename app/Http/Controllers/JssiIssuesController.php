<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiIssuesController extends Controller
{
    public function index()
    {
        return view('jssi.issues.index');
    }

    public function show(int $id)
    {
        return view('jssi.issues.show')
            ->with('id', $id);
    }
}
