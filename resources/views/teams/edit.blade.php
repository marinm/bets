@extends('layouts.app')

@section('title', 'Edit Team')

@section('content')
    <a href="{{ route('teams.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Teams</a>
    <h1 class="text-white text-2xl font-bold mb-6">Edit Team</h1>

    <form action="{{ route('teams.update', ['team' => $team]) }}" method="POST">
        @method('PUT')
        @csrf
        <label class="flex flex-col text-white">
            Country code
            <input type="text" name="country_code" value="{{ old('country_code', $team->country_code) }}" placeholder="XXX" class="w-full p-2 text-white bg-black border border-white " />
        </label>
        @error('country_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Long name
            <input type="text" name="long_name" value="{{ old('long_name', $team->long_name) }}" placeholder="Long name" class="w-full p-2 text-white bg-black border border-white " />
        </label>
        @error('long_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Flag code
            <input type="text" name="flag_code" value="{{ old('flag_code', $team->flag_code) }}" placeholder="Flag code" class="w-full p-2 text-white bg-black border border-white " />
        </label>
        @error('flag_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Update Team</button>
    </form>
@endsection