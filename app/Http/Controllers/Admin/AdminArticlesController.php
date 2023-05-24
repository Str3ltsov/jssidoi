<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JssiArticle;
use App\Models\JssiArticleType;
use App\Models\JssiAuthorsInstitution;
use App\Models\JssiIssue;
use App\Models\JssiJELCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminArticlesController extends Controller
{
    public function index()
    {
        $articles = JssiArticle::paginate(20);
        return view('jssi.admin.pages.papers.articles', compact('articles'));
    }

    public function edit($id)
    {
        $article = JssiArticle::findOrFail($id);
        $issues = JssiIssue::all()->reverse();
        $types = JssiArticleType::all();
        $authorsInstitutions = JssiAuthorsInstitution::with('author', 'institution')->get();
        $jelCodes = JssiJELCode::all();

        $selectedJelCodes = $article->jelCodes()->pluck('jel_code_id')->toArray();

        $selectedAuthorInstitutionIds = $article->articlesAuthorsInstitutions->pluck('authors_institution_id')->toArray();
        return view('jssi.admin.pages.papers.articles.edit', compact('article', 'issues', 'types', 'authorsInstitutions', 'selectedAuthorInstitutionIds', 'jelCodes', 'selectedJelCodes'));
    }

    public function update(Request $request, $id)
    {

        $article = JssiArticle::findOrFail($id);

        $request->validate([
            'issue' => 'required|integer',
            'articleType' => 'required|integer',
            'articleTitle' => 'required|string',
            'abstract' => 'nullable|string',
            'receivedDate' => 'nullable|date',
            'acceptedDate' => 'nullable|date',
            'startPage' => 'numeric|min:0',
            'endPage' => 'numeric|min:0',
            'doiCode' => 'nullable|string',
            'halCode' => 'nullable|string',
            'authorInstitutions' => 'nullable|array',
            'articleFile' => 'filled|mimes:pdf',
            'jelCodes' => 'array'
        ]);

        // dd($request);

        $article->issue_id = $request->input('issue');
        $article->article_type_id = $request->input('articleType');
        $article->title = $request->input('articleTitle');
        $article->abstract = $request->input('abstract');
        $article->received = $request->input('receivedDate');
        $article->accepted = $request->input('acceptedDate');
        $article->start_page = $request->input('startPage');
        $article->end_page = $request->input('endPage');
        $article->doi = $request->input('doiCode');
        $article->hal = $request->input('halCode');

        $article->jelCodes()->sync($request->input('jelCodes', []));

        $authorInstitutionIds = $request->input('authorInstitutions', []);

        if (!empty($authorInstitutionIds)) {
            $current_authorsInstitutions = $article->articlesAuthorsInstitutions()->pluck('authors_institution_id')->toArray();
            $selected_authorsInstitutions = $authorInstitutionIds;
            $authorsInstitutions_to_remove = array_diff($current_authorsInstitutions, $selected_authorsInstitutions);
            $maxSequence = $article->articlesAuthorsInstitutions()->max('sequence');
            // dd($authorsInstitutions_to_remove, $selected_authorsInstitutions, $current_authorsInstitutions);
            $article->articlesAuthorsInstitutions()->whereIn('authors_institution_id', $authorsInstitutions_to_remove)->delete();

            foreach ($selected_authorsInstitutions as $authorInstitution_id) {
                $maxSequence++;
                $article->articlesAuthorsInstitutions()->firstOrCreate(['authors_institution_id' => $authorInstitution_id, 'sequence' => $maxSequence]);
            }

        }

        if ($request->hasFile('articleFile')) {

            $minSequence = $article->articlesAuthorsInstitutions()->min('sequence');
            $authorLastName = $article->articlesAuthorsInstitutions()
                ->where('sequence', $minSequence)
                ->with('authorsInstitution.author')
                ->first()
                ->authorsInstitution
                ->author
                ->last_name;

            $filename = $this->sanitizeFileName($authorLastName, $request->input('articleTitle'));

            if (Storage::exists('papers/' . $filename)) {
                Storage::delete('papers/' . $filename);
            }
            $request->file('articleFile')->storeAs('issues', $filename, 'public');

            $article->file = $filename;


        }

        $article->visible = $request->input('articleVisibleSwitch') ? true : false;

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
        $request->validate([
            'issue' => 'required|integer',
            'articleType' => 'required|integer',
            'articleTitle' => 'required|string',
            'abstract' => 'nullable|string',
            'receivedDate' => 'nullable|date',
            'acceptedDate' => 'nullable|date',
            'startPage' => 'numeric|min:0',
            'endPage' => 'numeric|min:0',
            'doiCode' => 'nullable|string',
            'halCode' => 'nullable|string',
            'authorInstitutions' => 'nullable|array',
            'articleFile' => 'filled|mimes:pdf',
            'jelCodes' => 'array'
        ]);

        $article = new JssiArticle();

        $article->issue_id = $request->input('issue');
        $article->article_type_id = $request->input('articleType');
        $article->title = $request->input('articleTitle');
        $article->abstract = $request->input('abstract');
        $article->received = $request->input('receivedDate');
        $article->accepted = $request->input('acceptedDate');
        $article->start_page = $request->input('startPage');
        $article->end_page = $request->input('endPage');
        $article->doi = $request->input('doiCode');
        $article->hal = $request->input('halCode');

        $article->jelCodes()->attach($request->input('jelCodes', []));

        $article->save();

        $authorInstitutionIds = $request->input('authorInstitutions', []);

        if (!empty($authorInstitutionIds)) {
            $current_authorsInstitutions = $article->articlesAuthorsInstitutions()->pluck('authors_institution_id')->toArray();
            $selected_authorsInstitutions = $authorInstitutionIds;
            $authorsInstitutions_to_remove = array_diff($current_authorsInstitutions, $selected_authorsInstitutions);
            $maxSequence = $article->articlesAuthorsInstitutions()->max('sequence');
            // dd($authorsInstitutions_to_remove, $selected_authorsInstitutions, $current_authorsInstitutions);
            $article->articlesAuthorsInstitutions()->whereIn('authors_institution_id', $authorsInstitutions_to_remove)->delete();

            foreach ($selected_authorsInstitutions as $authorInstitution_id) {
                $maxSequence++;
                $article->articlesAuthorsInstitutions()->firstOrCreate(['authors_institution_id' => $authorInstitution_id, 'sequence' => $maxSequence]);
            }

        }

        if ($request->hasFile('articleFile')) {

            $minSequence = $article->articlesAuthorsInstitutions()->min('sequence');
            $authorLastName = $article->articlesAuthorsInstitutions()
                ->where('sequence', $minSequence)
                ->with('authorsInstitution.author')
                ->first()
                ->authorsInstitution
                ->author
                ->last_name;

            $filename = $this->sanitizeFileName($authorLastName, $request->input('articleTitle'));

            if (Storage::exists('papers/' . $filename)) {
                Storage::delete('papers/' . $filename);
            }
            $request->file('articleFile')->storeAs('issues', $filename, 'public');

            $article->file = $filename;
        }

        $article->visible = $request->input('articleVisibleSwitch') ? true : false;

        $article->save();

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

    public function sanitizeFileName($lastName, $title): string
    {
        $lastName = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $lastName);
        $title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $title);
        $title = rtrim($title, '.');

        return sprintf('%s_%s.pdf', $lastName, Str::ucfirst(Str::snake($title)));
    }
}