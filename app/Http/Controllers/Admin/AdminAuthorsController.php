<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiAuthor;
use Illuminate\Http\Request;

class AdminAuthorsController extends Controller
{
    public function index() {

        $authors = JssiAuthor::paginate(20);
        return view('jssi.admin.pages.papers.authors', compact('authors'));
    }
}
