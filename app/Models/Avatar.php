<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Avatar
 * 
 * @property int $id
 * @property int $user_id
 * @property array $avatar_settings
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Avatar extends Model
{
    use LogsActivity;

    protected $table = 'avatars';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

	protected $casts = [
		'user_id' => 'int',
		'avatar_settings' => 'json'
	];

	protected $fillable = [
		'user_id',
		'avatar_settings'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Assesment has been {$eventName}";
    }
}
