<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [DataController::class, 'showData']);