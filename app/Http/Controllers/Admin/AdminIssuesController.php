<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiIssue;
use Illuminate\Http\Request;

class AdminIssuesController extends Controller
{
     public function index() {
        $issues = JssiIssue::paginate(20);
        return view('jssi.admin.pages.papers.issues', compact('issues'));
    }
}
