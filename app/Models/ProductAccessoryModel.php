<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductAccessoryModel extends Model 
{
    protected $table = 'product_accessories';

    protected $fillable = [
                            'product_id',
    	                    'accessory_id',
    	                    'status',
                        ];
 
    public function get_accessory_detail()
    {
        return $this->hasOne('App\Models\AccessoryModel', 'id', 'accessory_id');
    }
}
	