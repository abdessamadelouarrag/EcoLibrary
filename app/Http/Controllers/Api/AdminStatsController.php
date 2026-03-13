<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Book;

class AdminStatsController extends Controller
{
    public function index()
    {
        $totalCategories = Categorie::count();
        $totalBooks = Book::count();
        $totalQuantity = Book::sum('total_quantity');

        $booksPerCategory = Categorie::withCount('books')->get();

        return response()->json([
            'message' => 'Statistiques admin',
            'data' => [
                'total_categories' => $totalCategories,
                'total_books' => $totalBooks,
                'total_quantity' => $totalQuantity,
                'books_per_category' => $booksPerCategory,
            ]
        ], 200);
    }
}