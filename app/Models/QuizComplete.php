<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuizComplete
 * 
 * @property int $id
 * @property string $level
 * @property string $category
 * @property int $difficulty
 * @property string $question
 * @property string $choice1
 * @property string $choice2
 * @property string $choice3
 * @property string $choice4
 * @property string $choice5
 * @property string $choice6
 * @property string $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QuizComplete extends Model
{
	protected $table = 'quiz_completes';

	protected $casts = [
		'difficulty' => 'int'
	];

	protected $fillable = [
		'level',
		'category',
		'difficulty',
		'question',
		'choice1',
		'choice2',
		'choice3',
		'choice4',
		'choice5',
		'choice6',
		'answer'
	];
}
