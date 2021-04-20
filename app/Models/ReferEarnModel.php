<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferEarnModel extends Model
{
    protected $table  = "refer_earn";
    protected $fillable = ['referral_customer_id','customer_id','referral_status','request','status'];

    public function get_customer_detail()
    {
        return $this->hasOne('App\Models\CustomerModel', 'id', 'customer_id');
    }
}
