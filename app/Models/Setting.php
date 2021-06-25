<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Setting
 * 
 * @property int $id
 * @property string $name
 * @property string|null $value
 * @property string|null $group_name
 *
 * @package App\Models
 */
class Setting extends Model
{
    use LogsActivity;

	protected $table = 'settings';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public $timestamps = false;

	protected $fillable = [
		'name',
		'value',
		'group_name'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Setting has been {$eventName}";
    }
}
