<?php
use App\Http\Controllers\mainController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[mainController::class,'index']);
Route::prefix('team')->group( function(){
    Route::post('/create',[mainController::class,'create']);
    Route::post('/update/{id}',[mainController::class,'update']);
    Route::delete('/delete/{id}',[mainController::class,'delete']);
    Route::get('/find/{id}',[mainController::class,'find']);
    Route::get('/search',[mainController::class,'search'])->name('search');
    Route::get('/export',[mainController::class,'export']);
    Route::get('/sortIdaz',[mainController::class,'sortIdaz']);
    Route::get('/sortIdza',[mainController::class,'sortIdza']);
    Route::get('/sortNameaz',[mainController::class,'sortNameaz']);
    Route::get('/sortNameza',[mainController::class,'sortNameza']);
});