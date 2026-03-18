@extends('layouts.app')

@section('title', 'PageTurner Bookstore')

@section('content')
    <!-- Hero Section -->
    <div class="text-center py-16 bg-gradient-to-r from-gray-50 to-gray-100 rounded-3xl mb-12 px-6">
        <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">Find your next great read.</h1>
        <p class="text-xl text-gray-600 mt-6 max-w-2xl mx-auto">Thousands of books, from international bestsellers to hidden gems, all in one place.</p>
        
        <div class="mt-10 max-w-md mx-auto">
            <form action="{{ route('books.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search by title or author..." class="w-full pl-12 pr-4 py-4 rounded-2xl border-none shadow-xl focus:ring-2 focus:ring-gray-800 text-lg">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-gray-900 text-white px-6 rounded-xl font-bold hover:bg-gray-800 transition-colors">Search</button>
            </form>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('books.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900 flex items-center">
                Or browse all categories 
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
    </div>

    <!-- Featured Books -->
    <div>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Featured Books</h2>
            <a href="{{ route('books.index') }}" class="text-blue-600 font-semibold hover:underline">View All &rarr;</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredBooks as $book)
                <div class="group relative bg-white p-3 rounded-2xl shadow-sm hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="overflow-hidden rounded-xl bg-gray-200" style="width: 297px; height: 320px;">
                        <a href="{{ route('books.show', $book) }}" class="block w-full h-full">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gray-50">
                                    <svg class="h-16 w-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                </div>
                            @endif
                        </a>
                    </div>
                    <div class="mt-6 px-1 flex justify-between items-start">
                        <div class="max-w-[180px]">
                            <h3 class="text-lg font-bold text-gray-900 truncate">
                                <a href="{{ route('books.show', $book) }}">
                                    {{ $book->title }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 truncate">{{ $book->author }}</p>
                        </div>
                        <p class="text-lg font-extrabold text-blue-600">₱{{ number_format($book->price, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection