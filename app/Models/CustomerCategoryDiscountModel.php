<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCategoryDiscountModel extends Model
{
    protected $table  = "customer_category_discount";
    protected $fillable = ['customer_id','category_id','discount','status'];

    public function get_customer_details()
    {
		return $this->hasMany('App\Models\CustomerModel', 'customer_id', 'id');
    }

    public function get_category_details()
    {
		return $this->hasOne('App\Models\CategoryModel', 'id', 'category_id');
    }
}
