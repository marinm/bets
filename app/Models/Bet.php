<?php

namespace App\Models;

use App\Enums\BetStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = [
        'fixture_id',
        'payout',
        'status',
        'user_id',
        'winner_team_id',
    ];

    protected function casts(): array
    {
        return [
            'status' => BetStatus::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function winnerTeam()
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }

    public function scopeWon(Builder $query)
    {
        $query->where('status', BetStatus::Won);
    }

    public function scopeSettled(Builder $query)
    {
        $query->whereIn('status', [BetStatus::Won, BetStatus::Lost]);
    }
}
