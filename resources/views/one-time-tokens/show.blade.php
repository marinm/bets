@extends('layouts.app')

@section('title', 'One-Time Token')

@section('content')
    <a href="{{ route('one-time-tokens.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">One-Time Tokens</a>
    <h1 class="text-white text-2xl font-bold mb-6">One-Time Token</h1>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">User: {{ $oneTimeToken->user->name }}</p>
        <p class="text-gray-400">Secret: {{ $oneTimeToken->secret }}</p>
        <p class="text-gray-400">
            Sign-in Link:
            <a href="{{ $url }}" class="text-blue-500 hover:text-blue-400">
                {{ $url }}
            </a>
        </p>
        <p class="text-gray-400">Created: {{ $oneTimeToken->created_at->format('Y-m-d H:i') }}</p>

        <div id="qrcode" class="flex justify-center mt-4"></div>
    </div>

    <form action="{{ route('one-time-tokens.destroy', $oneTimeToken) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection

@section('scripts')
    <script src="/qrcode.min.js"></script>
    <script>
        new QRCode(document.getElementById("qrcode"), {
            text: "{{ $url }}",
            width: 200,
            height: 200,
            colorDark : "#ffffff",
            colorLight : "#000000",
        });
    </script>
@endsection