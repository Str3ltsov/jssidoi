<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCode;
use App\Models\JssiJELSubcategory;
use Illuminate\Http\Request;

class AdminJelCodesController extends Controller
{
    public function index()
    {
        $jelCodes = JssiJELCode::paginate(20);
        return view('jssi.admin.pages.papers.jel.codes.show', compact('jelCodes'));
    }

    public function create()
    {
        $subcategories = JssiJELSubcategory::all();

        return view('jssi.admin.pages.papers.jel.codes.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        //
    }

}
