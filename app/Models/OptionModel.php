<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model 
{
    protected $table = 'options';

    protected $fillable = [
    	                    'english_name',
                            'arabic_name',
    	                    'status',
                        ];
}
	