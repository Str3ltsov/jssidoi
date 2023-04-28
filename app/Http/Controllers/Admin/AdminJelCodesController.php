<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminJelCodesController extends Controller
{
     public function index() {
        return view('jssi.admin.pages.papers.jelcodes');
    }
}
