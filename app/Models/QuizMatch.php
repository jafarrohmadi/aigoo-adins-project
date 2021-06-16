<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuizMatch
 * 
 * @property int $id
 * @property string $level
 * @property string $category
 * @property int $difficulty
 * @property string $question
 * @property string $wrong_question
 * @property string $answer
 * @property string $wrong_answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QuizMatch extends Model
{
	protected $table = 'quiz_matches';

	protected $casts = [
		'difficulty' => 'int'
	];

	protected $fillable = [
		'level',
		'category',
		'difficulty',
		'question',
		'wrong_question',
		'answer',
		'wrong_answer'
	];
}
