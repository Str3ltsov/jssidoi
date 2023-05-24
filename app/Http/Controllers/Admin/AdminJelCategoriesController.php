<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

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

    public function edit($id)
    {
        $jelCategory = JssiJELCategory::findOrFail($id);

        return view('jssi.admin.pages.papers.jel.categories.edit', compact('jelCategory'));
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:1',
            'description' => 'required|string',
        ]);

        $jelCategory = JssiJELCategory::findOrFail($id);

        $jelCategory->fill($request->only([
            'name',
            'description',
        ]));

        $jelCategory->saveOrFail();

        return redirect()->route('jssi.admin.jel.categories.index')->with('success', sprintf('Category %s update succesfully!', $jelCategory->name));

    }

    public function destroy(Request $request)
    {
        try {
            $jelCategory = JssiJELCategory::findOrFail($request->id);
            $jelCategory->delete();
            return redirect()->route('jssi.admin.jel.categories.index')->with('success', 'JEL Category deleted successfully!');

        } catch (QueryException $e) {
            if ($e->getCode() == 23000)
                return redirect()->route('jssi.admin.jel.categories.index')->with('error', 'Error: This category can not be deleted, because this category has linked codes. Delete linked codes first.');
            return redirect()->route('jssi.admin.jel.categories.index')->with('error', 'Error: Category deletion failed.');
        }
    }
}