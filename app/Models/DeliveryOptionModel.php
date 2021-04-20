<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOptionModel extends Model
{
    protected $table  = "delivery_options";
    protected $fillable = [
					    	'city_id',	
					    	'system_country_id',	
					    	'system_city_id',
					    	'pickup_point',
					    	'standard_delivery',
					    	'standard_delivery_days',
					    	'express_delivery',
					    	'express_delivery_cost',
					    	'status'
    					];

    public function get_city_details()
    {
		return $this->hasOne('App\Models\SystemCityModel', 'id', 'system_city_id');
    }

    public function get_country_details()
    {
		return $this->hasOne('App\Models\SystemCountryModel', 'id', 'system_country_id');
    }
}
