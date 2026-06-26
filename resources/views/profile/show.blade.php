@extends('layouts.app')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 mb-2 text-gray-400">Home</a>
    <h1 class="text-white text-2xl font-bold mb-6">Profile</h1>

    <svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-white w-32 h-32 mb-10" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
    </svg>

    <div class="border border-white rounded">
        <a href="{{ route('profile.name.edit') }}" class="flex items-center justify-between w-full p-4 border-b border-white">
            <span class="text-white">Name</span>
            <span class="text-gray-400">{{ $user->name }}</span>
        </a>
        <a href="{{ route('user-password.edit') }}" class="flex items-center justify-between w-full p-4 border-b border-white">
            <span class="text-white">Password</span>
            <span class="text-gray-400">{{ $user->password ? '••••••••' : '-' }}</span>
        </a>
        <a href="{{ route('profile.timezone.edit') }}" class="flex items-center justify-between w-full p-4">
            <span class="text-white">Timezone</span>
            <span class="text-gray-400">{{ $user->timezone }}</span>
        </a>
    </div>

    @if ($user->is_admin)
        <a href="{{ route('admin-menu') }}" class="mt-8 border border-white rounded text-white flex justify-between items-center p-4">
            <span>Admin menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </a>
    @endif

    <form action="{{ route('logout') }}" method="POST" class="flex justify-center mt-16">
        @csrf
        <button type="submit" class="px-12 py-4 bg-red-500 text-white rounded-full">
            Logout
        </button>
    </form>
@endsection
