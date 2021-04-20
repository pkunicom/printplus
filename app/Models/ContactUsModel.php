<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    protected $table  = "contact_us";
    protected $fillable = ['name','email','contact','message'];

  //   public function cities()
  //   {
		// return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
  //   }
}
