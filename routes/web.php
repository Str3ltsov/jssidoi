<?php

use App\Http\Controllers\JssiIssuesController;
use App\Http\Controllers\JssiArticlesController;
use App\Http\Controllers\JssiAuthorsController;
use App\Http\Controllers\JssiInstitutionsController;
use App\Http\Controllers\JssiKeywordsController;
use App\Http\Controllers\JssiCountriesController;
use App\Http\Controllers\JssiFundersController;
use App\Http\Controllers\Admin\AdminHomeController;
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
Route::get('/', fn() => view('welcome'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Jssi routes
 */
Route::prefix('jssi')->group(function() {
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
    Route::prefix('admin')->middleware('auth:sanctum')->group(function() {
        Route::get('/', [AdminHomeController::class, 'index']);
    });
});
