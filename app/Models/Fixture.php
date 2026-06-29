<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Fixture extends Model
{
    protected $fillable = [
        'is_finished',
        'can_draw',
        'settled_at',
        'started_at',
        'team_1_id',
        'team_2_id',
        'winner_team_id',
    ];

    protected $casts = [
        'can_draw' => 'boolean',
        'is_finished' => 'boolean',
        'settled_at' => 'datetime',
        'started_at' => 'datetime',
    ];

    protected $appends = [
        'betting_is_closed',
        'settled_at_local',
        'started_at_local',
        'is_likely_in_progress',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }

    public function winningTeam()
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function userBet()
    {
        return $this->hasOne(Bet::class)->where('user_id', auth()->id());
    }

    public function getBettingIsClosedAttribute(): bool
    {
        return $this->is_finished || $this->started_at < now();
    }

    public function getStartedAtLocalAttribute(): Carbon
    {
        $timezone = auth()->user()?->timezone ?? 'America/Toronto';

        return $this->started_at->tz($timezone);
    }

    public function getSettledAtLocalAttribute(): ?Carbon
    {
        $timezone = auth()->user()?->timezone ?? 'America/Toronto';

        return $this->settled_at?->tz($timezone) ?? null;
    }

    public function getIsLikelyInProgressAttribute(): bool
    {
        return (! $this->is_finished) &&
            $this->started_at <= now() &&
            $this->started_at->clone()->addHours(3) >= now();
    }
}
