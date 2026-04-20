<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    // return view('welcome');
     return redirect('/admin/login');
});

Route::get('/report/{id}', [ReportController::class, 'generate']);