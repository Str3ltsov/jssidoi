<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPapersController extends Controller
{
     public function index() {
        return view('jssi.admin.pages.papers.index');
    }
}