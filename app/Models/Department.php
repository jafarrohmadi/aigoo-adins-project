<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Department
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Department extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'departments';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $casts
        = [
            'is_active' => 'bool'
        ];

    protected $fillable
        = [
            'name',
            'team_name',
            'team_icon',
            'is_active',
            'level',
            'team_leader'
        ];

    public function allUser()
    {
        return $this->hasMany(User::class , 'department_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class , 'department_id', 'id')->where('id' ,'!=', $this->team_leader);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'team_leader');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Department has been {$eventName}";
    }
}
