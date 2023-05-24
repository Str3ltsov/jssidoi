<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCategory;
use App\Models\JssiJELSubcategory;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminJelSubcategoriesController extends Controller
{
    public function index()
    {
        $subcategories = JssiJELSubcategory::paginate(20);

        return view('jssi.admin.pages.papers.jel.subcategories.show', compact('subcategories'));
    }

    public function create()
    {
        $jelCategories = JssiJELCategory::all();

        return view('jssi.admin.pages.papers.jel.subcategories.create', compact('jelCategories'));
    }

    public function edit($id)
    {
        $jelCategories = JssiJELCategory::all();
        $jelSubcategory = JssiJELSubcategory::findOrFail($id);
        // dd($jelSubcategory);

        return view('jssi.admin.pages.papers.jel.subcategories.edit', compact('jelSubcategory', 'jelCategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:3',
            'description' => 'required|string',
            'jel_category_id' => 'required|integer',
        ]);

        $subcategory = new JssiJELSubcategory();

        $subcategory->fill($request->only([
            'name',
            'description',
            'jel_category_id',
        ]));

        $subcategory->saveOrFail();

        return redirect()->route('jssi.admin.jel.subcategories.index')->with('success', 'Subcategory created successfuly!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:3',
            'description' => 'required|string',
            'jel_category_id' => 'required|integer',
        ]);

        $subcategory = JssiJELCategory::findOrFail($id);

        $subcategory->fill($request->only([
            'name',
            'description',
            'jel_category_id',
        ]));

        $subcategory->updateOrFail();

        return redirect()->route('jssi.admin.jel.subcategories.index')->with('success', 'Subcategory updated successfuly!');
    }

    public function destroy(Request $request)
    {
        try {
            $subcategory = JssiJELSubcategory::findOrFail($request->id);

            $subcategory->delete();

        } catch (QueryException $e) {
            if ($e->getCode() == 23000)
                return redirect()->route('jssi.admin.jel.subcategories.index')->with('error', 'Error: This sub-category can not be deleted, because this sub-category has linked codes. Delete linked codes first.');
            return redirect()->route('jssi.admin.jel.categories.index')->with('error', 'Error: Sub-Category deletion failed.');
        }

        return redirect()->route('jssi.admin.jel.subcategories.index')->with('success', 'Sub-category deleted successfuly!');



    }
}