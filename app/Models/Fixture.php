<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Fixture extends Model
{
    protected $fillable = ['started_at', 'team_1_id', 'team_2_id', 'is_finished', 'winning_team_id'];

    protected $casts = [
        'started_at' => 'datetime',
        'is_finished' => 'boolean',
    ];

    protected $appends = [
        'betting_is_closed',
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
        return $this->belongsTo(Team::class, 'winning_team_id');
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

    public function getIsLikelyInProgressAttribute(): bool
    {
        return
            $this->started_at <= now() &&
            $this->started_at->clone()->addHours(2)->addMinutes(30) >= now();
    }
}
