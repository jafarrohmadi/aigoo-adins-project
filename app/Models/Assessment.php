<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Assessment
 * 
 * @property int $id
 * @property int $assessor_id
 * @property int $user_id
 * @property int $question_id
 * @property int $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Assessment extends Model
{
	protected $table = 'assessment';

	protected $casts = [
		'assessor_id' => 'int',
		'user_id' => 'int',
		'question_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'assessor_id',
		'user_id',
		'question_id',
		'value'
	];
}
