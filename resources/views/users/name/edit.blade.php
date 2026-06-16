@extends('layouts.app')

@section('content')
    <a href="{{ route('feed') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Back</a>
    <form action="{{ route('profile.name.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-white mb-2">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $user->name) }}"
                maxlength="20"
                class="w-full px-4 py-2 bg-gray-700 text-white rounded"
            />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
    </form>
@endsection
