<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/{slug}', function ($slug) {
    return view($slug);
});
