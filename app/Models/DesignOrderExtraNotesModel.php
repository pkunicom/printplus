<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignOrderExtraNotesModel extends Model
{
    protected $table  = "design_orders_extra_notes";
    protected $fillable = [
    						'design_order_id',
    						'notes',
                            'added_by'
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\DesignOrdersModel', 'id', 'design_order_id');
    }

  
}
