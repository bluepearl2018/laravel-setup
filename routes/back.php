<?php

/**
 * -----------------------------------------------------------------------------*
 * BACK ROUTES
 * -----------------------------------------------------------------------------*
 * All back routes MUST be called after the 'web' middleware
 * Otherwise, errors, eloquent models... won't be magically displayed
 */
Route::middleware(['web', 'auth::admin'])->name('setup.')->prefix('setup')->group(function () {

});