<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;

//นักอ่าน
Route::get('/', [BlogController::class,'index']);
Route::get('/detail/{id}',[BlogController::class,'detail']);
//นักเขียน
Route::prefix('author')->group(function(){
    Route::get('/blog',[AdminController::class,'index'])->name('blog');

    Route::get('/create',[AdminController::class,'create']);
    Route::post('/insert',[AdminController::class,'insert']);

    Route::get('/delete/{id}',[AdminController::class,'delete'])->name('delete');

    Route::get('/change/{id}',[AdminController::class,'change'])->name('change');

    Route::get('/edit/{id}',[AdminController::class,'edit'])->name('edit');
    Route::post('/update/{id}',[AdminController::class,'update'])->name('update');
});

Route::get('/about',[AdminController::class,'about'])->name('about');


Route::fallback(function(){
    return "<h1>ไม่มีหน้านี้ใน My Project</h1>";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
