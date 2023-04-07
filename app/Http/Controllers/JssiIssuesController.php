<?php

namespace App\Http\Controllers;

use App\Services\JssiIssueService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class JssiIssuesController extends Controller
{
    public function __construct(public JssiIssueService $service) {}

    public function index(): View|Application|Factory|Foundation\Application
    {
        $issues = $this->service->paginateCollection($this->service->getJssiIssues(), 20);

        return view('jssi.issues.index')
            ->with('issues', $issues);
    }

    public function show(int $id): View|Application|Factory|Foundation\Application
    {
        return view('jssi.issues.show')
            ->with('issue', $this->service->getJssiIssueById($id));
    }
}
