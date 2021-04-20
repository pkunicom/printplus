<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTypeModel extends Model
{
    protected $table  = "delivery_type";
    protected $fillable = [
    						'delivery_type',
    						'status'
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }
}
