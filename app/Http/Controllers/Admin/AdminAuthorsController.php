<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthorsController extends Controller
{
    public function index() {
        return view('jssi.admin.pages.papers.authors');
    }
}