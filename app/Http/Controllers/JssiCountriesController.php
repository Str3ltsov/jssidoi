<?php

namespace App\Http\Controllers;

use App\Services\JssiCountryService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiCountriesController extends Controller
{
    public function __construct(public JssiCountryService $service) {}

    public function index(Request $request): View|Application|Factory|Foundation\Application
    {
        return view('jssi.countries.index')
            ->with([
                'countries' => $this->service->getFilteredJssiCountries(20),
                'filter' => $request->query()['filter'] ?? []
            ]);
    }

    public function show(int $id)
    {
        return view('jssi.countries.show')
            ->with('id', $id);
    }
}
