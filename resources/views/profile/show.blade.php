@extends('layouts.app')

@section('content')
    <h1 class="text-white text-2xl font-bold mb-6">Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="mb-6">
        @method('PUT')
        @csrf
        <label class="flex flex-col text-white mb-3">
            Name
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                placeholder="Name"
                class="w-full p-2 text-white bg-black border border-white mt-1"
            />
        </label>
        @error('name')
            <p class="text-red-500 text-sm mt-1 mb-3">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded">Update Name</button>
    </form>

    <div class="mb-6">
        <a href="{{ route('profile.timezone.edit') }}" class="block w-full px-4 py-2 bg-gray-600 text-white text-center rounded hover:bg-gray-700">
            Edit Timezone
        </a>
    </div>

    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
@endsection
