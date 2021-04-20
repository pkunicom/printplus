<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentProductsModel extends Model
{
    protected $table  = "agent_products";
    protected $fillable = [ 
    						'agent_id',
    						'product_id',
    						'status',
    					  ];

    public function get_product_details()
    {
		return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }
}
