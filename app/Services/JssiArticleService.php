<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiReference;
use Error;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JssiArticleService extends HelperService
{
    public final function getJssiArticles(): object
    {
        return JssiArticle::all();
    }

    public final function getJssiArticleById(int $id): object
    {
        $article = JssiArticle::find($id);

        if (!$article) {
            throw new Error('Failed to find jssi article by id');
        }

        return $article;
    }

    public final function getArticlesAuthors(object $articles): object
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

    public final function getArticleAuthorsInstitutions(object $article): object
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

    public function getReferences($article): object
    {
        return collect($article->references);
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

    public function handleReferences($article, $referenceInput)
    {
        $references = $this->getReferenceArray($referenceInput);

        $updatedReferences = [];
        $newReference = null;

        //This function fill updatedReferences[] with id of refs, that have been found or created with firstOrCreate
        foreach ($references as $reference) {
            $newReference = $article->references()->firstOrCreate([
                'reference' => $reference['reference'],
                'link' => $reference['link'],
            ]);

            $updatedReferences[] = $newReference->id;
        }

        $unusedReferences = $article->references()->whereNotIn('id', $updatedReferences)->get();
        $unusedReferences->each->delete();
    }

    public function getReferencesString($article)
    {
        $reftext = "";
        $references = $article->references()->get();
        foreach ($references as $reference) {
            $reftext .= sprintf("%s %s; ", $reference->reference, $reference->link);
        }

        return $reftext;
    }

    private function getReferenceArray($references): array
    {
        $references = explode(';', $references);
        $refArray = [];
        foreach ($references as $reference) {
            //regex to match links in text
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $reference, $match);
            $urls = $match[0];
            $reference = str_replace("'", "''", $reference);
            if (!empty($urls[0])) {
                $reference = str_replace($urls[0], "", $reference);
            } else {
                $urls[0] = null;
            }

            $reference = rtrim($reference);


            if (!empty($reference)) { // prevents empty references like "; ; ;" from being added to array
                $refArray[] = ['reference' => $reference, 'link' => $urls[0]];
            }

        }

        return $refArray;
    }



    private function sanitizeFileName($lastName, $title): string
    {
        $lastName = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $lastName);
        $title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $title);
        $title = rtrim($title, '.');

        return sprintf('%s_%s.pdf', $lastName, Str::ucfirst(Str::snake($title)));
    }
}