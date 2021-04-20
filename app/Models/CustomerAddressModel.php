<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomerAddressModel extends Model 
{
    protected $table = 'customer_address';

    protected $fillable = [
    	                    'customer_id',
                            'country_id',
                            'city_id',
                            'address',
                            'zipcode',
    	                    'status',
                            'full_name',
                            'email',
                            'contact',
                            'country_code',
                            'country_code_flag'
                        ];
    public function get_customer_detail()
    {
        return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }
    public function get_country_details() 
    {
       return $this->hasOne('App\Models\SystemCountryModel', 'id', 'country_id');
    }
    public function get_city_details() 
    {
       return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
    }

}