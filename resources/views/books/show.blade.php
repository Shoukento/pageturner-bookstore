@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            @if($book->cover_image)
                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-auto rounded-lg shadow-lg">
            @else
                <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg shadow-lg">
                    <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
            @endif
        </div>
        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-4xl font-bold">{{ $book->title }}</h1>
                    <p class="text-2xl text-gray-600">{{ $book->author }} • {{ $book->category->name }}</p>
                </div>
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.books.edit', $book) }}" class="bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-700">Edit Book</a>
                        </div>
                    @endif
                @endauth
            </div>
            <p class="text-5xl font-bold text-blue-600 mt-6">₱{{ $book->price }}</p>

            @auth
                @if(!auth()->user()->isAdmin())
                    <form action="{{ route('orders.store') }}" method="POST" class="mt-8">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <div class="flex items-center space-x-4">
                            <input type="number" name="quantity" value="1" min="1" class="w-20 p-4 border rounded-2xl">
                            <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700">Order Now</button>
                        </div>
                    </form>
                @endif
            @else
                <div class="mt-8">
                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700">Log in to Order</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Reviews -->
    <h2 class="text-2xl font-bold mt-12">Reviews</h2>
    @foreach($book->reviews as $review)
        <div class="bg-white p-6 rounded-2xl mt-4 flex justify-between items-start">
            <div>
                <p class="font-bold">{{ $review->user->name }} • {{ $review->rating }} ★</p>
                <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
            </div>
            @auth
                @if(auth()->id() === $review->user_id || auth()->user()->isAdmin())
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium" onclick="return confirm('Are you sure you want to delete this review?')">
                            Delete
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach

    <!-- Review Form (for logged-in users) -->
    @auth
        @if(!auth()->user()->isAdmin())
            @if(auth()->user()->hasPurchasedBook($book))
                <form method="POST" action="{{ route('reviews.store', $book) }}" class="mt-10 bg-white p-8 rounded-3xl">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <select name="rating" class="w-full p-4 border rounded-2xl">
                            <option value="5">5 ★ Excellent</option>
                            <option value="4">4 ★ Very Good</option>
                            <option value="3">3 ★ Good</option>
                            <option value="2">2 ★ Fair</option>
                            <option value="1">1 ★ Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                        <textarea name="comment" placeholder="Write your review..." class="w-full p-4 border rounded-2xl"></textarea>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-green-700">Submit Review</button>
                </form>
            @else
                <div class="mt-10 bg-gray-100 p-6 rounded-2xl text-gray-600 italic">
                    You can only review books you have purchased.
                </div>
            @endif
        @endif
    @endauth
</div>
@endsection