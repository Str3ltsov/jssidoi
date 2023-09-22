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

    public function show($pageId)
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
        ]);

        try {
            $page = new JssiPage();

            $slug = $request->input('slug');

            if (empty($slug)) {
                $slug = Str::slug($request->input('title'));

            }
            $page->slug = $slug;
            $page->author = Auth::user()->id;
            $page->fill($request->only(['title', 'content']));

            $page->save();

            return redirect(route('admin.pages.index'))
                ->with('success', __('Sucessfuly created page'));

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());

        }

    }

    public function create()
    {
        return view('jssi.admin.content.pages.create');
    }
}
