<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function borrowBook(Request $request, Member $member)
    {
        // Validasi apakah anggota telah mencapai batasan peminjaman (maksimal 2 buku)
        if ($member->borrowed_books()->count() >= 2) {
            return response()->json(['message' => 'Anggota telah mencapai batasan peminjaman buku.'], 400);
        }

        $bookId = $request->input('book_id');
        $book = Book::where('id', $bookId)
            ->whereNull('borrowed_by')
            ->where('quantity', '>', 0)
            ->first();

        if (!$book) {
            return response()->json(['message' => 'Buku tidak tersedia untuk dipinjam.'], 400);
        }

        $book->borrowed_by = $member->id;
        $book->quantity -= 1;
        $book->save();

        return response()->json(['message' => 'Buku berhasil dipinjam.'], 200);
    }

    // Pengembalian buku oleh anggota
    public function returnBook(Request $request, Member $member)
    {
        $bookId = $request->input('book_id');
        $book = $member->borrowed_books()->where('id', $bookId)->first();

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan dalam daftar peminjaman.'], 400);
        }

        $daysBorrowed = $this->calculateDaysBorrowed($book);

        if ($daysBorrowed > 7) {
            $member->penalty += 3;
            $member->save();
        }
        $book->borrowed_by = null;
        $book->save();

        return response()->json(['message' => 'Buku berhasil dikembalikan.'], 200);
    }

    public function listBooks()
    {
        $books = Book::where('quantity', '>', 0)->get();
        return response()->json($books, 200);
    }

    public function listMembers()
    {
        $members = Member::all();
        return response()->json($members, 200);
    }

    public function listBorrowedBooks(Member $member)
    {
        $borrowedBooks = $member->borrowed_books()->get();
        return response()->json($borrowedBooks, 200);
    }
    private function calculateDaysBorrowed(Book $book)
    {
        $borrowedDate = $book->updated_at;
        $now = now();
        $daysBorrowed = $now->diffInDays($borrowedDate);

        return $daysBorrowed;
    }
}
