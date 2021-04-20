<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AccessoryModel extends Model 
{
    protected $table = 'accessory';

    protected $fillable = [
    	                    'english_name',
                            'arabic_name',
                            'accessory_owner',
                            'weight',
                            'cost',
                            'margin',
                            'selling',
                            'accessory_image',
    	                    'status',
                        ];
    public function get_agent_detail()
    {
        return $this->hasOne('App\Models\AgentModel', 'id', 'accessory_owner');
    }

}