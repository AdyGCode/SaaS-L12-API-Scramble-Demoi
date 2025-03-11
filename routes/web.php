<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('docs/api');
    //return view('welcome');
});

Route::get('/api', function () {
    return redirect('docs/api');
    //return view('welcome');
});
