<?php

namespace App\Http\Controllers;

use App\Services\JssiAuthorService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiAuthorsController extends Controller
{
    public function __construct(public JssiAuthorService $service) {}

    public function index(Request $request): View|Application|Factory|Foundation\Application
    {
        return view('jssi.authors.index')
            ->with([
                'authors' => $this->service->getFilteredJssiAuthors(20),
                'filter' => $request->query()['filter'] ?? []
            ]);
    }

    public function show(int $id)
    {
        return view('jssi.authors.show')
            ->with('id', $id);
    }
}
