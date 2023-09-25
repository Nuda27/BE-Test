<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LongestWordController extends Controller
{
    public function longestWord(Request $request)
    {
        $word = 'Saya sangat senang mengerjakan soal algoritma';
        $sentence = $word;

        $words = str_word_count($sentence, 1);

        $longestWord = '';
        foreach ($words as $word) {
            if (strlen($word) > strlen($longestWord)) {
                $longestWord = $word;
            }
        }

        return response()->json(['longest_word' => $longestWord], 200);
    }
}
