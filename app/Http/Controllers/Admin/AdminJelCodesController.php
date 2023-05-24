<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JssiJELCodeController;
use App\Models\JssiJELCode;
use App\Models\JssiJELSubcategory;
use Exception;
use Illuminate\Http\Request;

class AdminJelCodesController extends Controller
{
    public function index()
    {
        $jelCodes = JssiJELCode::paginate(20);
        return view('jssi.admin.pages.papers.jel.codes.show', compact('jelCodes'));
    }

    public function create()
    {
        $subcategories = JssiJELSubcategory::all();


        return view('jssi.admin.pages.papers.jel.codes.create', compact('subcategories'));
    }

    public function edit($id)
    {
        $subcategories = JssiJELSubcategory::all();
        $jelCode = JssiJELCode::findOrFail($id);

        return view('jssi.admin.pages.papers.jel.codes.edit', compact('jelCode', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:3',
            'description' => 'required|string',
            'jel_subcategory_id' => 'required|integer',
        ]);

        $jelCode = new JssiJELCode();

        $jelCode->fill($request->only([
            'name',
            'description',
            'jel_subcategory_id'
        ]));

        $jelCode->save();

        return redirect()->route('jssi.admin.jel.codes.index')->with('success', 'Jel Code created successfuly!');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:3',
            'description' => 'required|string',
            'jel_subcategory_id' => 'required|integer',
        ]);

        $jelCode = JssiJELCode::findOrFail($id);

        $jelCode->fill($request->only([
            'name',
            'description',
            'jel_subcategory_id'
        ]));

        $jelCode->update();

    }

    public function destroy(Request $request)
    {
        try {

            $jelCode = JssiJELCode::findOrFail($request->id);
            $jelCode->delete();

            return redirect()->route('jssi.admin.jel.codes.index')->with('success', 'JEL Code deleted successfully!');
        } catch (Exception $e) {
            return redirect()->route('jssi.admin.jel.codes.index')->with('error', 'JEL Code deletion failed.');
        }
    }


}