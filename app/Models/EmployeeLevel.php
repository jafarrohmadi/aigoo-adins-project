<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class EmployeeLevel
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class EmployeeLevel extends Model
{
	use SoftDeletes, LogsActivity;

	protected $table = 'employee_levels';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $fillable = [
		'name'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Employee Level has been {$eventName}";
    }
}
