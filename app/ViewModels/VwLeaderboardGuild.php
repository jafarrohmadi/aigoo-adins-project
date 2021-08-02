<?php

namespace App\ViewModels;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class VwLeaderboardGuild extends Model
{
    protected $table = 'vw_leadeboard_guild';

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
