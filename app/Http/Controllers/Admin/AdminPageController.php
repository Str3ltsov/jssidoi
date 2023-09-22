<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\JssiPageService;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{

    public function __construct(public JssiPageService $pService)
    {

    }
    public function index()
    {
        return view('jssi.admin.content.pages.index')->with('pages', $this->pService->getPaginatedPages(20));
    }

    public function show($pageId)
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'content' => 'required'
        ]);

        
    }

    public function create()
    {
        return view('jssi.admin.content.pages.create');
    }
}
