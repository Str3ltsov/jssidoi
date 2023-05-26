<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiArticle;
use App\Models\JssiAuthor;
use App\Models\JssiInstitution;
use App\Models\JssiIssue;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index() {

        $articles_count = JssiArticle::all()->count();
        $authors_count = JssiAuthor::all()->count();
        $instituions_count = JssiInstitution::all()->count();
        return view('jssi.admin.index', [
            'articles_count' => $articles_count,
            'authors_count' => $authors_count,
            'institutions_count' => $instituions_count,
        ]);
    }
}
