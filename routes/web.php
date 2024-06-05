<?php

// Lama ----------------------------------------------------------------
// use App\Http\Controllers\DownloadPdfController;
// use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return Redirect::guest('admin');
// })->name('home');
// Route::get('/{record}/pdf/download', [DownloadPdfController::class, 'download'])->name('datapmi.pdf.download');
// Route::get('/data-pmi/{record}', [DownloadPdfController::class, 'download'])->name('data-pmi.download');

// Baru ----------------------------------------------------------------


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DownloadPdfController;
use App\Http\Controllers\BIODATAController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;





Route::get('/', function () {
    return Redirect::guest('admin');
})->name('home');


//----------------------------------------------------------------

// Route::get('/{record}/pdf/download', [DownloadPdfController::class, 'download'])->name('datapmi.pdf.download');
// Route::get('/data-pmi/{record}', [DownloadPdfController::class, 'download'])->name('data-pmi.download');

Route::get('/{record}/pdf/download', [DownloadPdfController::class, 'download'])
    ->name('datapmi.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

Route::get('/data-pmi/{record}', [DownloadPdfController::class, 'download'])
    ->name('data-pmi.download')
    ->middleware('auth');  // Enforce authentication for this route

//----------------------------------------------------------------

Route::get('/{record}/pdf/download', [BIODATAController::class, 'download'])
    ->name('biodata.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

Route::get('/biodata/{record}', [BIODATAController::class, 'download'])
    ->name('biodata.download')
    ->middleware('auth');  // Enforce authentication for this route

//----------------------------------------------------------------
Route::get('/biodata/foto/{filename}', 'BiodataController@showPhoto')->name('biodata.photo');
