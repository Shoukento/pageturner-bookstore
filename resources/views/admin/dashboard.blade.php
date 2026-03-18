@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Admin Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Total Books</h3>
                <p class="mt-1 text-3xl font-semibold text-gray-700">{{ $totalBooks }}</p>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Total Categories</h3>
                <p class="mt-1 text-3xl font-semibold text-gray-700">{{ $totalCategories }}</p>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Total Orders</h3>
                <p class="mt-1 text-3xl font-semibold text-gray-700">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-lg font-medium text-gray-900">Inventory Management</h3>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.books.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl text-center shadow-sm transition-all">
                Manage Books
            </a>
            <a href="{{ route('admin.books.create') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-bold py-4 px-6 rounded-xl text-center shadow-sm transition-all">
                + Add New Book
            </a>
            <a href="{{ route('admin.categories.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-xl text-center shadow-sm transition-all">
                Manage Categories
            </a>
            <a href="{{ route('admin.categories.create') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-bold py-4 px-6 rounded-xl text-center shadow-sm transition-all">
                + Add New Category
            </a>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-lg font-medium text-gray-900">Order Management</h3>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('orders.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-6 rounded-xl text-center shadow-sm transition-all">
                View All Orders
            </a>
        </div>
    </div>
@endsection
