<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodesModel extends Model
{
    protected $table  = "promo_code";
    protected $fillable = [ 
    						            'code_id',
                            'code',
    						            'percentage',
                            'start_date',
                            'start_time',
                            'end_date',
                            'end_time',
                            'total_spend_in_code',
                            'flag_total_spend_in_code',
                            'min_cart_value',
                            'flag_min_cart_value',
                            'max_cart_value',
                            'flag_max_cart_value',
    						            'max_used_times',
                            'flag_max_used_times',
                            'cashback_percentage',
                            'flag_cashback_percentage',
                            'cashback_validity',
                            'flag_cashback_validity',
                            'system_country_id',
                            'flag_system_country_id',
                            'limit_code_new_customer',
                            'limit_code_for_one_time_use',
                            'free_delivery',
                            'exclude_discounted_products',
                            'count',
                            'status',
    					  ];

  //   public function get_category_details()
  //   {
		// return $this->hasOne('App\Models\CategoryModel', 'id', 'discount_id');
  //   }

  //    public function get_subcategory_details()
  //   {
  //       return $this->hasOne('App\Models\SubCategoryModel', 'id', 'sub_category_id');
  //   }

  //   public function get_product_details()
  //   {
  //       return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
  //   }

  //   public function get_country_details()
  //   {
  //       return $this->hasOne('App\Models\SystemCountryModel', 'id', 'system_country_id');
  //   }

  //   public function get_city_details()
  //   {
  //       return $this->hasOne('App\Models\SystemCityModel', 'id', 'system_city_id');
  //   }
}
