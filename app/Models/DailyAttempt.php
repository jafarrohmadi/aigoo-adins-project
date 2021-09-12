<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class DailyAttempt
 * @property int $user_id
 * @property int $quiz_ID
 * @property int $attempt
 * @property Carbon|null $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @package App\Models
 */
class DailyAttempt extends Model
{
    use LogsActivity;

    protected $table = 'daily_attempts';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $fillable = ['user_id', 'quiz_ID', 'date', 'attempt'];

    public function user()
    {
        return $this->belongsTo(User::class ,'user_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo(Category::class , 'quiz_ID', 'id');
    }
}
