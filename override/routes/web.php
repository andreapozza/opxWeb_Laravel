<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('cms')->group(function() {
  Route::get('gino', function() {
    return Inertia::render('Home');
  });
});