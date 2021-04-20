<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentContactDetailsModel extends Model
{
    protected $table  = "agent_contact_details";
    protected $fillable = [ 
    						'agent_id',
    						'contact_one',
    						'email_one',
                            'country_id_one',
                            'country_id_one_flag',
    						'mobile_one',
    						'contact_two',
    						'email_two',
                            'country_id_two',
                            'country_id_two_flag',
    						'mobile_two',
    					  ];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }
}
