<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCode;
use Illuminate\Http\Request;

class AdminJelCodesController extends Controller
{
    public function index()
    {
        $jelCodes = JssiJELCode::paginate(20);
        return view('jssi.admin.pages.papers.jelcodes', compact('jelCodes'));
    }


}