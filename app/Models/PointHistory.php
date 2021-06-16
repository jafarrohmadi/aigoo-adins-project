<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PointHistory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $team_id
 * @property int $point
 * @property int $score
 * @property string $info
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class PointHistory extends Model
{
	protected $table = 'point_histories';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'game_id' => 'int',
		'team_id' => 'int',
		'point' => 'int',
		'score' => 'int'
	];

	protected $fillable = [
		'user_id',
		'game_id',
		'team_id',
		'point',
		'score',
		'info'
	];
}
