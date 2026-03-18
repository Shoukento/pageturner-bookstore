@extends('layouts.app')

@section('title', auth()->user()->isAdmin() ? 'Manage Orders' : 'My Orders')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __(auth()->user()->isAdmin() ? 'Manage Orders' : 'My Orders') }}
    </h2>
@endsection

@section('content')
    <div class="text-center py-16">
    @if(auth()->user()->isAdmin())
        <h1 class="text-4xl font-bold text-gray-900">Manage Orders</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">View and manage all customer orders.</p>
    @else
        <h1 class="text-4xl font-bold text-gray-900">My Orders</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Track your current and past orders.</p>
    @endif
    </div>

    @if($orders->isEmpty())
        <div class="text-center py-16">
            <p class="text-lg text-gray-600">You have no orders.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        @endif
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                            @if(auth()->user()->isAdmin())
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">₱{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('orders.show', $order) }}" class="text-gray-600 hover:text-gray-900">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
@endsection
