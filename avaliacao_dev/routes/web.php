<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [C\HomeController::class, 'main'])->name('main');

Route::post('/upload', [C\StorageController::class, 'upload'])->name('upload');
