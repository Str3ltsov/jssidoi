<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiReview;
use App\Services\JssiReviewsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReviewsController extends Controller
{
    public function __construct(public JssiReviewsService $rService)
    {

    }

    public function index()
    {
        return view('jssi.admin.pages.papers.reviews')->with('reviews', $this->rService->getPaginatedReviews(20));
    }

    public function create()
    {
        return view('jssi.admin.pages.papers.reviews.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|numeric',
            'evaluation' => 'required',
            'originality' => 'required',
            'methodology' => 'required',
            'structure' => 'required',
            'language' => 'required',
            'advice' => 'required',
            'generalComment' => 'required',
        ]);

        $review = new JssiReview($validatedData);
        $review->reviewer_id = Auth::user()->id;

        $review->save();
        return redirect()->route('jssi.admin.reviews.index')->with('success', sprintf('Review for %s created successfully!', $review->article->title));
    }

    public function edit($id)
    {
        return view('jssi.admin.pages.papers.reviews.edit')->with('review', JssiReview::find($id));

    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'article_id' => 'required|numeric',
            'evaluation' => 'required',
            'originality' => 'required',
            'methodology' => 'required',
            'structure' => 'required',
            'language' => 'required',
            'advice' => 'required',
            'generalComment' => 'required',
        ]);

        $review = JssiReview::find($id);
        $review->update($validatedData);

        $review->reviewer_id = Auth::user()->id;

        $review->save();
        return redirect()->route('jssi.admin.reviews.index')->with('success', sprintf('Review for %s created successfully!', $review->article->title));

    }

    public function destroy(Request $req): RedirectResponse
    {
        $review = JssiReview::findOrFail($req->id);
        $review->delete();
        // dd($review);

        return redirect()->route('jssi.admin.reviews.index')->with('success', sprintf('Review deleted successfully!'));

    }
}
