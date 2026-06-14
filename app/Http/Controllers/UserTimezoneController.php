<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTimezoneController extends Controller
{
    protected const TIMEZONES = [
        'America/Toronto',
        'America/Vancouver',
        'Europe/Tirane',
        'Europe/Berlin',
    ];

    public function edit(Request $request)
    {
        return view('users.timezone.edit', [
            'user' => $request->user(),
            'timezones' => self::TIMEZONES,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'timezone' => 'nullable|string|in:'.implode(',', self::TIMEZONES),
        ]);

        $request->user()->update($validated);

        return redirect()->route('profile.timezone.edit');
    }
}
