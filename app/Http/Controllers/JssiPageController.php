<?php

namespace App\Http\Controllers;

use App\Models\JssiPage;

class JssiPageController extends Controller
{
    public function index($slug)
    {
        $page = JssiPage::where('slug', $slug)->first();

        if ($page) {
            return view('jssi.pages.index')->with('page', $page);
        } else {
            return redirect('jssiIssues');
        }
    }
}
