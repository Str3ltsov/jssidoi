<?php

use App\Http\Controllers\JssiIssuesController;

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
    Route::get('/', fn() => redirect()->route('jssiIssues'));
    Route::get('/papers/issues', [JssiIssuesController::class, 'index'])->name('jssiIssues');
    Route::get('/papers/issue/{id}', [JssiIssuesController::class, 'show'])->name('jssiIssue');
});
