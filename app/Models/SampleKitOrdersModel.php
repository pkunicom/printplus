<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleKitOrdersModel extends Model
{
    protected $table  = "sample_kit_orders";
    protected $fillable = [
    						'order_id',
    						'customer_id',
                            'delivery_status',
                            'product'
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }

  
}
