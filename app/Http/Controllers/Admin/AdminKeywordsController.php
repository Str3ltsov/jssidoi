<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiKeyword;
use Illuminate\Http\Request;
use Nette\NotImplementedException;
use Illuminate\Support\Str;
use App\Services\KeywordService;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;

class AdminKeywordsController extends Controller
{

    protected $keywordService;

    public function __construct(KeywordService $keywordService)
    {
        $this->keywordService = $keywordService;
    }

    public function index()
    {
        return view('jssi.admin.pages.papers.keywords');
    }

    public function create($id)
    {
        return view('jssi.admin.pages.papers.keywords.create');
    }

    public function edit($id)
    {
        $keyword = JssiKeyword::findOrFail($id);

        return view('jssi.admin.pages.papers.keywords.edit', compact('keyword'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keyword' => 'string|required',
        ]);

        $keyword = JssiKeyword::findOrFail($id);

        $keyword->keyword = $request->input('keyword');

        $keyword->update();

        return redirect()->route('jssi.admin.keywords')->with('success', 'Keyword updated successfuly!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'string|required',
        ]);

        $keywords = $this->keywordService->handleKeywords($request->input('keyword'));

        $keywordAmount = count($keywords);

        return redirect()->route('jssi.admin.keywords.index')->with('success', sprintf('%d %s created successfuly!', $keywordAmount, Str::plural('keyword', $keywordAmount)));
    }

    public function destroy(Request $request)
    {
        try {
            $keyword = JssiKeyword::findOrFail($request->id);

            $keyword->delete();

        } catch (QueryException $e) {
            return redirect()->route('jssi.admin.keywords')->with('error', 'Error: Keyword deletion failed.');
        }

        return redirect()->route('jssi.admin.keywords')->with('success', 'Keyword deleted successfuly!');
    }


}