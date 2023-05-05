<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lucky\Dices;

class DiceController extends Controller
{
    public function show(Request $request, string $dicesInput) {
        // 1d4, 2d10, 4d8, etc ...
        $dices = Dices::createFrom($dicesInput);
        $dices->roll();
        return response()->json($dices->toJson());
    }
}
