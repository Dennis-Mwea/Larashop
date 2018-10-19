<?php

namespace Larashop\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Larashop\Models\Brand;
use Larashop\Notifications\LarashopAdminResetPassword as ResetPasswordNotification;
use Larashop\Post;
use Larashop\SocialAccount;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 
    'email', 
    'password',
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

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    public function socialAccounts(){
        return $this->hasMany(SocialAccount::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function getId() {
        return $this->id;
    }
}
