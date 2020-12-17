<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Apms;
use App\Http\Livewire\AreaApms;
use App\Http\Livewire\KriteriaApms;
use App\Http\Livewire\FIleUpload;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    // Route::get('/dashboard', function() {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('file-upload', FIleUpload::class)->name('file-upload');
    Route::get('dashboard', Apms::class)->name('dashboard');
    Route::get('apms', Apms::class)->name('apms');
    Route::get('area-apms', AreaApms::class)->name('area-apms'); //Tambahkan routing ini
    Route::get('kriteria-apms', KriteriaApms::class)->name('kriteria-apms');
});