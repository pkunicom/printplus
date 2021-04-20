<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInvoiceModel extends Model
{
    protected $table  = "agent_invoice";
    protected $fillable = [ 
    						'agent_id',
    						'invoice_id',
                            'invoice_amount',
                            'paid_amount',
                            'total_orders',
                            'reorders',
                            'payment_status',
                            'payment_date',
                            'invoice_file',
    						'status',
    					  ];

    public function get_agent_details()
    {
		return $this->hasOne('App\Models\AgentModel', 'id', 'agent_id');
    }
}
