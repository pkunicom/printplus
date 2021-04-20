<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CityInstallationModel extends Model 
{
    protected $table = 'product_city_installation';

    protected $fillable = [
                            'product_id',
                            'country_id',
                            'city_id',
                            'visit_cost',
                            'visit_selling',
                            'unit_cost',
                            'unit_selling',
    	                    'status',
                        ];
 
    public function get_product_detail()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'product_id');
    }
    public function get_country_detail()
    {
        return $this->hasOne('App\Models\SystemCountryModel', 'id', 'country_id');
    }
    public function get_city_detail()
    {
        return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
    }
}
	