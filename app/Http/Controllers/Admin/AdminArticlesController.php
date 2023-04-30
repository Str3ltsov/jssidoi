<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiArticle;
use Illuminate\Http\Request;

class AdminArticlesController extends Controller
{
     public function index() {
        $articles = JssiArticle::paginate(20);
        return view('jssi.admin.pages.papers.articles', compact('articles'));
    }
}
