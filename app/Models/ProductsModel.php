<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table  = "product";
    protected $fillable = [
    						'product_id',
    						'category_id',
    						'subcategory_id',
    						'product_english_name',
							'product_arabic_name',
							'product_arabic_description',
							'product_english_description',
                            'quantity_type',
    						'status',
    					];

    public function get_subcategory_details()
    {
		return $this->hasOne('App\Models\SubCategoryModel', 'id', 'subcategory_id');
	}
	public function get_category_details()
    {
		return $this->hasOne('App\Models\CategoryModel', 'id', 'category_id');
	}
	public function get_product_option_detail()
    {
        return $this->hasMany('App\Models\ProductOptionModel', 'product_id', 'id');
    }
    public function get_product_suboption_detail()
    {
        return $this->hasMany('App\Models\ProductSubOptionModel', 'product_id', 'id');
    }
    public function get_fixed_quantity()
    {
        return $this->hasMany('App\Models\ProductFixedQuantityModel', 'product_id', 'id');
    }
    public function get_variable_quantity()
    {
        return $this->hasMany('App\Models\ProductVariableQuantityModel', 'product_id', 'id');
    }

    public function get_product_accessories()
    {
        return $this->hasMany('App\Models\ProductAccessoryModel', 'product_id', 'id');
    }
    
        public function get_product_images()
    {
        return $this->hasMany('App\Models\ProductImagesModel', 'product_id', 'id');
    }
}
