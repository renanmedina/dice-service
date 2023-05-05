<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomNumber extends Controller
{
    public function index(Request $request) {
        $min = $request->get('min', 1);
        $max = $request->get('max', 1000);
        $quantity = $request->get('quantity', 1);

        $numbers = [];
        $i = 0;
        while ($i < $quantity) {
            $rand_number = rand($min, $max);
            // Save numbers just to simulate trace with queries, this name "cached" does not matter
            // yes, save each iteration to actualy SPAM queries on purpose
            $number_cache = new \App\Models\NumberCached(['number' => $rand_number]);
            $number_cache->save();
            $numbers[] = $number_cache;
            $i++;
        }

        return response()->json($numbers);
    }
}
