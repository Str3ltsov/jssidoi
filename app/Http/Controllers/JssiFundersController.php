<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiFundersController extends Controller
{
    public function index()
    {
        return view('jssi.funders.index');
    }
}
