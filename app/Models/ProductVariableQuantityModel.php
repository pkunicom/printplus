<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductVariableQuantityModel extends Model 
{
    protected $table = 'product_variable_quantity';

    protected $fillable = [
                            'product_id',
                            'minimum_quantity',
                            'maximum_quantity',
                            'discount',
    	                    'status',
                        ];
 
    public function get_product_detail()
    {
        return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }

}
	