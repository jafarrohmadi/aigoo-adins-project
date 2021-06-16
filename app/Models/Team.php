<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Team
 * 
 * @property int $id
 * @property string $name
 * @property string|null $avatar
 * @property bool $locked
 * @property array $members
 * @property Carbon $created_ad
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Team extends Model
{
	protected $table = 'teams';
	public $timestamps = false;

	protected $casts = [
		'locked' => 'bool',
		'members' => 'json'
	];

	protected $dates = [
		'created_ad'
	];

	protected $fillable = [
		'name',
		'avatar',
		'locked',
		'members',
		'created_ad'
	];
}
