<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UsersModel extends Model implements AuthenticatableContract,
                                          AuthorizableContract,
                                          CanResetPasswordContract,
                                          JWTSubject

{
	use Authenticatable, Authorizable, CanResetPassword;
    
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
	
	protected $table = "users";

    protected $connection = 'mysql';
    
    protected $fillable = [
                            'first_name',
                            'last_name',
                            'email',
                            'password',
                            'country',
                            'mobile_number',
                            'gender',
                            'status'
    ];

    protected $hidden = [
        'password', 'remember_token','verification_token',
    ];

    public function country_details()
    {
        return $this->hasOne('App\Models\CountryModel', 'id', 'country');
    }
}