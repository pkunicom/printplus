<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentBankDetailsModel extends Model
{
    protected $table  = "agent_bank_details";
    protected $fillable = [ 
    						'agent_id',
    						'account_name',
    						'account_number',
    						'bank_name',
    						'iban_number',
    					  ];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }
}
