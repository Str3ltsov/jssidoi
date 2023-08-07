<?php

use App\Http\Controllers\Admin\AdminArticlesController;
use App\Http\Controllers\Admin\AdminAuthorsController;
use App\Http\Controllers\Admin\AdminCountriesController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminInstitutionsController;
use App\Http\Controllers\Admin\AdminIssuesController;
use App\Http\Controllers\admin\AdminJelCategoriesController;
use App\Http\Controllers\Admin\AdminJelCodesController;
use App\Http\Controllers\admin\AdminJelSubcategoriesController;
use App\Http\Controllers\Admin\AdminKeywordsController;
use App\Http\Controllers\Admin\AdminLinksController;
use App\Http\Controllers\Admin\AdminMenusController;
use App\Http\Controllers\Admin\AdminSubmitsController;
use App\Http\Controllers\JssiArticlesController;
use App\Http\Controllers\JssiAuthorsController;
use App\Http\Controllers\JssiCountriesController;
use App\Http\Controllers\JssiFundersController;
use App\Http\Controllers\JssiInstitutionsController;
use App\Http\Controllers\JssiIssuesController;
use App\Http\Controllers\JssiKeywordsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

/*
 * Default
 */

Route::get('/', fn () => redirect()->route('jssiIssues'));

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

/*
 * Jssi routes
 */
Route::prefix('jssi')->group(function () {
    // Issues
    Route::get('/', fn () => redirect()->route('jssiIssues'));
    Route::get('/issues', [JssiIssuesController::class, 'index'])->name('jssiIssues');
    Route::get('/issues/{id}/articles', [JssiIssuesController::class, 'show'])->name('jssiIssue');
    // Papers
    Route::get('/articles', [JssiArticlesController::class, 'index'])->name('jssiArticles');
    Route::get('/articles/{id}', [JssiArticlesController::class, 'show'])->name('jssiArticle');
    // Authors
    Route::get('/authors', [JssiAuthorsController::class, 'index'])->name('jssiAuthors');
    Route::get('/authors/{id}/articles', [JssiAuthorsController::class, 'show'])->name('jssiAuthor');
    // Institutions
    Route::get('/institutions', [JssiInstitutionsController::class, 'index'])->name('jssiInstitutions');
    Route::get('/institutions/{id}/articles', [JssiInstitutionsController::class, 'show'])->name('jssiInstitution');
    // Keywords
    Route::get('/keywords', [JssiKeywordsController::class, 'index'])->name('jssiKeywords');
    Route::get('/keywords/{id}/articles', [JssiKeywordsController::class, 'show'])->name('jssiKeyword');
    // Countries
    Route::get('/countries', [JssiCountriesController::class, 'index'])->name('jssiCountries');
    Route::get('/countries/{id}/articles', [JssiCountriesController::class, 'show'])->name('jssiCountry');
    // Funders
    Route::get('/funders', [JssiFundersController::class, 'index'])->name('jssiFunders');
    Route::get('/funders/{id}/articles', [JssiFundersController::class, 'show'])->name('jssiFunder');
    /*
     * Admin routes
     */
    Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
        // Home
        Route::get('/', [AdminHomeController::class, 'index'])->name('jssi.admin.home');
        /*
         * Paper routes
         */
        Route::prefix('papers')->group(function () {
            // Articles
            Route::get('/', [AdminArticlesController::class, 'index'])->name('jssi.admin.articles');
            Route::get('/{id}/edit', [AdminArticlesController::class, 'edit'])->name('jssi.admin.articles.edit');
            Route::get('/add', [AdminArticlesController::class, 'create'])->name('jssi.admin.articles.create');
            Route::post('/', [AdminArticlesController::class, 'store'])->name('jssi.admin.articles.store');
            Route::put('/{id}', [AdminArticlesController::class, 'update'])->name('jssi.admin.articles.update');
            Route::delete('/{id}', [AdminArticlesController::class, 'destroy'])->name('jssi.admin.articles.destroy');
            // Issues
            Route::get('issues', [AdminIssuesController::class, 'index'])->name('jssi.admin.issues');
            Route::get('issues/{id}/edit', [AdminIssuesController::class, 'edit'])->name('jssi.admin.issues.edit');
            Route::get('issues/add', [AdminIssuesController::class, 'create'])->name('jssi.admin.issues.create');
            Route::post('issues', [AdminIssuesController::class, 'store'])->name('jssi.admin.issues.store');
            Route::put('issues/{id}', [AdminIssuesController::class, 'update'])->name('jssi.admin.issues.update');
            Route::delete('issues/{id}', [AdminIssuesController::class, 'destroy'])->name('jssi.admin.issues.destroy');
            // Authors
            Route::get('authors', [AdminAuthorsController::class, 'index'])->name('jssi.admin.authors');
            Route::get('authors/{id}/edit', [AdminAuthorsController::class, 'edit'])->name('jssi.admin.authors.edit');
            Route::get('authors/add', [AdminAuthorsController::class, 'create'])->name('jssi.admin.authors.create');
            Route::post('authors', [AdminAuthorsController::class, 'store'])->name('jssi.admin.authors.store');
            Route::put('authors/{id}', [AdminAuthorsController::class, 'update'])->name('jssi.admin.authors.update');
            Route::delete('authors/{id}', [AdminAuthorsController::class, 'destroy'])->name('jssi.admin.authors.destroy');
            // Institutions
            Route::resource('institutions', AdminInstitutionsController::class, ['as' => 'jssi.admin']);
            // Keywords
            Route::resource('keywords', AdminKeywordsController::class, ['as' => 'jssi.admin'])
                ->parameters(['keywords' => 'id']);
            // JEL-Codes
            Route::prefix('jel')->group(function () {
                Route::resource('codes', AdminJelCodesController::class, ['as' => 'jssi.admin.jel'])
                    ->parameters(['codes' => 'id']);
                Route::resource('categories', AdminJelCategoriesController::class, ['as' => 'jssi.admin.jel'])
                    ->parameters(['categories' => 'id']);
                Route::resource('subcategories', AdminJelSubcategoriesController::class, ['as' => 'jssi.admin.jel'])
                    ->parameters(['subcategories' => 'id']);
            });
            // Countries
            Route::get('countries', [AdminCountriesController::class, 'index'])->name('jssi.admin.countries');
            Route::get('countries/{id}/edit', [AdminCountriesController::class, 'edit'])->name('jssi.admin.countries.edit');
            Route::get('countries/add', [AdminCountriesController::class, 'create'])->name('jssi.admin.countries.create');
            Route::post('countries', [AdminCountriesController::class, 'store'])->name('jssi.admin.countries.store');
            Route::put('countries/{id}', [AdminCountriesController::class, 'update'])->name('jssi.admin.countries.update');
            Route::delete('countries/{id}', [AdminCountriesController::class, 'destroy'])->name('jssi.admin.countries.destroy');
            // Submits
            Route::get('/submits', [AdminSubmitsController::class, 'index'])->name('jssi.admin.submits');
        });
        /*
         * Menu routes
         */
        Route::prefix('menus')->group(function () {
            // Menus
            Route::resource('menus', AdminMenusController::class);
            // Links
            Route::resource('links', AdminLinksController::class)->except(['index, show']);
        });
    });
});
