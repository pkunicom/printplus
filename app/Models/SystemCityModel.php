<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemCityModel extends Model
{
    protected $table  = "system_city";
    protected $fillable = ['city_id','system_country_id','city_english_name','city_arabic_name','status','aramex_city_id'];

    public function get_country()
    {
		return $this->hasOne('App\Models\SystemCountryModel', 'id', 'system_country_id');
    }

     public function get_aramex_details()
    {
		return $this->hasOne('App\Models\AramexCityModel', 'id', 'aramex_city_id');
    }
}
