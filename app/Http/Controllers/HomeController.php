<?php

namespace App\Http\Controllers;

use App\Services\JssiLinkService;
use App\Services\JssiMenuService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(public JssiMenuService $mService, public JssiLinkService $lService)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }
}
