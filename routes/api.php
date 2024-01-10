<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/affiliations', [ApiController::class, 'affiliations'])->name('affiliations.index');
