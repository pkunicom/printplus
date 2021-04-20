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

class CustomerModel extends Model implements AuthenticatableContract,
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
	
    protected $table = "customers";
    protected $fillable = [
                            'customer_id',
                            'full_name',
                            'address',
                            'latitude',
                            'longitude',
                            'gender',
                            'date_of_birth',
                            'address',
                            'country_id',
                            'state_id',
                            'city_id',
                            'country_code_id',
                            'country_code_flag',
                            'mobile_number',
                            'email',
                            'password',
                            'role',
                            'is_set_password',
                            'profile_image',
                            'customer_group',
                            'email_language',
                            'is_email_verified',
                            'is_verified',
                            'is_account_active',
                            'status',
                            'otp',
                            'token_code',
                            'last_logged_at'
    ];


    public function get_group_details() 
    {
       return $this->hasOne('App\Models\CustomerGroupsModel', 'id', 'customer_group');
    }

    public function get_country_details() 
    {
       return $this->hasOne('App\Models\SystemCountryModel', 'id', 'country_id');
    }
    public function get_city_details() 
    {
       return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
    }

    public function get_country_code_details() 
    {
       return $this->hasOne('App\Models\CountryModel', 'id', 'country_code_id');
    }

    public function get_transactions() 
    {
       return $this->hasMany('App\Models\TransactionsModel', 'customer_id', 'id');
    }
}
