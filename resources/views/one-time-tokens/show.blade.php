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

    <div class="bg-white rounded p-2 m-auto w-fit mt-6">
        <div id="qrcode"></div>
    </div>

    <p class="text-white text-center text-lg bold">{{ $oneTimeToken->user->name }}</p>

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
            width: 300,
            height: 300,
            colorDark : "#ffffff",
            colorLight : "#000000",
        });
    </script>
@endsection