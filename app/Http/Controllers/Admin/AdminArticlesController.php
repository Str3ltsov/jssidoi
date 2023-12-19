<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiArticle;
use App\Models\JssiArticleType;
use App\Models\JssiAuthorsInstitution;
use App\Models\JssiIssue;
use App\Models\JssiJELCode;
use App\Services\JssiArticleService;
use App\Services\JssiAuthorService;
use App\Services\KeywordService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminArticlesController extends Controller
{

    protected $keywordService;
    protected $articleService;

    public function __construct(KeywordService $keywordService, JssiArticleService $articleService, JssiAuthorService $authorService)
    {
        $this->keywordService = $keywordService;
        $this->articleService = $articleService;
    }

    private $fields = [
        'issue_id',
        'article_type_id',
        'title',
        'abstract',
        'received',
        'accepted',
        'start_page',
        'end_page',
        'doi',
        'hal',
    ];

    protected function getValidationRules(): array
    {
        return [
            'issue_id' => 'required|integer',
            'article_type_id' => 'required|integer',
            'title' => 'required|string',
            'abstract' => 'nullable|string',
            'received' => 'nullable|date',
            'accepted' => 'nullable|date',
            'start_page' => 'numeric|min:0',
            'end_page' => 'numeric|min:0',
            'doi' => 'nullable|string',
            'hal' => 'nullable|string',
            'authorInstitutions' => 'nullable|array',
            'articleFile' => 'filled|mimes:pdf',
            'keywords' => 'string',
            'jelCodes' => 'array',
        ];
    }

    public function index()
    {
        $user = Auth::user();
        // dd($user->getRoleNames());
        if ($user->hasRole(['Admin', 'Super Admin'])) {
            $articles = JssiArticle::paginate(20);
            return view('jssi.admin.pages.papers.articles', compact('articles'));

        } else if ($user->hasRole('Author')) {


            // need to sync user & author
            //     $author = $user
            // $articles = $this->authorService->getCollectionArticles($author);
            $articles = JssiArticle::paginate(20);
            return view('jssi.admin.pages.papers.articles', compact('articles'));

        } else {
            return view('jssi.admin.index');
        }
    }

    public function edit($id)
    {
        $article = JssiArticle::findOrFail($id);
        $issues = JssiIssue::all()->reverse();
        $types = JssiArticleType::all();
        $authorsInstitutions = JssiAuthorsInstitution::with('author', 'institution')->get();
        $jelCodes = JssiJELCode::all();
        $keywords = $this->keywordService->getKeywordList($id);

        $selectedJelCodes = $article->jelCodes()->pluck('jel_code_id')->toArray();

        $selectedAuthorInstitutionIds = $article->articlesAuthorsInstitutions->pluck('authors_institution_id')->toArray();
        return view(
            'jssi.admin.pages.papers.articles.edit',
            compact(
                'article',
                'issues',
                'types',
                'authorsInstitutions',
                'selectedAuthorInstitutionIds',
                'jelCodes',
                'selectedJelCodes',
                'keywords'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->getValidationRules());

        $article = JssiArticle::findOrFail($id);

        $article->fill($request->only($this->fields));

        $this->articleService->handleJelCodes($article, $request->input('jelCodes', []));
        $this->articleService->handleAuthors($article, $request->input('authorInstitutions', []));
        $this->keywordService->handleKeywords($article, $request->input('keywords'));

        if ($request->hasFile('articleFile')) {
            $article->file = $this->articleService->handleFileUpload($article, $request->file('articleFile'));
        }

        $article->visible = (bool) $request->input('articleVisibleSwitch');

        $article->update();

        return redirect()->route('jssi.admin.articles')->with('success', sprintf('Article %s updated successfully!', $article->title));
    }

    public function create()
    {
        $issues = JssiIssue::all()->reverse();
        $types = JssiArticleType::all();
        $jelCodes = JssiJELCode::all();
        $authorsInstitutions = JssiAuthorsInstitution::with('author', 'institution')->get();
        return view('jssi.admin.pages.papers.articles.create', compact('issues', 'types', 'authorsInstitutions', 'jelCodes'));
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $article = new JssiArticle();

        $article->fill($request->only($this->fields));

        $article->save();

        $this->articleService->handleJelCodes($article, $request->input('jelCodes', []));
        $this->articleService->handleAuthors($article, $request->input('authorInstitutions', []));
        $this->keywordService->handleKeywords($article, $request->input('keywords'));

        if ($request->hasFile('articleFile')) {

            $article->file = $this->articleService->handleFileUpload($article, $request->file('articleFile'));
        }

        $article->visible = (bool) $request->input('articleVisibleSwitch');

        $article->update();

        return redirect()->route('jssi.admin.articles')->with('success', sprintf('Article %s created successfully!', $article->title));

    }

    public function destroy(Request $request)
    {
        try {
            $article = JssiArticle::findOrFail($request->id);
            $article->delete();
        } catch (Exception $e) {
            return redirect()->route('jssi.admin.articles')->with('error', $e->getMessage());
        }

        return redirect()->route('jssi.admin.articles')->with('success', 'Article deleted successfuly!');
    }
}
