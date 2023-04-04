<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JssiInstitutionsController extends Controller
{
    public function index()
    {
        return view('jssi.institutions.index');
    }
}
