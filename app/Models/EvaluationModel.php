<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationModel extends Model
{
    protected $table  = "evaluation";
    protected $fillable = [
    						'evaluation_id',
    						'order_id',
    						'customer_id',
    						'order_detail_id',
							'evaluation',
							'status',
                            'comment'
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
	}
	public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
	}
	public function get_orderproduct_details()
    {
        return $this->hasOne('App\Models\PrintingOrderDetailsModel', 'id', 'order_detail_id');
    }
}
