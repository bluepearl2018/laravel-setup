<?php

Route::middleware(['web', 'auth:admin'])->get('/setup/setup/config', function(){
	return view('setup::config');
})->name('setup.setup.config');