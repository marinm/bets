@extends('layouts.app')

@section('content')
    <x-back-link />
    <form action="{{ route('user-password.update') }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-6">
            <label for="password" class="block text-white mb-2">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                class="w-full px-4 py-2 bg-gray-700 text-white rounded"
            />
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
    </form>
@endsection
