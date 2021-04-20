<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AramexCountryModel extends Model
{
    protected $table  = "aramex_country";
    protected $fillable = ['name_ar','name_en','country_code'];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }
}
