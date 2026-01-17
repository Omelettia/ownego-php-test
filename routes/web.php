<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeaController;

Route::get('/', [TeaController::class, 'index']);
