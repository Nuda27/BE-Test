<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReverseController extends Controller
{
    public function reverseAlphabetWithNumber()
    {
        $inputString = "NEGIE1";
        $resultString = $this->reverseAlphabet($inputString);
        $resultString .= '1';

        return response()->json(['result' => $resultString], 200);
    }

    private function reverseAlphabet($str)
    {
        $result = '';
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = strtoupper($str);

        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            if (strpos($alphabet, $char) !== false) {
                $reverseChar = $alphabet[strlen($alphabet) - 1 - strpos($alphabet, $char)];
                $result .= $reverseChar;
            } else {
                $result .= $char;
            }
        }
        return $result;
    }
}
