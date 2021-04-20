<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ExternalOrdersModel extends Model 
{
    protected $table = 'external_orders';

    protected $fillable = [
    	                    'customer_name',
                            'project_description',
                            'cost',
                            'selling',
                            'added_by',
                            'margin',
                            'status',
                        ];
    // public function get_agent_detail()
    // {
    //     return $this->hasOne('App\Models\AgentModel', 'id', 'accessory_owner');
    // }

}