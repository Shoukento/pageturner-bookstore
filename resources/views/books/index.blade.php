@extends('layouts.app')

@section('title', 'Browse Books')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Browse Books') }}
    </h2>
@endsection

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900">All Books</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Explore our full collection of books, from bestsellers to hidden gems.</p>
        @auth
            @if(auth()->user()->isAdmin())
                <div class="mt-8">
                    <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg transition-all inline-block">
                        Add New Book
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <aside>
            <form action="{{ route('books.index') }}" method="GET">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-900 mb-4">Search & Filters</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Title or Author..." class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                                <option value="">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Sort by</label>
                            <select name="sort" id="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700">Apply Filters</button>
                        </div>
                    </div>
                </div>
            </form>
        </aside>

        <main class="md:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="group relative bg-white p-2 rounded-lg shadow-sm">
                        <div class="overflow-hidden rounded-lg bg-gray-200" style="width: 305px; height: 320px;">
                            <a href="{{ route('books.show', $book) }}" class="block w-full h-full">
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover group-hover:opacity-75">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-gray-100">
                                        <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="mt-4 px-1 flex justify-between">
                            <div class="max-w-[180px]">
                                <h3 class="text-sm font-semibold text-gray-900 truncate">
                                    <a href="{{ route('books.show', $book) }}">
                                        {{ $book->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-xs text-gray-500 truncate">{{ $book->author }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-900">₱{{ number_format($book->price, 2) }}</p>
                        </div>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="absolute top-4 right-4 z-10">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="rounded-full bg-white bg-opacity-90 p-2 px-3 text-xs font-bold text-blue-600 shadow-lg backdrop-blur-sm hover:bg-blue-600 hover:text-white transition-all">Edit</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="md:col-span-3 text-center py-16">
                        <p class="text-lg text-gray-600">No books found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        </main>
    </div>
@endsection
