<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use UserPresenter;

    protected $guarded = [
        'id',
        '_token',
        '_method',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function providers()
//    {
//        return $this->hasMany('App\Models\UserProvider');
//    }

    /**
     * Retrieves the profile of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
//    public function profile()
//    {
//        return $this->hasOne('App\Models\Userprofile');
//    }

    /**
     * Get the user profile associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
//    public function userprofile()
//    {
//        return $this->hasOne('App\Models\Userprofile');
//    }

    /**
     * Get the list of users related to the current User.
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

}
