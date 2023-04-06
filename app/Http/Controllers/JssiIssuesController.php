<?php

namespace App\Http\Controllers;

use App\Services\JssiIssueService;
use Illuminate\Http\Request;

class JssiIssuesController extends Controller
{
    public function __construct(public JssiIssueService $service)
    {}

    public function index()
    {
        $issues = $this->service->paginateCollection($this->service->getJssiIssues(), 20);

        return view('jssi.issues.index')
            ->with('issues', $issues);
    }

    public function show(int $id)
    {
        return view('jssi.issues.show')
            ->with('issue', $this->service->getJssiIssueById($id));
    }
}
