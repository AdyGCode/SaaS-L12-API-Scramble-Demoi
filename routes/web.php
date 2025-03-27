<?php

use Illuminate\Support\Facades\Route;

Route::get('/docs', function () {
    return redirect('docs/v2');
    //return view('welcome');
});

Route::get('/api', function () {
    return redirect('docs/v2');
});
