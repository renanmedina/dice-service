<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiceController extends Controller
{
    public function show(Request $request) {
        // 1d4, 2d10, 4d8, etc ...
        $dicesInput = $request->get('dices');
        $diceResults = \App\Classes\Dice::rollSetFrom($dicesInput);
        $rollResults = array_sum($diceResults);

        return response()->json([
            $dicesInput => $rollResults,
            "result" => $rollResults,
            "dices_results" => $diceResults
        ]);
    }
}
