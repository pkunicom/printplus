<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPagesModel extends Model
{
    protected $table  = "front_pages";
    protected $fillable = [
					    	'page_title',	
					    	'page_description',	
					    	'slug',
					    	'meta_keyword',
					    	'meta_description',
					    	'meta_title',
					    	'status'
    					];

  //   public function get_city_details()
  //   {
		// return $this->hasOne('App\Models\SystemCityModel', 'id', 'system_city_id');
  //   }

  //   public function get_country_details()
  //   {
		// return $this->hasOne('App\Models\SystemCountryModel', 'id', 'system_country_id');
  //   }
}
