<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountModel extends Model
{
    protected $table  = "discounts";
    protected $fillable = [ 
    						'discount_id',
    						'percentage',
                            'start_date',
                            'start_time',
                            'end_date',
                            'end_time',
                            'category_id',
                            'sub_category_id',
                            'product_id',
    						'system_country_id',
                            'system_city_id',
                            'delivery_service',
                            'first_order_new_customer',
                            'status',
    					  ];

    public function get_category_details()
    {
		return $this->hasOne('App\Models\CategoryModel', 'id', 'discount_id');
    }

    public function get_subcategory_details()
    {
        return $this->hasOne('App\Models\SubCategoryModel', 'id', 'sub_category_id');
    }

    public function get_product_details()
    {
        return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }

    public function get_country_details()
    {
        return $this->hasOne('App\Models\SystemCountryModel', 'id', 'system_country_id');
    }

    public function get_city_details()
    {
        return $this->hasOne('App\Models\SystemCityModel', 'id', 'system_city_id');
    }
}
