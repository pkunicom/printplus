<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingOrderStatusHistoryModel extends Model
{
    protected $table  = "printing_order_status_history";
    protected $fillable = [
    						'order_id',
    						'old_status',
    						'new_status',
                            'change_by',
                            'name',
    					
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }


    
}
