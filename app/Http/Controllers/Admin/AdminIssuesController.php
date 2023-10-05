<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIssuesController extends Controller
{
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
        $issue = JssiIssue::findOrFail($id);

        $request->validate([
            'issueVolume' => 'required|integer',
            'issueNum' => 'required|string',
            'issueDateMonth' => 'required|string',
            'issueDateYear' => 'required|digits:4',
            'issueVisible' => 'nullable',
            'issuePrintFile' => 'filled|mimes:application/pdf',
            'issueOnlineFile' => 'filled|mimes:application/pdf',

        ]);

        $issue->volume = $request->input('issueVolume');
        $issue->number = $request->input('issueNum');
        $issue->date = sprintf('%s-%s-1', $request->input('issueDateYear'), $request->input('issueDateMonth'));
        if ($request->hasFile('issuePrintFile')) {
            $filename = sprintf('Journal_of_Security_and_Sustainability_Issues_Vol%d_No%d_print.pdf', $request->input('issueVolume'), $request->input('issueNum'));
            if (Storage::exists('issues/' . $filename)) {
                Storage::delete('issues/' . $filename);
            }
            $request->file('issuePrintFile')->storeAs('issues', $filename, 'public');

            $issue->print = $filename;
        }
        if ($request->hasFile('issueOnlineFile')) {
            $filename = sprintf('Journal_of_Security_and_Sustainability_Issues_Vol%d_No%d_on-line.pdf', $request->input('issueVolume'), $request->input('issueNum'));

            if (Storage::exists('issues/' . $filename)) {
                Storage::delete('issues/' . $filename);
            }

            $request->file('issueOnlineFile')->storeAs('issues', $filename, 'public');
            $issue->online = $filename;
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
        $request->validate([
            'issueVolume' => 'required|integer',
            'issueNum' => 'required|integer',
            'issueDateMonth' => 'required|string',
            'issueDateYear' => 'required|digits:4',
            'issuePrintFile' => 'required_without:issueOnlineFile|mimes:pdf',
            'issueOnlineFile' => 'required_without:issuePrintFile|mimes:pdf',
            'issueVisibleSwitch' => 'required',
        ]);

        $issue = new JssiIssue();

        $issue->volume = $request->input('issueVolume');
        $issue->number = $request->input('issueNum');
        $issue->date = sprintf('%s-%s-1', $request->input('issueDateYear'), $request->input('issueDateMonth'));

        if ($request->hasFile('issuePrintFile')) {
            $filename = sprintf('Journal_of_Security_and_Sustainability_Issues_Vol%d_No%d_print.pdf', $request->input('issueVolume'), $request->input('issueNum'));
            if (Storage::exists('issues/' . $filename)) {
                Storage::delete('issues/' . $filename);
            }
            $request->file('issuePrintFile')->storeAs('issues', $filename, 'public');

            $issue->print = $filename;
        }
        if ($request->hasFile('issueOnlineFile')) {
            $filename = sprintf('Journal_of_Security_and_Sustainability_Issues_Vol%d_No%d_on-line.pdf', $request->input('issueVolume'), $request->input('issueNum'));

            if (Storage::exists('issues/' . $filename)) {
                Storage::delete('issues/' . $filename);
            }

            $request->file('issueOnlineFile')->storeAs('issues', $filename, 'public');
            $issue->online = $filename;
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
