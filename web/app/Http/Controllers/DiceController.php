<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lucky\Dices;

class DiceController extends Controller
{
    public function show(Request $request, string $dicesInput) {
        return view('dice_roll', ['dices_input' => $dicesInput]);
    }
}
