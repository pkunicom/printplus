<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingOrderCompensationModel extends Model
{
    protected $table  = "printing_order_compensation";
    protected $fillable = [
                            'order_id',
    						'printing_order_detail_id',
    						'quantity',
                            'compensation_id',
                            'cost_owner',
                            'type',
                            'notes',
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }

    public function get_product_options()
    {
        return $this->hasOne('App\Models\PrintingOrderDetailsOptionModel', 'id', 'printing_order_detail_id');
    }

     public function get_printing_orderproduct_detail()
    {
        return $this->hasOne('App\Models\PrintingOrderDetailsModel', 'id', 'printing_order_detail_id');
    }

  
}
