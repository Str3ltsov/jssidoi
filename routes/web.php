<?php

use App\Http\Controllers\JssiIssuesController;
use App\Http\Controllers\JssiPapersController;
use App\Http\Controllers\JssiAuthorsController;
use App\Http\Controllers\JssiInstitutionsController;

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
    Route::get('/issues/{id}/papers', [JssiIssuesController::class, 'show'])->name('jssiIssue');
    // Papers
    Route::get('/papers', [JssiPapersController::class, 'index'])->name('jssiPapers');
    Route::get('/papers/{id}', [JssiPapersController::class, 'show'])->name('jssiPaper');
    // Authors
    Route::get('/authors', [JssiAuthorsController::class, 'index'])->name('jssiAuthors');
    Route::get('/authors/{id}/papers', [JssiAuthorsController::class, 'show'])->name('jssiAuthor');
    // Institutions
    Route::get('/institutions', [JssiInstitutionsController::class, 'index'])->name('jssiInstitutions');
});
