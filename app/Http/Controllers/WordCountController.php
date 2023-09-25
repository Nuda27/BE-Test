<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordCountController extends Controller
{
    public function countWords(Request $request)
    {
        $input = $request->input('input');
        $query = $request->input('query');

        // Inisialisasi array OUTPUT dengan nilai awal 0
        $output = array_fill(0, count($query), 0);

        foreach ($query as $key => $queryWord) {
            foreach ($input as $inputWord) {
                if ($queryWord === $inputWord) {
                    // Jika kata QUERY ditemukan dalam INPUT, tambahkan 1 ke OUTPUT
                    $output[$key]++;
                }
            }
        }

        return response()->json(['output' => $output], 200);
    }
}
