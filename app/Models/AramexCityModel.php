<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AramexCityModel extends Model
{
    protected $table  = "aramex_city";
    protected $fillable = ['name_ar','name_en','aramex_country_id','aramexName'];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }
}
