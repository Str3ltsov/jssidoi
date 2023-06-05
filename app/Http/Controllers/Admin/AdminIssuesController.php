<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiIssue;
use App\Services\JssiIssueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIssuesController extends Controller
{

    private $issueService;

    public function __construct(JssiIssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    private $validationRules = [
        'issueVolume' => 'required|integer',
        'issueNum' => 'required|integer',
        'issueDateMonth' => 'required|string',
        'issueDateYear' => 'required|digits:4',
        'issueVisible' => 'nullable',
        'issuePrintFile' => 'filled|mimes:pdf',
        'issueOnlineFile' => 'filled|mimes:pdf',

    ];

    public function index()
    {
        $issues = JssiIssue::paginate(20);
        return view('jssi.admin.pages.papers.issues', compact('issues'));
    }

    public function edit($id)
    {
        $issue = JssiIssue::findOrFail($id);
        return view('jssi.admin.pages.papers.issues.edit', compact('issue'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules);

        $issue = JssiIssue::findOrFail($id);

        $issue->fill($request->only(["issueVolume", "issueNum"]));
        $issue->date = sprintf('%s-%s-1', $request->input('issueDateYear'), $request->input('issueDateMonth'));

        $issue->save();

        if ($request->hasFile('issuePrintFile') || $request->hasFile('issueOnlineFile')) {
            $this->issueService->handleFileUpload($issue, $request);
        }

        $issue->visible = ($request->input('issueVisibleSwitch')) != null ? 1 : 0;

        $issue->save();

        return redirect()->route('jssi.admin.issues')->with('success', sprintf('Issue #%s.%s updated successfully!', $issue->volume, $issue->number));

    }

    public function create()
    {
        return view('jssi.admin.pages.papers.issues.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $issue = new JssiIssue();

        $issue->fill($request->only(["issueVolume", "issueNum"]));
        $issue->date = sprintf('%s-%s-1', $request->input('issueDateYear'), $request->input('issueDateMonth'));

        $issue->save();

        if ($request->hasFile('issuePrintFile') || $request->hasFile('issueOnlineFile')) {
            $this->issueService->handleFileUpload($issue, $request);
        }

        $issue->visible = ($request->input('issueVisibleSwitch')) != null ? 1 : 0;

        $issue->saveOrFail();

        return redirect()->route('jssi.admin.issues')->with('success', 'Issue created successfully!');
    }

    public function destroy(Request $request)
    {
        $issue = JssiIssue::findOrFail($request->id);
        $issue->delete();

        return redirect()->route('jssi.admin.issues')->with('success', 'Issue deleted successfully!');
    }
}