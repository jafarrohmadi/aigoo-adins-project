<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Team
 * 
 * @property int $id
 * @property string $name
 * @property string|null $avatar
 * @property bool $locked
 * @property array $members
 * @property Carbon $created_ad
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Team extends Model
{
    use LogsActivity;

	protected $table = 'teams';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public $timestamps = false;

	protected $casts = [
		'locked' => 'bool',
		'members' => 'json'
	];

	protected $dates = [
		'created_ad'
	];

	protected $fillable = [
		'name',
		'avatar',
		'locked',
		'members',
		'created_ad'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Team has been {$eventName}";
    }
}
