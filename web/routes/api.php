<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lucky\Dices;
use App\Http\Controllers\DiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Roll a set of dices
Route::get('/dices/{dices}/roll', [DiceController::class, 'show'])
    ->where('dices', Dices::DICES_STRING_PATTERN)
    ->name('dices_roll');

Route::get('/phpinfo', function() {
    phpinfo();
    return true;
});