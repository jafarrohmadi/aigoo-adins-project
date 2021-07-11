<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class QuizChoice
 *
 * @property int $id
 * @property string $level
 * @property string $category
 * @property string $choice1
 * @property string $choice2
 * @property string $choice3
 * @property string $choice4
 * @property string $choice5
 * @property string $question
 * @property int $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QuizChoice extends
    Model
{
    use LogsActivity;

    protected $table = 'quiz_choices';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $casts
        = [
            'answer'     => 'int',
            'difficulty' => 'int',
        ];

    protected $fillable
        = [
            'level',
            'category',
            'choice1',
            'choice2',
            'choice3',
            'choice4',
            'choice5',
            'question',
            'answer',
        ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Quiz Choice has been {$eventName}";
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
