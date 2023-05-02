<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiCountry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminCountriesController extends Controller
{
     public function index() {
        $countries = JssiCountry::paginate(20);
        return view('jssi.admin.pages.papers.countries.show', compact('countries'));
    }

    public function edit($id) {
        $country = JssiCountry::findOrFail($id);

        return view('jssi.admin.pages.papers.countries.edit', compact('country'));
    }

    public function update(Request $request, $id) : RedirectResponse{
        $country = JssiCountry::findOrFail($id);

        $request->validate([
            'countryName' => 'required|string',
            'countryCode' => 'required|string|max:2',
        ]);


        $country->name = $request->input('countryName');
        $country->code = $request->input('countryCode');

        $country->save();

        return redirect()->route('jssi.admin.countries')->with('success', sprintf('Country %s updated successfully!', $country->name));

    }

    public function destroy(Request $req) : RedirectResponse {
        $country = JssiCountry::findOrFail($req->id);
        $country->delete();

        return redirect()->route('jssi.admin.countries')->with('success', sprintf('Country %s deleted successfully!', $country->name));

    }

    public function create() {
        return view('jssi.admin.pages.papers.countries.create');
    }

    public function store(Request $request) {
         $request->validate([
            'countryName' => 'required|string',
            'countryCode' => 'required|string|max:2',
        ]);

        $country = new JssiCountry();

        $country->name = ucfirst($request->input('countryName'));
        $country->code = strtoupper($request->input('countryCode'));

        $country->saveOrFail();

        return redirect()->route('jssi.admin.countries')->with('success', sprintf('Country %s created successfully!', $country->name));
    }
}
