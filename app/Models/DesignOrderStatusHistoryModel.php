<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignOrderStatusHistoryModel extends Model
{
    protected $table  = "design_order_status_history";
    protected $fillable = [
    						'design_order_id',
    						'old_status',
    						'new_status',
                            'change_by',
                            'name',
    					
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'design_order_id');
    }


    
}
