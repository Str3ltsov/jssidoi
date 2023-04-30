<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiCountry;
use Illuminate\Http\Request;

class AdminCountriesController extends Controller
{
     public function index() {
        $countries = JssiCountry::paginate(20);
        return view('jssi.admin.pages.papers.countries', compact('countries'));
    }
}
