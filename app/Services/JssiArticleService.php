<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiReview;
use Error;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JssiArticleService extends HelperService
{
    final public function getJssiArticles(): object
    {
        return JssiArticle::all();
    }

    final public function getJssiArticleById(int $id): object
    {
        $article = JssiArticle::find($id);

        if (!$article) {
            throw new Error('Failed to find jssi article by id');
        }

        return $article;
    }

    final public function getArticlesAuthors(object $articles): object
    {
        $articlesAuthors = [];

        foreach ($articles as $article) {
            $authors = [];

            foreach ($article->articlesAuthorsInstitutions as $articlesAuthorsInstitution) {
                $authors[] = $articlesAuthorsInstitution->authorsInstitution->author;
            }

            $articlesAuthors[$article->id] = $authors;
        }

        return collect($articlesAuthors);
    }

    final public function getReview($id)
    {

        $review = JssiReview::where('article_id', '=', $id)->first();

        return $review;
    }
    final public function getArticleAuthorsInstitutions(object $article): object
    {
        $authorsInstitutions = [];

        foreach ($article->articlesAuthorsInstitutions as $articlesAuthorsInstitution) {
            $authorsInstitutions[] = $articlesAuthorsInstitution->authorsInstitution;
        }

        return collect($authorsInstitutions);
    }

    public function paginateCollection(
        object $collection, int $paginateNum, string $orderVar = 'id', string $orderDir = 'asc'
    ): object {
        return $collection->toQuery()->orderBy($orderVar, $orderDir)->paginate($paginateNum);
    }

    public function getJelCodes(object $article): object
    {
        $jelCodes = $article->jelCodes;
        return collect($jelCodes);
    }

    /**
     * @param object $article Article object
     * @param string $articleTitle Title of article
     * @param object $file File object from request
     *
     * @return string Name of created file
     */
    public function handleFileUpload(JssiArticle $article, $file): string
    {
        $minSequence = $article->articlesAuthorsInstitutions()->min('sequence');
        $authorLastName = $article->articlesAuthorsInstitutions()
            ->where('sequence', $minSequence)
            ->with('authorsInstitution.author')
            ->first()
            ->authorsInstitution
            ->author
            ->last_name;

        $articleTitle = $article->title;

        $filename = $this->sanitizeFileName($authorLastName, $articleTitle);

        if (Storage::exists('papers/' . $filename)) {
            Storage::delete('papers/' . $filename);
        }
        $file->storeAs('issues', $filename, 'public');

        return $filename;

    }

    public function handleAuthors($article, $authorInstitutionIds)
    {
        $current_authorsInstitutions = $article->articlesAuthorsInstitutions()->pluck('authors_institution_id')->toArray();
        $selected_authorsInstitutions = $authorInstitutionIds;
        $authorsInstitutions_to_remove = array_diff($current_authorsInstitutions, $selected_authorsInstitutions);
        $maxSequence = $article->articlesAuthorsInstitutions()->max('sequence') || 0;
        $article->articlesAuthorsInstitutions()->whereIn('authors_institution_id', $authorsInstitutions_to_remove)->delete();

        foreach ($selected_authorsInstitutions as $authorInstitution_id) {
            $maxSequence++;
            $article->articlesAuthorsInstitutions()->firstOrCreate(['authors_institution_id' => $authorInstitution_id, 'sequence' => $maxSequence]);
        }

        $article->update();
    }

    public function handleJelCodes(JssiArticle $article, array $jelCodes)
    {
        $article->jelCodes()->sync($jelCodes);
    }

    private function sanitizeFileName($lastName, $title): string
    {
        $lastName = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $lastName);
        $title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $title);
        $title = rtrim($title, '.');

        return sprintf('%s_%s.pdf', $lastName, Str::ucfirst(Str::snake($title)));
    }
}
