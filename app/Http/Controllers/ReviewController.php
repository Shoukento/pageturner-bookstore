<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Administrators cannot write reviews.');
        }

        if (!Auth::user()->hasPurchasedBook($book)) {
            return redirect()->back()
                ->with('error', 'You can only review books you have purchased.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['book_id'] = $book->id;

        $existing = Review::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existing) {
            $existing->update($validated);
            $message = 'Review updated successfully!';
        } else {
            Review::create($validated);
            $message = 'Review submitted successfully!';
        }

        return redirect()->route('books.show', $book)
            ->with('success', $message);
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $book = $review->book;
        $review->delete();

        return redirect()->route('books.show', $book)
            ->with('success', 'Review deleted successfully!');
    }
}