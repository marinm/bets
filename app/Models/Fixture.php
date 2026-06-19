<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = ['started_at', 'team_1_id', 'team_2_id', 'bets_closed_at', 'is_finished', 'winning_team_id'];

    protected $casts = [
        'started_at' => 'datetime',
        'bets_closed_at' => 'datetime',
        'is_finished' => 'boolean',
    ];

    protected $appends = [
        'betting_is_closed',
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
        return $this->is_finished;
    }
}
