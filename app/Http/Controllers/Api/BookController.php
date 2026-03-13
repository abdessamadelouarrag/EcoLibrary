<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();

        return response()->json([
            'message' => 'List of books',
            'data' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'total_quantity' => ['required', 'integer', 'min:0'],
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book->load('category')
        ], 201);
    }

    public function show(Book $book)
    {
        return response()->json([
            'message' => 'Book details',
            'data' => $book->load('category')
        ], 200);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'categorie' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'total_quantity' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book->load('category')
        ], 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}