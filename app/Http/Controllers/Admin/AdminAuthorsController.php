<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiAuthor;
use App\Models\JssiAuthorsInstitution;
use App\Models\JssiInstitution;
use Illuminate\Http\Request;

class AdminAuthorsController extends Controller
{

    public function index()
    {

        $authors = JssiAuthor::paginate(20);
        return view('jssi.admin.pages.papers.authors', compact('authors'));
    }

    public function edit($id)
    {
        $author = JssiAuthor::findOrFail($id);
        $institutions = JssiInstitution::all();

        return view('jssi.admin.pages.papers.authors.edit', compact('author', 'institutions'));
    }

    public function update(Request $request, $id)
    {
        $author = JssiAuthor::findOrFail($id);

        $request->validate([
            'firstName' => 'string|required',
            'midName' => 'nullable|string',
            'lastName' => 'string|required',
            'email' => 'email',
            'orcid' => ['nullable'],
            ['regex:/(\d{4}-){3}\d{3}(\d|X)/'],
            'institutions' => 'nullable|array'
        ]);

        $author->first_name = $request->input('firstName');
        $author->last_name = $request->input('lastName');
        $author->middle_name = $request->input('midName');
        $author->email = $request->input('email');

        if ($request->has('orcid')) {
            $author->orcid = $request->input('orcid');
        }

        $institutionIds = $request->input('institutions', []);

        if (!empty($institutionIds)) {
            $current_institutions = $author->authorsInstitutions()->pluck('institution_id')->toArray();
            $selected_institutions = $request->input('institutions');
            $institutions_to_remove = array_diff($current_institutions, $selected_institutions);

            foreach ($selected_institutions as $institution_id) {
                $author->authorsInstitutions()->firstOrCreate(['institution_id' => $institution_id]);
            }
            $author->authorsInstitutions()->whereIn('institution_id', $institutions_to_remove)->delete();
        }

        // dd($author);
        $author->save();

        return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s updated successfully!', $author->fullname()));

    }

    public function destroy(Request $req)
    {
        $author = JssiAuthor::findOrFail($req->id);
        $author->delete();

        return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s deleted successfully!', $author->fullname()));

    }

    public function create()
    {
        $institutions = JssiInstitution::all();
        return view('jssi.admin.pages.papers.authors.create', compact('institutions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'string|required',
            'midName' => 'nullable|string',
            'lastName' => 'string|required',
            'email' => 'email',
            'orcid' => ['nullable'],
            ['regex:/(\d{4}-){3}\d{3}(\d|X)/'],
            'institutions' => 'nullable|array'
        ]);

        $author = new JssiAuthor();

        $author->first_name = $request->input('firstName');
        $author->last_name = $request->input('lastName');
        $author->middle_name = $request->input('midName');
        $author->email = $request->input('email');

        if ($request->has('orcid')) {
            $author->orcid = $request->input('orcid');
        }

        $institutionIds = $request->input('institutions', []);

        if (!empty($institutionIds)) {
            $author->saveOrFail();
            $selected_institutions = $request->input('institutions');

            foreach ($selected_institutions as $institution_id) {
                $author->authorsInstitutions()->firstOrCreate(['institution_id' => $institution_id]);
            }
        }

        $author->saveOrFail();

        return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s created successfully!', $author->fullname()));
    }
}