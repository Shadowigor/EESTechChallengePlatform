<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Member extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'members';

    protected $fillable = ['first_name', 'last_name', 'birthdate', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // Roles
    const ROLE_APPLICANT   = 'applicant';
    const ROLE_PARTICIPANT = 'participant';
    const ROLE_JUDGE       = 'judge';
    const ROLE_ORGANIZER   = 'organizer';
    const ROLE_ADMIN       = 'admin';

    /**
     * Get the groups where this member participates.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group', 'event_members')->withPivot('role');
    }

    /**
     * Get the events where this member participates.
     */
    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_members')->withPivot('role');
    }
}
