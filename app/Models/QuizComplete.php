<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class QuizComplete
 *
 * @property int $id
 * @property string $level
 * @property string $category
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
class QuizComplete extends
    Model
{
    use LogsActivity;

    protected $table = 'quiz_completes';

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable
        = [
            'level',
            'category',
            'question',
            'choice1',
            'choice2',
            'choice3',
            'choice4',
            'choice5',
            'choice6',
            'answer',
        ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Quiz Complete has been {$eventName}";
    }

    /**
     * @return string
     */
    public function getNameCategoryAttribute(): string
    {
        return $this->categoryData ? $this->categoryData->name  : 'No category';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
