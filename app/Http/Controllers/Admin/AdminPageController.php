<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiPage;
use App\Services\JssiPageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{

    public function __construct(public JssiPageService $pService)
    {

    }
    public function index()
    {
        return view('jssi.admin.content.pages.index')->with('pages', $this->pService->getPaginatedPages(20));
    }

    public function edit($pageId)
    {
        $page = JssiPage::find($pageId)->first();

        return view('jssi.admin.content.pages.edit')->with('page', $page);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
        ]);

        try {

            $authorId = Auth::user()->id;
            $page = new JssiPage();
            $this->pService->setPageFields($page, $request, $authorId);

            return redirect(route('admin.pages.index'))
                ->with('success', __('Sucessfuly created page'));

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());

        }

    }

    public function update(Request $request, $pageId)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
        ]);

        try {

            $page = JssiPage::find($pageId)->first();
            $authorId = Auth::user()->id;
            $this->pService->setPageFields($page, $request, $authorId);

            return redirect(route('admin.pages.index'))
                ->with('success', __(`Sucessfuly updated page: $page->title`));

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());

        }

    }

    public function create()
    {
        return view('jssi.admin.content.pages.create');
    }

    public function destroy(Request $request)
    {
        try {
            $page = JssiPage::find($request->id);
            $page->delete();

            return redirect()->route('admin.pages.index')->with('success', __('Page deleted sucessfuly'));

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());

        }
    }

    public function slugify(Request $request)
    {
        $title = str($request->title);
        return response()->json(['slug' => Str::slug($title)]);
    }
}
