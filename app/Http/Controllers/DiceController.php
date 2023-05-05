<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiceController extends Controller
{
    public function show(Request $request) {
        // 1d4, 2d10, 4d8, etc ...
        $dices = $request->get('dices');
        
    }

    private function parseDices(String $dices) {

    }
}
