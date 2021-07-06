<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class DailyAttempt
 * @property int $user_id
 * @property int $game_id
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

    protected $fillable = ['user_id', 'game_id', 'date', 'attempt'];
}
