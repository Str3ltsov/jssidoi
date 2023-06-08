<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiAuthor;
use App\Models\JssiAuthorsInstitution;
use App\Models\JssiInstitution;
use App\Services\JssiAuthorService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAuthorsController extends Controller
{

    protected $authorService;

    public function __construct(JssiAuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    protected $validationRules = [
        'firstName' => 'string|required',
        'midName' => 'nullable|string',
        'lastName' => 'string|required',
        'email' => 'email',
        'orcid' => ['nullable'],
        ['regex:/(\d{4}-){3}\d{3}(\d|X)/'],
        'institutions' => 'nullable|array'
    ];

    protected function exctractDataFromRequest(Request $request)
    {
        return [
            'first_name' => $request->input('firstName'),
            'middle_name' => $request->input('midName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'orcid' => $request->input('orcid'),
        ];
    }
    public function index()
    {
        $authors = JssiAuthor::paginate(20);
        return view('jssi.admin.pages.papers.authors', compact('authors'));
    }

    public function edit($id)
    {
        $author = JssiAuthor::findOrFail($id);

        $institutions = JssiInstitution::all();
        $selectedInstitutions = $author->authorsInstitutions()->pluck('institution_id')->toArray();

        return view('jssi.admin.pages.papers.authors.edit', compact('author', 'institutions', 'selectedInstitutions'));
    }

    public function update(Request $request, $id)
    {

        $request->validate($this->validationRules);

        $author = JssiAuthor::findOrFail($id);
        $data = $this->exctractDataFromRequest($request);
        $author->fill($data);

        $institutionIds = $request->input('institutions', []);
        $assignmentResult = $this->authorService->handleInstitutionAssignment($author, $institutionIds);
        if ($assignmentResult instanceof RedirectResponse) {
            return $assignmentResult;
        }
        $author->update();

        return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s updated successfully!', $author->fullname()));

    }

    public function destroy(Request $req)
    {
        try {
            $author = JssiAuthor::findOrFail($req->id);
            $author->delete();

            return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s deleted successfully!', $author->fullname()));
        } catch (QueryException $e) {
            if ($e->getCode() == 23000)
                return redirect()->route('jssi.admin.authors')->with('error', 'Error: This author can not be deleted, because this author has published articles.');
        }
    }

    public function create()
    {
        $institutions = JssiInstitution::all();
        return view('jssi.admin.pages.papers.authors.create', compact('institutions'));
    }

        public function store(Request $request)
        {
            $request->validate($this->validationRules);

            $author = new JssiAuthor();

            $data = $this->exctractDataFromRequest($request);
            $author->fill($data);
            $author->saveOrFail();

            $institutionIds = $request->input('institutions', []);
            $assignmentResult = $this->authorService->handleInstitutionAssignment($author, $institutionIds);
            if ($assignmentResult instanceof RedirectResponse) {
                return $assignmentResult;
            }
            $author->updateOrFail();

            return redirect()->route('jssi.admin.authors')->with('success', sprintf('Author %s created successfully!', $author->fullname()));
        }
}
