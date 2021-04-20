<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemCountryModel extends Model
{
    protected $table  = "system_country";
    protected $fillable = ['country_id','country_english_name','country_arabic_name','aramex_country_id','status'];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }

     public function get_aramex_details()
    {
		return $this->hasOne('App\Models\AramexCountryModel', 'id', 'aramex_country_id');
    }
}
