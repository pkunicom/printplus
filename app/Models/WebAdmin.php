<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Auth;
//use Session;

use Tymon\JWTAuth\Contracts\JWTSubject;

class WebAdmin extends Model implements Authenticatable, CanResetPasswordContract, JWTSubject
{
    use AuthenticableTrait, CanResetPassword, Notifiable;

    protected $hidden = array('password', 'remember_token');

    
    /**
    * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
    * @return array
    */
    public function getJWTCustomClaims()
    {
        return [];
     //return ['user' => ['id' => $this->id]];
    }

    protected $table = 'web_admin';

    protected $fillable = ['full_name','name','email','password','contact','address','profile_image','role','otp','expired_on'];

    public function admin_role()
    {
        return $this->belongsTo('App\Models\UserHasRolesModel', 'id', 'web_admin_id');
    }
}