<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWeightTimeCostModel extends Model
{
    protected $table  = "product_weight_time_cost";
    protected $fillable = [
                            'product_id',
    						'sub_options_comb_id',
    						'description',
    						'quantity',
    						'weight',
							'lead_time',
							'cost',
                            'margin',
                            'selling',
    						'status',
    					];

    protected $casts = [
        'description' => 'array',
    ];

    public function get_product_details()
    {
		return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
	}

    public function get_details()
    {
        return $this->hasMany('App\Models\ProductWeightTimeCostDetailsModel', 'combination_id', 'id');
    }
}
