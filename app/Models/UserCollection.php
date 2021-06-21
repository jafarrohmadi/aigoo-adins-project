<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class UserCollection
 * 
 * @property int $id
 * @property int|null $user_id
 * @property array|null $collection
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class UserCollection extends Model
{
    use LogsActivity;

	protected $table = 'user_collections';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected $casts = [
		'user_id' => 'int',
		'collection' => 'json'
	];

	protected $fillable = [
		'user_id',
		'collection'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This User Collection has been {$eventName}";
    }
}
