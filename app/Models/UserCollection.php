<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'user_collections';

	protected $casts = [
		'user_id' => 'int',
		'collection' => 'json'
	];

	protected $fillable = [
		'user_id',
		'collection'
	];
}
