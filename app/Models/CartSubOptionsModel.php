<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartSubOptionsModel extends Model 
{
    protected $table = 'cart_product_suboptions';

    protected $fillable = [
                            'cart_id',
                            'cart_product_option_id',
    	                    'option_id',
    	                    'sub_option_id',
                        ];

	public function get_suboption_details()
    {
        return $this->hasOne('App\Models\SubOptionModel', 'id', 'sub_option_id');
    }
}
						   