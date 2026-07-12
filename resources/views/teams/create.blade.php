@extends('layouts.app')

@section('title', 'Create Team')

@section('content')
    <a href="{{ route('teams.index') }}" class="text-gray-400 hover:text-amber-900 mb-4 inline-block">Teams</a>
    <h1 class="text-amber-900 text-2xl font-bold mb-6">Create a Team</h1>

    <form action="{{ route('teams.store') }}" method="POST">
        @method('POST')
        @csrf
        <label class="flex flex-col text-amber-900">
            Country code
            <input type="text" name="country_code" placeholder="XXX" class="w-full p-2 text-amber-900 bg-black border border-white " />
        </label>
        @error('country_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-amber-900">
            Long name
            <input type="text" name="long_name" placeholder="Long name" class="w-full p-2 text-amber-900 bg-black border border-white " />
        </label>
        @error('long_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-amber-900">
            Flag code
            <input type="text" name="flag_code" placeholder="Flag code" class="w-full p-2 text-amber-900 bg-black border border-white " />
        </label>
        @error('flag_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-amber-900 rounded">Create Team</button>
    </form>
@endsection
