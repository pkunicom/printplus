<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFinanceDetailsModel extends Model
{
    protected $table  = "order_finance_details";
    protected $fillable = [
    						'order_id',
    						'total_before_discount',
    						'discount',
    						'vat',
    						'total_including_vat',

    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }
}
