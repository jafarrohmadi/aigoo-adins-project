<?php

namespace App\ViewModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class VwLeadeboard extends Model
{
    protected $table = 'vw_leadeboard';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeFindGame($query, $game_id)
    {
        return $query->where('game_id', $game_id);
    }

    public function scopeSetLimit($query, $limit = 10)
    {
        return $query->limit($limit);
    }

    public function scopeHighestScoreFirst($query)
    {
        return $query->orderBy('total_score', 'desc');
    }
}
