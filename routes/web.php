<?php

/*
|--------------------------------------------------------------------------
| Frontend Welcome Page
|--------------------------------------------------------------------------
|
*/


Route::middleware(['web'])->group(function () {
    Route::any('installation/warning/{$message}', function ($message = null) {
        return view('theme::layouts.guest', ['message' => $message]);
    })->name('installation.warning');
});
