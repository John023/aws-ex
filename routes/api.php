<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('/document', 'DocumentsController@store')->name('documents.store');
Route::post('document', 'DocumentsController@store')->name('documents.store');

Route::get('/documents', function (Request $request) {
    return 'ew';
})->name('documents.index');
