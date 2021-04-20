<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Auth;
class AgentModel extends Model implements AuthenticatableContract,
                                          AuthorizableContract,
                                          CanResetPasswordContract,
                                          JWTSubject

{
	use  Authorizable,  AuthenticableTrait, CanResetPassword, Notifiable;
	
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
	
    protected $table = "agent";
    protected $fillable = [
                            'full_name',
                            'address',
                            'latitude',
                            'longitude',
                            'gender',
                            'agency_name',
                            'date_of_birth',
                            'address',
                            'country_id',
                            'state_id',
                            'city_id',
                            'mobile_number',
                            'email',
                            'password',
                            'role',
                            'is_set_password',
                            'profile_image',
                            'is_email_verified',
                            'is_verified',
                            'is_account_active',
                            'status',
                            'otp',
                            'last_logged_at'
    ];


    public function get_contact_details() 
    {
       return $this->hasOne('App\Models\AgentContactDetailsModel', 'agent_id', 'id');
    }

     public function get_bank_details() 
    {
       return $this->hasOne('App\Models\AgentBankDetailsModel', 'agent_id', 'id');
    }

    public function get_documents_details() 
    {
       return $this->hasOne('App\Models\AgentDocumentsModel', 'agent_id', 'id');
    }

    public function get_country_details() 
    {
       return $this->hasOne('App\Models\SystemCountryModel', 'country_id', 'id');
    }

    public function get_city_details() 
    {
       return $this->hasOne('App\Models\SystemCityModel', 'city_id', 'id');
    }

}
