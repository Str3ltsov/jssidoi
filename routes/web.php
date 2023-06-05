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
Route::get('/', fn() => redirect()->route('jssiIssues'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Jssi routes
 */
Route::prefix('jssi')->group(function () {
    // Issues
    Route::get('/', fn() => redirect()->route('jssiIssues'));
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
    //Admin
    Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('jssi.admin.home');
        Route::prefix('papers')->group(function () {
            //Article crud
            Route::resource(
                'articles', AdminArticlesController::class,
                [
                    'as' => 'jssi.admin',
                    'names' => ['index' => 'jssi.admin.articles']
                ],
            )->except(['show']);
            // Issues CRUD
            Route::resource('issues', AdminIssuesController::class, [
                'as' => 'jssi.admin',
                'names' => ['index' => 'jssi.admin.issues']
            ])->except(['show']);
            // Authors CRUD
            Route::resource('authors', AdminAuthorsController::class, [
                'as' => 'jssi.admin',
                'names' => ['index' => 'jssi.admin.authors']
            ])->except(['show']);

            // Institutions CRUD
            Route::resource(
                'institutions', AdminInstitutionsController::class,
                ['as' => 'jssi.admin']
            )->except(['show']);

            // JEL-Codes CRUD
            Route::prefix('jel')->group(function () {
                Route::resource('codes', AdminJelCodesController::class, [
                    'as' => 'jssi.admin.jel',
                    'names' => ['index' => 'jssi.admin.jel.codes']
                ])->parameters([
                        'codes' => 'id',
                    ])->except(['show']);
                Route::resource('categories', AdminJelCategoriesController::class, [
                    'as' => 'jssi.admin.jel',
                    'names' => ['index' => 'jssi.admin.jel.categories']
                ])->parameters([
                        'categories' => 'id',
                    ])->except(['show']);
                Route::resource('subcategories', AdminJelSubcategoriesController::class, [
                    'as' => 'jssi.admin.jel',
                    'names' => ['index' => 'jssi.admin.jel.subcategories']
                ])->parameters([
                        'subcategories' => 'id',
                    ])->except(['show']);

            });

            // Countries CRUD
            Route::resource('countries', AdminCountriesController::class, [
                'as' => 'jssi.admin',
                'names' => ['index' => 'jssi.admin.countries']
            ])->except(['show']);


            Route::resource('keywords', AdminKeywordsController::class, [
                'as' => 'jssi.admin',
            ])->parameters([
                    'keywords' => 'id',
                ])->except(['show']);
        });
    });
});