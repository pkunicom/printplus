<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartOptionsModel extends Model 
{
    protected $table = 'cart_product_options';

    protected $fillable = [
                            'cart_id',
    	                    'option_id',
                        ];

	public function get_suboptions()
    {
        return $this->hasOne('App\Models\CartSubOptionsModel', 'cart_product_option_id', 'id');
    }

    public function get_option_details()
    {
        return $this->hasOne('App\Models\OptionModel', 'id', 'option_id');
    }
}
						   