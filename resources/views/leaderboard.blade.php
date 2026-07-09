@extends('layouts.app')

@section('content')
    <div class="py-4 flex justify-start items-center">
        <x-back-link />
    </div>

    <div class="mt-2 border border-gray-800 bg-gray-900 overflow-hidden w-full  rounded-lg text-white">
        <div class="p-4 list-none flex justify-between items-center">
            <div>Leaderboard</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
        </div>

        <table class="w-full border-collapse table-fixed">
            <thead>
                <tr class="border-b border-gray-800 uppercase text-xs font-normal text-gray-500">
                    <th class="p-4 text-start">User</th>
                    <th class="p-4 text-end">Points</th>
                    <th class="p-4 text-end">Won</th>
                    <th class="p-4 text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaderboard as $user)
                <tr class="w-full border-b border-gray-800 last:border-b-0 text-white">
                    <td class="p-4 text-start">{{ $user->name }}</td>
                    <td class="p-4 text-end font-mono">{{ number_format(($user->settled_bets_sum_payout ?? 0) / 100, 2) }}</td>
                    <td class="p-4 text-end font-mono text-gray-500">{{ $user->won_bets_count }}</td>
                    <td class="p-4 text-end font-mono text-gray-500">{{ $user->settled_bets_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </details>
@endsection