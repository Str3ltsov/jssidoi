<?php

namespace App\Services;

use App\Models\JssiIssue;
use Error;

class JssiIssueService extends HelperService
{
    public final function getJssiIssues(): object
    {
        return JssiIssue::all();
    }

    public final function getJssiIssueById(int $id): object
    {
        $issue = JssiIssue::find($id);

        if (!$issue) {
            throw new Error('Failed to find jssi issue by id');
        }

        return $issue;
    }
}
