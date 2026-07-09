@extends('layouts.app')

@section('content')
    <x-back-link />
    <h1 class="text-white text-2xl font-bold mb-6">Timezone</h1>

    <form action="{{ route('profile.timezone.update') }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-6 border border-white rounded">
            @foreach($timezones as $tz)
                <label class="flex items-center text-white border-b border-white last:border-b-0 p-4">
                    <input 
                        type="radio" 
                        name="timezone" 
                        value="{{ $tz }}"
                        {{ old('timezone', $user->timezone) === $tz ? 'checked' : '' }}
                        class="mr-3"
                    />
                    <span>{{ $tz }}</span>
                    <span class="text-gray-400 text-sm ml-auto font-mono">{{ now()->setTimezone($tz)->format('h:i A') }}</span>
                </label>
            @endforeach
        </div>

        @error('timezone')
            <p class="text-red-500 text-sm mt-1 mb-4">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
    </form>
@endsection
