<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class AdminMenusController extends Controller
{
    public function __construct()
    {
    }

    public function index(): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.index');
    }

    public function create(): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.create');
    }

    public function edit(): View|Application|Factory|Foundation\Application
    {
        return view('jssi.admin.menus.edit');
    }
}
