<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiFundersController extends Controller
{
    public function index()
    {
        return view('jssi.funders.index');
    }

    public function show(int $id)
    {
        return view('jssi.funders.show')
            ->with('id', $id);
    }
}
