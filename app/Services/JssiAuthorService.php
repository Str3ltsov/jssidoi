<?php

namespace App\Services;

use App\Models\JssiArticle;
use App\Models\JssiArticlesAuthorsInstitution;
use App\Models\JssiAuthor;
use Error;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class JssiAuthorService extends HelperService
{
    public final function getJssiAuthors(): object
    {
        return JssiAuthor::all();
    }

    public final function getFilteredJssiAuthors(int $paginateNum): object
    {
        return QueryBuilder::for (JssiAuthor::class)
            ->allowedSorts('first_name', 'last_name')
            ->allowedFilters([
                AllowedFilter::scope('first_name like'),
                AllowedFilter::scope('last_name like')
            ])
            ->paginate($paginateNum);
    }

    public final function getJssiAuthorById(int $id): object
    {
        $author = JssiAuthor::find($id);

        if (!$author) {
            throw new Error('Failed to find jssi author by id');
        }

        return $author;
    }


    /**
     *
     * @param JssiAuthor $author instance of current author
     * @param array $selectedInstitutions array of institutions from requrest->input
     *
     * This service function synchronizes list of institutions for selected author.
     *
     */

    public function handleInstitutionAssignment($author, $selectedInstitutions)
    {
        try {
            $current_institutions = $author->authorsInstitutions()->pluck('institution_id')->toArray();

            $institutions_to_remove = array_diff($current_institutions, $selectedInstitutions);
            $author->authorsInstitutions()->whereIn('institution_id', $institutions_to_remove)->delete();

            foreach ($selectedInstitutions as $institution_id) {
                $author->authorsInstitutions()->firstOrCreate(['institution_id' => $institution_id]);
            }

        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('jssi.admin.authors')->with('error', 'Error: Unable to remove one of author\'s institutions, because author has published articles within this institution. You have to delete this author/institution connection from associated articles first.');
            }

            return redirect()->route('jssi.admin.authors')->with('error', 'Unexpected error occured.');
        }

    }


}