<?php

/*
|--------------------------------------------------------------------------
| Frontend Welcome Page
|--------------------------------------------------------------------------
|
*/


Route::middleware(['web'])->group(function () {

	Route::any('installation/warning/{$message}', function ($message = NULL) {
		return view('frontend::layouts.master', ['message' => $message]);
	})->name('installation.warning');

});