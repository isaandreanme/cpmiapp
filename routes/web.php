<?php




use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DownloadPdfController;
use App\Http\Controllers\BIODATAController;
use App\Http\Controllers\BionipController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;





Route::get('/', function () {
    return Redirect::guest('admin');
})->name('home');


//----------------------------------------------------------------

Route::get('/{record}/pdf/download', [BIODATAController::class, 'download'])
    ->name('biodata.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

Route::get('/biodata/{record}', [BIODATAController::class, 'download'])
    ->name('biodata.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

//----------------------------------------------------------------
Route::get('/biodata/foto/{filename}', 'BiodataController@showPhoto')->name('biodata.photo');

Route::get('/{record}/pdf/download', [DownloadPdfController::class, 'download'])
    ->name('datapmi.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

Route::get('/data-pmi/{record}', [DownloadPdfController::class, 'download'])
    ->name('data-pmi.download')
    ->middleware('auth');  // Enforce authentication for this route
//----------------------------------------------------------------

Route::get('/{record}/pdf/download', [BionipController::class, 'download'])
    ->name('bionip.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

Route::get('/bionip/{record}', [BionipController::class, 'download'])
    ->name('bionip.pdf.download')
    ->middleware('auth');  // Enforce authentication for this route

//----------------------------------------------------------------
Route::get('/biodata/foto/{filename}', 'BionipController@showPhoto')->name('biodata.photo');
