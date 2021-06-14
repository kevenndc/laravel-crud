<?php

namespace App\Models;

use App\Services\UploadStorageService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'posts_count'
    ];

    /**
     * The path to the default profile image for users.
     *
     * @var string
     */
    public const DEFAULT_PROFILE_IMAGE = '/images/users/default-avatar.jpeg';

    /**
     * The user role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The user posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Return the number of posts created by the user.
     *
     * @return int
     */
    public function getPostsCountAttribute()
    {
        return $this->posts->count();
    }

    /**
     * Returns a formatted date for the created_at attribute.
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        if (isset($value)) {
            $value = Carbon::parse($value)->format('d/m/Y \\a\\t H:i');
        }
        return $value;
    }

    /**
     * Encrypts the password before saving in the database.
     *
     * @param string $password - The raw password.
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setRoleAttribute($role)
    {
        $this->attributes['role_id'] = $role;
    }

    /**
     * Stores the user's profile image in a Storage and save the path in the database.
     *
     * @param \Illuminate\Http\UploadedFile $profileImage
     */
    public function setProfileImageAttribute(\Illuminate\Http\UploadedFile $profileImage)
    {
        $this->attributes['profile_image'] = resolve(UploadStorageService::class)
            ->store($profileImage)
            ->inDirectory('images/users')
            ->save();
    }
}
