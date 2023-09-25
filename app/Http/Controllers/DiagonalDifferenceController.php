<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiagonalDifferenceController extends Controller
{
    public function calculateDiagonalDifference(Request $request)
    {
        $matrix = $request->input('matrix');
        $n = count($matrix);

        $diagonal1Sum = 0;
        $diagonal2Sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $diagonal1Sum += $matrix[$i][$i];
            $diagonal2Sum += $matrix[$i][$n - $i - 1];
        }
        $result = abs($diagonal1Sum - $diagonal2Sum);

        return response()->json(['result' => $result], 200);
    }
}
