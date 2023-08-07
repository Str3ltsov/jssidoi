<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiArticle;
use App\Models\JssiAuthor;
use App\Models\JssiInstitution;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('jssi.admin.index')
            ->with([
                'articles_count' => JssiArticle::all()->count(),
                'authors_count' => JssiAuthor::all()->count(),
                'institutions_count' => JssiInstitution::all()->count()
            ]);
    }
}
