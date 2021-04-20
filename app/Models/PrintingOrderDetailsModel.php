<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingOrderDetailsModel extends Model
{
    protected $table  = "printing_order_details";
    protected $fillable = [
    						'order_id',
    						'product_id',
    						'agent_id',
                            'file',
                            'weight_time_cost_id',
                            'unit_price',
                            'quantity',
    						'status'
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }

     public function get_product_details()
    {
		return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }

    public function get_agent_details()
    {
		return $this->hasOne('App\Models\AgentModel', 'id', 'agent_id');
    }

 // COmmented on 24th sept 2020 for the issue faced on order details
    // public function get_productoption_selected()
    // {
    //     return $this->hasMany('App\Models\PrintingOrderDetailsOptionModel', 'order_id', 'id');
    // }
 // New added on 24th sept 2020 for the issue faced on order details
 public function get_productoption_selected()
    {
        return $this->hasMany('App\Models\PrintingOrderDetailsOptionModel', 'order_id', 'order_id');
    }

    public function get_combination_details()
    {
        return $this->hasOne('App\Models\ProductWeightTimeCostModel', 'id', 'weight_time_cost_id');
    }

    
}
