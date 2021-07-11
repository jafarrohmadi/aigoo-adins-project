<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

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
class QuizMatch extends
    Model
{
    use LogsActivity;

    protected $table = 'quiz_matches';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $fillable
        = [
            'level',
            'category',
            'question',
            'wrong_question',
            'answer',
            'wrong_answer',
        ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Quiz Match has been {$eventName}";
    }

    /**
     * @return string
     */
    public function getNameCategoryAttribute(): string
    {
        $data = [
            'dna'                  => 'DNA',
            'core-value'           => 'Core Value',
            'create-collaboration' => 'Create and Collaboration',
        ];

        return $data[$this->category] ?? 'No category';
    }
}
