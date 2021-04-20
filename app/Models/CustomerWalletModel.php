<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerWalletModel extends Model
{
    protected $table  = "customer_wallet";
    protected $fillable = [
    						'transaction_id',
    						'customer_id',
    						'validity',
    						'amount',
    						'status'
    					];

    public function get_customer_details()
    {
		return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }

    public function get_transaction_details()
    {
		return $this->hasOne('App\Models\TransactionsModel', 'id', 'customer_id');
    }
}
