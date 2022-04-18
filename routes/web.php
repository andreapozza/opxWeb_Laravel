<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('non-inertia');

Route::get('setlocale/{locale}',function($locale){
    session(['locale' => $locale]);
    return redirect()->back();
})->name('setLocale');


Route::prefix('cms')->middleware(['auth:sanctum', 'verified'])->group(function() {
    
    Route::get('/', function() {
        return redirect()->route('dashboard');
    });
    
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/posts', PostController::class)->names('cms.posts');

    Route::resource('/pages', PageController::class)->names('cms.pages');

    Route::resource('/users', UserController::class)->names('cms.users');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard-2');
})->name('dashboard-jetstream');


// include base_path('override/routes/web.php');

