@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen">
    <form action="{{ route('sessions.store') }}" method="POST" class="w-full flex flex-col items-center justify-center">
        @method('POST')
        @csrf
        <p class="text-white mb-2">Welcome</p>
        <p class="bold text-2xl text-white text-center mb-40">{{ $userName }}</p>
        <input type="hidden" name="secret" value="{{ old('secret', $secret) }}" readonly />
        @error('secret')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="mt-4 px-12 py-4 bg-stone-500 text-white rounded-full">Continue</button>
        <a href="{{ route('feed') }}" class="text-stone-500 mt-10 mb-4 inline-block">Cancel</a>
    </form>
</div>
@endsection
