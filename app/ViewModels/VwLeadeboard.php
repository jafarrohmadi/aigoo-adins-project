<?php

namespace App\ViewModels;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class VwLeadeboard extends Model
{
    protected $table = 'vw_leadeboard';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function scopeFindGame($query, $quiz_ID)
    {
        return $query->where('quiz_ID', $quiz_ID);
    }

    public function scopeSetLimit($query, $limit = 10)
    {
        return $query->limit($limit);
    }

    public function scopeHighestScoreFirst($query)
    {
        return $query->orderBy('total_coins', 'desc');
    }
}
