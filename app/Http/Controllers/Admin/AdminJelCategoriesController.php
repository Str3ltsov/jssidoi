<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCategory;
use Illuminate\Http\Request;

class AdminJelCategoriesController extends Controller
{
    public function index()
    {
        $categories = JssiJELCategory::paginate(20);

        return view('jssi.admin.pages.papers.jel.categories.show', compact('categories'));
    }

    public function create()
    {
        return view('jssi.admin.pages.papers.jel.categories.create');
    }

    public function edit(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|string|max:1',
            'description' => 'required|string',
        ]);

        $jelCategory = JssiJELCategory::findOrFail($category);

        $jelCategory->fill($request->only([
            'name',
            'description',
        ]));

        $jelCategory->update();
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:1',
            'description' => 'required|string',
        ]);

        $category = new JssiJELCategory();

        $category->fill($request->only([
            'name',
            'description',
        ]));

        $category->save();

        return redirect()->route('jssi.admin.jel.categories.index')->with('success', 'JEL Code category created sucessfuly!');
    }

    public function update(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|string|max:1',
            'description' => 'required|string',
        ]);

        $jelCategory = JssiJELCategory::findOrFail($category);

        $jelCategory->fill($request->only([
            'name',
            'description',
        ]));

        $jelCategory->saveOrFail();

        return redirect()->route('jssi.admin.jel.categories.index')->with('success', sprintf('Category %s update succesfully!', $jelCategory->name));

    }

    public function destroy($request)
    {

    }
}
