<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignOrdersModel extends Model
{
    protected $table  = "design_orders";
    protected $fillable = [
    						'order_id',
    						'customer_id',
    						'quote_status',
    						'value',
    						'design_status',
    						'assigned_to',
    						'invoice',
    						'customer_group',
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
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
