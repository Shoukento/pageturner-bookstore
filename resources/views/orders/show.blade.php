@extends('layouts.app')

@section('title', "Order #{$order->id}")

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
        <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            &larr; Back to all orders
        </a>
    </div>
@endsection

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
        <p class="text-lg text-gray-600 mt-4">Placed on {{ $order->created_at->format('F j, Y') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <a href="{{ route('books.show', $item->book) }}">
                                        @if($item->book->cover_image)
                                            <img src="{{ Storage::url($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="w-16 h-24 object-cover rounded-md hover:opacity-75 transition-opacity">
                                        @else
                                            <div class="w-16 h-24 bg-gray-200 rounded-md flex items-center justify-center text-gray-400 hover:bg-gray-300 transition-colors">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-gray-900">
                                        <a href="{{ route('books.show', $item->book) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $item->book->title }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-600">by {{ $item->book->author }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Qty: {{ $item->quantity }} @ ₱{{ number_format($item->unit_price, 2) }} each</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">₱{{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                    <dl class="space-y-4">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">₱{{ number_format($order->total_amount, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Shipping</dt>
                            <dd class="text-sm font-medium text-gray-900">₱0.00</dd>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-semibold text-gray-900">Order Total</dt>
                            <dd class="text-base font-semibold text-gray-900">₱{{ number_format($order->total_amount, 2) }}</dd>
                        </div>
                    </dl>

                    @if(auth()->user()->isAdmin())
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Order Status</h3>
                            <form action="{{ route('orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center space-x-4">
                                    <select name="status" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Order Status</h3>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ 
                                $order->status === 'completed' ? 'bg-green-100 text-green-800' : (
                                $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'
                                )
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
