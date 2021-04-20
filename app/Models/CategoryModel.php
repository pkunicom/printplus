<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model 
{
    protected $table = 'category';

    protected $fillable = [
                            'category_id',
    	                    'english_name',
                            'arabic_name',
    	                    'status',
                        ];
}
	