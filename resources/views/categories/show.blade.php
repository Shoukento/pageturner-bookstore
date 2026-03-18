@extends('layouts.app')

@section('title', $category->name)

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
        <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            &larr; Back to all categories
        </a>
    </div>
@endsection

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900">{{ $category->name }}</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">{{ $category->books->count() }} books in this category.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($books as $book)
            <div class="group relative bg-white p-3 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="overflow-hidden rounded-xl bg-gray-200" style="width: 280px; height: 310px;">
                    <a href="{{ route('books.show', $book) }}" class="block w-full h-full">
                        @if($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-gray-50">
                                <svg class="h-12 w-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
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
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-lg text-gray-600">No books found in this category.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $books->links() }}
    </div>
@endsection
