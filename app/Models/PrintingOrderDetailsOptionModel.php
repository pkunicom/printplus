<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingOrderDetailsOptionModel extends Model
{
    protected $table  = "printing_order_details_option";
    protected $fillable = [
    						'order_id',
    						'order_detail_id',
    						'option_id',
    						
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }

     public function get_orderdetials_detail()
    {
		return $this->hasOne('App\Models\PrintingOrderDetailsModel', 'id', 'order_detail_id');
    }

    public function get_option_details()
    {
		return $this->hasOne('App\Models\OptionModel', 'id', 'option_id');
    }

    
}
