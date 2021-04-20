<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model 
{
    protected $table = 'cart';

    protected $fillable = [
                            'customer_id',
    	                    'product_id',
                            'agent_id',
    	                    'weight_time_cost_id',
    	                    'unit_price',
    	                    'quantity',
    	                    'file',
                            'options',
                            'suboptions'
                        ];


    public function get_product_detail()
    {
        return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }

    public function get_cartoptions()
    {
        return $this->hasMany('App\Models\CartOptionsModel', 'cart_id', 'id');
    }
    
    public function get_suboptions()
    {
        return $this->hasMany('App\Models\CartSubOptionsModel', 'cart_id', 'id');
    }
    
      public function get_extra_notes()
    {
        return $this->hasOne('App\Models\CartNotesModel', 'cart_id', 'id');
    }


}
						