<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryPickupPointModel extends Model
{
    protected $table  = "delivery_pickup_points";
    protected $fillable = [
    						'id',    
                            'point_id',    
                            'city_id', 
                            'country_id',
                            'point_english_name',  
                            'point_arabic_name',   
                            'english_address', 
                            'arabic_address',  
                            'english_working_hours',   
                            'arabic_working_hours',    
                            'latitude',    
                            'longitude',    
                            'status',
                            'image'
    					];

    public function get_city_details()
    {
		return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
    }
    
    public function get_country_details()
    {
        return $this->hasOne('App\Models\SystemCountryModel', 'id', 'country_id');
    }   
}
