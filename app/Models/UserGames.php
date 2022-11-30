<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGames extends Model
{

    protected $fillable = [
        'user_id',
        'game_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function game()
    {
        return $this->hasOne(Games::class, "id", "game_id");
    }

}
