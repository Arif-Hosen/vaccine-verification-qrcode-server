<?php

use App\Http\Controllers\PdfForm;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->to('https://touchandsolve.com/');
// });

Route::get('/', function () {
    return view('welcome');
});

// test

// Route::get('/test',[PdfForm::class , 'testing']);
Route::post('/test',[PdfForm::class , 'store']);
