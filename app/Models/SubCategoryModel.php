<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model 
{
    protected $table = 'subcategory';

    protected $fillable = [
                            'category_id',
    	                    'english_name',
                            'arabic_name',
    	                    'status',
                        ];
 
    public function get_category_detail()
    {
        return $this->hasOne('App\Models\CategoryModel', 'id', 'category_id');
    }

}
	