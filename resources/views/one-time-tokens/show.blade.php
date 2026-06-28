@extends('layouts.app')

@section('title', 'One-Time Token')

@section('content')
    <a href="{{ route('one-time-tokens.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Back</a>
    <h1 class="text-white text-2xl font-bold mb-6">One-Time Token</h1>

    <p class="text-gray-600 text-center">
        {{ $oneTimeToken->created_at->format('Y-m-d h:i A') }}
    </p>

    <p class="text-gray-600 text-center">
        {{ $oneTimeToken->created_at->diffForHumans() }}
    </p>

    <a href="{{ $url }}" class="bg-white rounded-lg p-2 m-auto w-fit mt-6 block">
        <div id="qrcode"></div>
    </a>

    <p class="text-white text-center text-lg bold">{{ $oneTimeToken->user->name }}</p>

    <div class="font-mono text-white mt-4">
        {{ $url }}
    </div>

    <form action="{{ route('one-time-tokens.destroy', $oneTimeToken) }}" method="POST" class="mt-12">
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
            width: 256,
            height: 256,
            colorDark : "#ffffff",
            colorLight : "#000000",
        });
    </script>
@endsection