<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingOrderExtraNotesModel extends Model
{
    protected $table  = "printing_order_extra_notes";
    protected $fillable = [
    						'order_id',
    						'notes',
                            'added_by'
    					];

    public function get_order_details()
    {
		return $this->hasOne('App\Models\OrdersModel', 'id', 'order_id');
    }

  
}
