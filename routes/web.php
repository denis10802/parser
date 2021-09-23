<?php

use App\Http\Controllers\GetApiResponsesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeUpdateController;
use App\Models\Notice;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\NoticeResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function (){
    Route::get('/title',[GetApiResponsesController::class,'get_title']);
});



Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('/update',[NoticeUpdateController::class,'update'])->name('update');

