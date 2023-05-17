<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JssiJELCategory;
use App\Models\JssiJELSubcategory;
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
}
