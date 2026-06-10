<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['country_code', 'long_name'];

    public function fixturesAsTeam1()
    {
        return $this->hasMany(Fixture::class, 'team_1_id');
    }

    public function fixturesAsTeam2()
    {
        return $this->hasMany(Fixture::class, 'team_2_id');
    }

    public function winningFixtures()
    {
        return $this->hasMany(Fixture::class, 'winning_team_id');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class, 'winner_team_id');
    }
}
