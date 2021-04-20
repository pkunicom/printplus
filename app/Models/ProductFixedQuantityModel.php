<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductFixedQuantityModel extends Model 
{
    protected $table = 'product_fixed_quantity';

    protected $fillable = [
                            'product_id',
    	                    'fixed_quantity',
    	                    'status',
                        ];
 
    public function get_product_detail()
    {
        return $this->hasOne('App\Models\ProductsModel', 'id', 'product_id');
    }

}
	