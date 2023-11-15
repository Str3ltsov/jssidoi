<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiReview;
use App\Services\JssiReviewsService;
use Illuminate\Http\Request;

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
        $request->validate([
            'articleId' => 'required|integer',
        ]);

        $review = new JssiReview();

        $review->author_id = $request->user()->id;
        $review->title = $request->input('title');
        $review->article_id = $request->input('articleId');
        $review->content = $request->input('content');
        $review->isVisible = true;
        $review->saveOrFail();

        return redirect()->route('jssi.admin.countries')->with('success', sprintf('Review for %s created successfully!', $review->article->title));
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
