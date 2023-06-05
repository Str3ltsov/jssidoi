<?php

namespace App\Services;

use App\Models\JssiIssue;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public function handleFileUpload(JssiIssue $issue, Request $request)
    {
        if ($request->hasFile('issuePrintFile')) {
            $issue->print = $this->saveAndUploadFile($request->file('issuePrintFile'), $issue->volume, $issue->number, "print");
        }
        if ($request->hasFile('issueOnlineFile')) {
            $issue->online = $this->saveAndUploadFile($request->file('issueOnlineFile'), $issue->volume, $issue->number, "on-line");
        }


    }

    private function saveAndUploadFile(UploadedFile $file, int $volume, int $number, string $type): string
    {
        try {
            $filename = $this->formatFileName($volume, $number, $type);

            if (Storage::exists('issues/' . $filename)) {
                Storage::delete('issues/' . $filename);
            }

            $file->storeAs('issues', $filename, 'public');

            return $filename;

        } catch (Exception $e) {
            throw new Error("Unable to save {$type} file");
        }
    }

    private function formatFileName(int $volume, int $number, string $type): string
    {
        return "Journal_of_Security_and_Sustainability_Issues_Vol{$volume}_No{$number}_{$type}.pdf";
    }
}