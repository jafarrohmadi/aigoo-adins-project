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
 * Class Question
 * 
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $content
 * @property string $level
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Question extends Model
{
	use SoftDeletes,LogsActivity;

	protected $table = 'questions';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'title',
		'category_id',
		'content',
		'level'
	];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This Question has been {$eventName}";
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
}
