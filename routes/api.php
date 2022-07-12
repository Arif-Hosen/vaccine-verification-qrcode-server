<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ServicesContriller;
use App\Http\Controllers\API\TestimonialsController;
use App\Http\Controllers\API\HeaderController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\PdfController;
use App\Http\Controllers\PdfForm;

// View
Route::get('view-header', [HeaderController::class, 'index']);
Route::get('view-about', [AboutController::class, 'index']);
Route::get('register', [AuthController::class, 'index']);
Route::get('view-services', [ServicesContriller::class, 'index']);
Route::get('view-blog', [BlogController::class, 'index']);
Route::get('view-testimonials', [TestimonialsController::class, 'index']);
Route::get('view-team', [TeamController::class, 'index']);
Route::get('view-pdf', [PdfController::class, 'index']);


// Register
// route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Log Out
Route::get('/checkingAuthenticated', function () {
    return response()->json(['message'=>'you are in', 'status'=>200], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);



// Route::middleware('auth:sanctum')->group(function(){
// });
//Header

Route::post('/store-header', [HeaderController::class, 'store']);

Route::delete('/delete-header/{id}', [HeaderController::class, 'destroy'] );

// About Us
Route::post('/store-about', [AboutController::class, 'store']);
Route::delete('/delete-about/{id}', [AboutController::class, 'destroy'] );
Route::get('/edit-about/{id}', [AboutController::class, 'edit'] );

// Services
Route::post('/store-services', [ServicesContriller::class, 'store']);

// Route::get('edit-services/{id}', [ServicesContriller::class, 'edit'] );
Route::delete('/delete-services/{id}', [ServicesContriller::class, 'destroy'] );

// Blogs

Route::post('/store-blog', [BlogController::class, 'store']);

Route::delete('/delete-blog/{id}', [BlogController::class, 'destroy'] );

// Testimonials

Route::post('/store-testimonials', [TestimonialsController::class, 'store']);

Route::delete('/delete-testimonials/{id}', [TestimonialsController::class, 'destroy'] );

});

//Our Team

Route::post('/store-team', [TeamController::class, 'store']);

Route::delete('/delete-team/{id}', [TeamController::class, 'destroy'] );

//pdf
Route::post('/store-pdf', [PdfController::class, 'store']);
Route::get('/verify', [PdfController::class, 'index'] );

// Route::get('/test',[PdfForm::class , 'testing']);


