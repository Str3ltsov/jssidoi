<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiInstitution;
use Illuminate\Http\Request;

class AdminInstitutionsController extends Controller
{
     public function index() {
        $institutions = JssiInstitution::paginate(20);
        return view('jssi.admin.pages.papers.Institutions', compact('institutions'));
    }
}
