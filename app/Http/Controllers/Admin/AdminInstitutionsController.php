<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiCountry;
use App\Models\JssiInstitution;
use Exception;
use Illuminate\Http\Request;

class AdminInstitutionsController extends Controller
{

    private $validationRules = [
        'title' => 'required|string',
        'website' => 'required|url',
        'city' => 'required|string',
        'country' => 'required|integer',
    ];

    private $fields = [
        'title',
        'website',
        'city',
    ];

    public function index()
    {
        $institutions = JssiInstitution::with("country")->paginate(20);
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

        $request->validate($this->validationRules);

        $institution = JssiInstitution::findOrFail($id);
        $institution->fill($request->only($this->fields));
        $institution->country_id = $request->input('country');

        $institution->update();

        return redirect()->route('jssi.admin.institutions.index')->with('success', sprintf('Institution %s updated sucessfuly!', $institution->title));

    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $institution = new JssiInstitution();
        $institution->fill($request->only($this->fields));
        $institution->country_id = $request->input('country');

        $institution->save();

        return redirect()->route('jssi.admin.institutions.index')->with('success', sprintf('Institution %s created successfuly', $institution->title));
    }

    public function destroy(Request $request)
    {
        try {
            $institution = JssiInstitution::findOrFail($request->id);
            $institution->delete();

            return redirect()->route('jssi.admin.institutions.index')->with('success', 'Institution deleted successfuly!');
        } catch (Exception $e) {
            return redirect()->route('jssi.admin.institutions.index')->with('error', 'Enexpected error. Institution was not deleted');
        }
    }
}