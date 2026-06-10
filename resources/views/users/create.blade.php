@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Users</a>
    <h1 class="text-white text-2xl font-bold mb-6">Create a User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @method('POST')
        @csrf
        <label class="flex flex-col text-white">
            Name
            <input type="text" name="name" value="{{ old('name') }}" placeholder="User Name" class="w-full p-2 text-white bg-black border border-white" />
        </label>
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Internal Name
            <input type="text" name="internal_name" value="{{ old('internal_name') }}" placeholder="Internal Name" class="w-full p-2 text-white bg-black border border-white" />
        </label>
        @error('internal_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Balance (cents)
            <input type="number" name="balance_cents" value="{{ old('balance_cents') }}" placeholder="0" class="w-full p-2 text-white bg-black border border-white" />
        </label>
        @error('balance_cents')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Create User</button>
    </form>
@endsection
