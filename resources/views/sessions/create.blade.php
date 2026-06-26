@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen">
    <form action="{{ route('sessions.store') }}" method="POST" class="w-full flex flex-col items-center justify-center text-white">
        @method('POST')
        @csrf
        @isset($secret)
            <p class="text-white mb-2">Welcome</p>

            <p class="bold text-2xl text-white text-center mb-40">{{ $userName }}</p>
            <input type="hidden" name="secret" value="{{ old('secret', $secret) }}" readonly />
        @else
            <div class="w-full h-20 flex justify-center items-center mb-5 text-red-500">
                @if ($errors->any())
                    No match found.
                @endif
            </div>
            <div class="w-full mb-20">
                <label for="name" class="block">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full border border-white rounded p-4 text-white"
                    placeholder="Name"
                    value="{{ old('name') }}"
                />
                
                <label for="password" class="block mt-4">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full border border-white rounded p-4 text-white"
                    placeholder="Password"
                />
            </div>
        @endisset
        
        <button type="submit" class="mt-8 px-12 py-4 bg-lime-500 text-white rounded-full">
            Continue
        </button>
    </form>
</div>
@endsection
