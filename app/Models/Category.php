<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes, LogsActivity;

	protected $table = 'categories';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

	protected $fillable = [
		'name'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Category has been {$eventName}";
    }
}
