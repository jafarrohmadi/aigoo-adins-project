<?php

namespace App\Models;

use App\Filters\UserFilter;
use App\PointHistories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class User
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $roles
 * @property int $employee_level_id
 * @property Carbon|null $password_changed_at
 * @property int $active
 * @property string|null $timezone
 * @property Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property bool $to_be_logged_out
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class User extends
    Authenticatable
{
    use SoftDeletes, LogsActivity, HasApiTokens;

    protected $table = 'users';

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public const Male   = 0;
    public const Female = 1;
    protected $casts
        = [
            'employee_level_id' => 'int',
            'active'            => 'int',
            'to_be_logged_out'  => 'bool',
        ];

    protected $dates
        = [
            'email_verified_at',
            'password_changed_at',
            'last_login_at',
        ];

    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    protected $fillable
        = [
            'type',
            'name',
            'email',
            'email_verified_at',
            'password',
            'roles',
            'employee_level_id',
            'password_changed_at',
            'active',
            'timezone',
            'last_login_at',
            'last_login_ip',
            'to_be_logged_out',
            'provider',
            'provider_id',
            'remember_token',
            'team_id',
            'department',
            'avatar',
            'change_avatar',
            'level',
            'username',
            'current_coin',
            'company',
            'bu',
            'subbu',
            'nik',
            'jobposition',
            'worklocationname',
            'statusincompany',
            'department_id',
            'supervisor_id',
            'gender',
            'bu_code',
            'sub_bu_code',
            'department_code',
            'job_level',
            'admin_access',
        ];

    /**
     * @param $active
     * @return string
     */
    public function getUserStatus($active)
    {
        $data = [
            '0'  => 'unavailable',
            '1'  => 'available',
            '-1' => 'unauthorize',
        ];

        return $data[$active];
    }

//    /**
//     * Get the user's role.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function role()
//    {
//        return $this->belongsTo(Role::class);
//    }

    /**
     * Get the user's owner.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return UserFilter
     */
    public function newEloquentBuilder($query)
    {
        return new UserFilter($query);
    }

    /**
     *  Get user's image file.
     *
     * @return string
     */
    public function getImageFileAttribute()
    {
        if ($this->image === null) {
            return asset('images/default-user.png');
        }

        return Storage::disk('avatar')->url("{$this->image}");
    }

    /**
     * Does user have role admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles == 'Managerial';
    }

    /**
     * Does user have permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->role->permissions()
            ->where('name', $permission)
            ->first() ? true : false;
    }

    /**
     * Get first user's permission.
     *
     * @param  string  $permissionName
     * @return bool
     */
    public function getPermission($permissionName)
    {
        return $this->role->permissions()
            ->where('name', $permissionName)
            ->first();
    }

    /**
     * Save user's image name.
     *
     * @return string
     */
    public function saveImage($imageName)
    {
        $this->update(['image' => $imageName]);
    }

    /**
     * Save user's password.
     *
     * @param  string  $password
     * @return mixed
     */
    public function savePassword($password)
    {
        return $this->update(['password' => Hash::make($password)]);
    }

    /**
     * Is auth user same as compared user.
     *
     * @param  \App\Models\User  $comparedUser
     * @return bool
     */
    public function isHimself($comparedUser)
    {
        return $this->is($comparedUser);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This User has been {$eventName}";
    }

    public function scopeUserOnly($query)
    {
        return $query->where('type', 'user');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function getDepartmentNameAttribute()
    {
        return $this->departments->name;
    }

    /**
     * @return HasMany
     */
    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userCollection()
    {
        return $this->hasMany(UserCollection::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function avatars()
    {
        return $this->belongsTo(Avatar::class, 'id', 'user_id');
    }

    public function assessment()
    {
        return $this->hasMany(Assessment::class, 'user_id', 'id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'id', 'supervisor_id');
    }

    public function assessmentAssessor()
    {
        return $this->hasMany(Assessment::class, 'user_id', 'id');
    }


}
