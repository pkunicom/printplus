<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWeightTimeCostDetailsModel extends Model
{
    protected $table  = "product_weight_time_cost_details";
    protected $fillable = [
                            'product_id',
    						'combination_id',
    						'sub_option_id',
    					];

 //    public function get_combination_details()
 //    {
	// 	return $this->hasOne('App\Models\ProductVariableQuantityModel', 'id', 'combination_id');
	// }

    public function get_option_details()
    {
     return $this->hasOne('App\Models\SubOptionModel', 'id', 'sub_option_id');
    }
}
