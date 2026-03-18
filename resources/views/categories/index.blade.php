@extends('layouts.app')

@section('title', 'All Categories')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('All Categories') }}
    </h2>
@endsection

@section('content')
    @auth
        @if(auth()->user()->isAdmin())
            <div class="flex justify-end mb-8">
                <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-md transition-all">
                    Add New Category
                </a>
            </div>
        @endif
    @endauth
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($categories as $category)
            <div class="relative group">
                <a href="{{ route('categories.show', $category) }}" class="block bg-white p-6 rounded-lg shadow-sm border border-gray-100 text-center hover:shadow-md transition-all hover:border-indigo-100 h-full">
                    <h4 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $category->name }}</h4>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->books_count }} Books</p>
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="absolute top-2 right-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-xs text-blue-600 hover:text-blue-800 bg-white/80 px-2 py-1 rounded">Edit</a>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@endsection
