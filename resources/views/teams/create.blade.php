@extends('layouts.app')

@section('title', 'Create Team')

@section('content')
    <a href="{{ route('teams.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Teams</a>
    <h1 class="text-white text-2xl font-bold mb-6">Create a Team</h1>

    <form action="{{ route('teams.store') }}" method="POST">
        @method('POST')
        @csrf
        <label class="flex flex-col text-white">
            Country code
            <input type="text" name="country_code" placeholder="XX" class="w-full p-2 text-white bg-black border border-white " />
        </label>
        @error('country_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Long name
            <input type="text" name="long_name" placeholder="Long name" class="w-full p-2 text-white bg-black border border-white " />
        </label>
        @error('long_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Create Team</button>
    </form>
@endsection
