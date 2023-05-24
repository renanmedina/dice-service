<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiceController;

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
    return view('welcome');
});

// Roll a set of dices
Route::get('/dices/{dices}/roll', [DiceController::class, 'show'])->name('dices_roll_rendered');
