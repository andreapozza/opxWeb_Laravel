<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
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
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::get('setlocale/{locale}',function($locale){
    session(['locale' => $locale]);
    return redirect()->back();
})->name('setLocale');


Route::prefix('cms')->group(function() {
    
    Route::get('/', function() {
        return redirect()->route('dashboard');
    });
    
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard2');
    })->name('dashboard');

    Route::resource('/posts', PostController::class)->names('cms.posts');

    Route::resource('/pages', PageController::class)->names('cms.pages');

    Route::get('/login', function() {
        return Inertia::render('Login');
    });

    Route::resource('/users', UserController::class)->names('cms.users');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


// include base_path('override/routes/web.php');

