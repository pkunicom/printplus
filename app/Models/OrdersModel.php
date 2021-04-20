<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table  = "orders";
    protected $fillable = [
    						'order_id',
    						'customer_id',
    						'order_total_amount',
    						'promocode_id',
    						'address_id',
    						'country_id',
    						'city_id',
    						'delivery_type_id',
    						'transaction_id',
    						'order_total_items',
                            'printing_status',
                            'delivery_status',
                            'create_shipment',
                            'payment_response',
                            'payment_status'
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }

     public function get_delivery_type()
    {
		return $this->hasOne('App\Models\DeliveryTypeModel', 'id', 'delivery_type_id');
    }

      public function get_city()
    {
		return $this->hasOne('App\Models\SystemCityModel', 'id', 'city_id');
    }

      public function get_order_details()
    {
        return $this->hasMany('App\Models\PrintingOrderDetailsModel', 'order_id', 'id');
    }

     public function get_order_finance_details()
    {
        return $this->hasOne('App\Models\OrderFinanceDetailsModel', 'order_id', 'id');
    }

    public function get_shipment_details()
    {
        return $this->hasOne('App\Models\OrdersShipmentAramexModel', 'order_id', 'id');
    }

 
}
