<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductOptionModel extends Model 
{
    protected $table = 'product_option';

    protected $fillable = [
                            'product_id',
    	                    'option_id',
    	                    'status',
                        ];
 
    public function get_option_detail()
    {
        return $this->hasOne('App\Models\OptionModel', 'id', 'option_id');
    }

     public function get_suboptions()
    {
        return $this->hasMany('App\Models\ProductSubOptionModel', 'option_id', 'option_id');
    }
}
	