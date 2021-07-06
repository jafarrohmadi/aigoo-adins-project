<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

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
    use LogsActivity;

    protected $table = 'assessment';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public const VALUETIDAKSETUJU = 1;
    public const VALUEKURANGSETUJU = 2;
    public const VALUENETRAL = 3;
    public const VALUESETUJU = 4;
    public const VALUESANGATSETUJU = 5;

    protected $casts
        = [
            'assessor_id' => 'int',
            'user_id'     => 'int',
            'question_id' => 'int',
            'value'       => 'int'
        ];

    protected $fillable
        = [
            'assessor_id',
            'user_id',
            'question_id',
            'value',
            'assessment_info'
        ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Assessment has been {$eventName}";
    }

    /**
     * @param $value
     * @return string
     */
    public function getValue($value)
    {
        $data = [
            self::VALUETIDAKSETUJU  => 'TIDAK SETUJU',
            self::VALUEKURANGSETUJU => 'KURANG SETUJU',
            self::VALUENETRAL       => 'NETRAL',
            self::VALUESETUJU       => 'SETUJU',
            self::VALUESANGATSETUJU => 'SANGAT SETUJU'
        ];

        return $data[$value];
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
