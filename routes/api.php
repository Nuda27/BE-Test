<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/borrow-book/{member}', 'App\Http\Controllers\LibraryController@borrowBook');
Route::post('/return-book/{member}', 'App\Http\Controllers\LibraryController@returnBook');
Route::get('/books', 'App\Http\Controllers\LibraryController@listBooks');
Route::get('/members', 'App\Http\Controllers\LibraryController@listMembers');
Route::get('/members/{member}/borrowed-books', 'App\Http\Controllers\LibraryController@listBorrowedBooks');

Route::get('/reverse-alphabet', 'App\Http\Controllers\ReverseController@reverseAlphabetWithNumber');
Route::post('/longest-word', 'App\Http\Controllers\LongestWordController@longestWord');
Route::post('/count-words', 'App\Http\Controllers\WordCountController@countWords');
Route::post('/diagonal-difference', 'App\Http\Controllers\DiagonalDifferenceController@calculateDiagonalDifference');


