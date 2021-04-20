<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroupsModel extends Model
{
    protected $table  = "customer_groups";
    protected $fillable = ['group_id','group_name','standard_discount','status'];

  //   public function cities()
  //   {
		// return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
  //   }
}
