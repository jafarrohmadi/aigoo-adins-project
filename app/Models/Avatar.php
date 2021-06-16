<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Avatar
 * 
 * @property int $id
 * @property int $user_id
 * @property array $avatar_settings
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Avatar extends Model
{
	protected $table = 'avatars';

	protected $casts = [
		'user_id' => 'int',
		'avatar_settings' => 'json'
	];

	protected $fillable = [
		'user_id',
		'avatar_settings'
	];
}
