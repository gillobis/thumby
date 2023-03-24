<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThumbnailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    echo "<img src='http://thumby.test/api/thumbnails/98c3cee8-2454-4eb8-be42-a0f1bc5df34b'/>";
});


Route::post('thumbnails', [ThumbnailController::class, 'store']);
Route::get('thumbnails/{thumbnail}', [ThumbnailController::class, 'show']);