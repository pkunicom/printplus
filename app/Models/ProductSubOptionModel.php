<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductSubOptionModel extends Model 
{
    protected $table = 'product_sub_option';

    protected $fillable = [
                            'product_id',
    	                    'option_id',
                            'sub_option_id',
    	                    'status',
                        ];
 
    public function get_sub_option_detail()
    {
        return $this->hasOne('App\Models\SubOptionModel', 'id', 'sub_option_id');
    }

    // public function get_combiinations_detail()
    // {
    //     return $this->hasMany('App\Models\ProductWeightTimeCostDetailsModel', 'id', 'sub_option_id');
    // }
    
}
	