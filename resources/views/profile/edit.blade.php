@extends('layouts.app')

@section('title', 'My Profile')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('My Profile') }}
    </h2>
@endsection

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900">My Profile</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Update your profile information and password.</p>
    </div>

    <div class="max-w-3xl mx-auto space-y-8">
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
