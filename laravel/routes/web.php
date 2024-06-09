<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [DataController::class, 'showData']);

Route::get('/login', [DataController::class,'login']);

Route::get('/showlogindetails', [DataController::class, 'showlogindetails']);

Route::post('/logindetails', [DataController::class, 'logincredentials']);

