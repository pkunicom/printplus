<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatModel extends Model
{
    protected $table  = "vat";
    protected $fillable = [
    						'vat',
    					];

  //   public function get_customer_details()
  //   {
		// return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
  //   }

   
}
