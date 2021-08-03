<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class PointHistory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $quiz_ID
 * @property int $team_id
 * @property int $point
 * @property int $score
 * @property string $info
 * @property Carbon $created_at
 * @property Carbon $date_year_month
 *
 * @package App\Models
 */
class PointHistory extends Model
{
    use LogsActivity;
	protected $table = 'point_histories';
	public $timestamps = false;

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $casts = [
		'user_id' => 'int',
		'quiz_ID' => 'int',
		'team_id' => 'int',
		'point' => 'int',
		'coins' => 'int'
	];

	protected $fillable = [
		'user_id',
		'quiz_ID',
		'team_id',
		'point',
		'coins',
		'info',
        'date_year_month'
	];

	/**
     * @var mixed
     */

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Point History has been {$eventName}";
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
