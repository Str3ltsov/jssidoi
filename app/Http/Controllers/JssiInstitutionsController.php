<?php

namespace App\Http\Controllers;

use App\Services\JssiInstitutionService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiInstitutionsController extends Controller
{
    public function __construct(public JssiInstitutionService $service) {}

    public function index(Request $request): View|Application|Factory|Foundation\Application
    {
        return view('jssi.institutions.index')
            ->with([
                'institutions' => $this->service->getFilteredJssiInstitutions(25),
                'filter' => $request->query()['filter'] ?? []
            ]);
    }

    public function show(int $id)
    {
        return view('jssi.institutions.show')
            ->with('id', $id);
    }
}
