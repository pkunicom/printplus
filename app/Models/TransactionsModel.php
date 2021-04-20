<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsModel extends Model
{
    protected $table  = "transactions";
    protected $fillable = [
    						'transaction_id',
                            'customer_id',
    						'amount',
    						'transaction_type',
    						'bank_transfer_id',
    						'notes',
    						'done_by_id',
    						'done_by_type',
    						'done_to_id',
    						'done_to_type',
    						'order_id',
    						'payment_status',
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }

    public function get_from_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'done_by_id');
    }

    public function get_to_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'done_to_id');
    }
}
