<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiReview;
use App\Services\JssiReviewsService;
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
        $request->validate([
            'articleId' => 'required|integer',
        ]);

        $review = JssiReview::find($id);

        $review->title = $request->input('title');
        $review->article_id = $request->input('articleId');
        $review->content = $request->input('content');
        $review->isVisible = true;
        $review->saveOrFail();

        return redirect()->route('jssi.admin.countries')->with('success', sprintf('Review for %s updated successfully!', $review->article->title));
    }
}
