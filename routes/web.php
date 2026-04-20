<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/reports', [ReportController::class, 'index']);     
Route::get('/report/generate', [ReportController::class, 'generate']); 


Route::get('/report/pdf', [PdfController::class, 'generate'])
    ->name('report.pdf');


Route::prefix('inmate_report')->group(function () {
    Route::get('/inmate_report', [ReportController::class, 'inmate_report']);
});