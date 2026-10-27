<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'author' => ['required', 'string', 'max:100'],
            'pages' => ['required', 'integer', 'between:1,10000'],
        ]);

        // Never accept user_id from the submitted form.
        $validated['user_id'] = auth()->id();

        Book::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Book registered successfully.');
    }
}
