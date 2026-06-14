@extends('layouts.app')

@section('content')
    <a href="{{ route('feed') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Back</a>
    <h1 class="text-white text-2xl font-bold mb-6">Timezone</h1>

    <form action="{{ route('profile.timezone.update') }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-6">
            <label class="flex items-center text-white mb-3">
                <input 
                    type="radio" 
                    name="timezone" 
                    value="" 
                    {{ old('timezone', $user->timezone) === null ? 'checked' : '' }}
                    class="mr-3"
                />
                <span>None</span>
            </label>
            @foreach($timezones as $tz)
                <label class="flex items-center text-white mb-3">
                    <input 
                        type="radio" 
                        name="timezone" 
                        value="{{ $tz }}"
                        {{ old('timezone', $user->timezone) === $tz ? 'checked' : '' }}
                        class="mr-3"
                    />
                    <span>{{ $tz }}</span>
                </label>
            @endforeach
        </fieldset>

        @error('timezone')
            <p class="text-red-500 text-sm mt-1 mb-4">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
    </form>
@endsection
