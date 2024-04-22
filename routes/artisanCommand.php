<?php

use Illuminate\Support\Facades\Route;

//Runing migrattion
Route::get('/migrate', function () {
    \Artisan::call('migrate');
    dd('migrated!');
});

//Clear route cache
Route::get('/route-cache', function () {
    \Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache
Route::get('/config-cache', function () {
    \Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache
Route::get('/clear-cache', function () {
    \Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache
Route::get('/view-clear', function () {
    \Artisan::call('view:clear');
    return 'View cache cleared';
});

// Clear cache using reoptimized class
Route::get('/optimize-clear', function () {
    \Artisan::call('optimize:clear');
    return 'View cache cleared';
});
