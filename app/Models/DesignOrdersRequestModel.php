<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignOrdersRequestModel extends Model
{
    protected $table  = "design_orders_request";
    protected $fillable = [
    						'request_id',
    						'design_order_id',
    						'customer_id',
    						'design_request',
    						'file',
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }

    public function get_order_details()
    {
    return $this->hasOne('App\Models\DesignOrdersModel', 'id', 'design_order_id');
    }


  //    public function get_delivery_type()
  //   {
		// return $this->hasOne('App\Models\DeliveryTypeModel', 'id', 'delivery_type_id');
  //   }

  //     public function get_city()
  //   {
		// return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
  //   }

  //     public function get_order_details()
  //   {
  //       return $this->hasMany('App\Models\PrintingOrderDetailsModel', 'order_id', 'id');
  //   }

  //    public function get_order_finance_details()
  //   {
  //       return $this->hasOne('App\Models\OrderFinanceDetailsModel', 'order_id', 'id');
  //   }
}
