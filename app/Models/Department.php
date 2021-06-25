<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Department extends Model
{
	use SoftDeletes, LogsActivity;

	protected $table = 'departments';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_active'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Department has been {$eventName}";
    }
}
