<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiKeyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\KeywordService;
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
        $keywords = JssiKeyword::paginate(20);
        return view('jssi.admin.pages.papers.keywords', compact('keywords'));
    }

    public function create()
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

        return redirect()->route('jssi.admin.keywords.index')->with('success', 'Keyword updated successfuly!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'string|required',
        ]);

        $keywordAmount = $this->keywordService->handleKeywords($request->input('keyword'));

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