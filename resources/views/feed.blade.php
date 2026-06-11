@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <h1 class="text-white text-2xl font-bold mb-6">Feed</h1>
    <!-- List of fixtures. Click a fixture to place a bet on it (goes to route('fixture-bets.create'))) -->
@endsection
