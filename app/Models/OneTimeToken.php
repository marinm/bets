<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OneTimeToken extends Model
{
    protected $fillable = ['secret', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
