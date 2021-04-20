<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImagesModel extends Model
{
    protected $table  = "product_images";
    protected $fillable = [
    						'product_id',
    						'image',
    					];

    public function get_product_details()
    {
		return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
	}
}
