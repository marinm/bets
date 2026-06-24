<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'internal_name',
        'balance_cents',
        'timezone',
    ];

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function wonBets()
    {
        return $this->bets()->won();
    }
}
