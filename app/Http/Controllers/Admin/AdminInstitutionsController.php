<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiCountry;
use App\Models\JssiInstitution;
use Exception;
use Illuminate\Http\Request;

class AdminInstitutionsController extends Controller
{
    public function index()
    {
        $institutions = JssiInstitution::paginate(20);
        return view('jssi.admin.pages.papers.Institutions', compact('institutions'));
    }

    public function edit($id)
    {
        $institution = JssiInstitution::findOrFail($id);
        $countries = JssiCountry::all();

        return view('jssi.admin.pages.papers.institutions.edit', compact('institution', 'countries'));
    }

    public function create()
    {
        $countries = JssiCountry::all();

        return view('jssi.admin.pages.papers.institutions.create', compact('countries'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string',
            'website' => 'required|url',
            'city' => 'required|string',
            'country' => 'required|integer'
        ]);

        $institution = JssiInstitution::findOrFail($id);

        $institution->fill($request->only([
            'title',
            'website',
            'city'
        ]));

        $institution->country_id = $request->input('country');

        $institution->update();

        return redirect()->route('jssi.admin.institutions')->with('success', sprintf('Institution %s updated sucessfuly!', $institution->title));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'website' => 'required|url',
            'city' => 'required|string',
            'country' => 'required|integer'
        ]);

        $institution = new JssiInstitution();

        $institution->fill($request->only([
            'title',
            'website',
            'city'
        ]));

        $institution->country_id = $request->input('country');

        $institution->save();

        return redirect()->route('jssi.admin.institutions')->with('success', sprintf('Institution %s created successfuly', $institution->title));
    }

    public function destroy(Request $request)
    {
        try {
            $institution = JssiInstitution::findOrFail($request->id);

            $institution->delete();

            return redirect()->route('jssi.admin.institutions')->with('success', 'Institution deleted successfuly!');
        } catch (Exception $e) {
            return redirect()->route('jssi.admin.institutions')->with('error', 'Enexpected error. Institution was not deleted');
        }
    }
}