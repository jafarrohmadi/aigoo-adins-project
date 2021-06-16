<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuizResult
 * 
 * @property int $id
 * @property int $quiz_id
 * @property string $type
 * @property int $user_id
 * @property bool $value
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class QuizResult extends Model
{
	protected $table = 'quiz_results';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'quiz_id' => 'int',
		'user_id' => 'int',
		'value' => 'bool'
	];

	protected $fillable = [
		'quiz_id',
		'type',
		'user_id',
		'value'
	];
}
