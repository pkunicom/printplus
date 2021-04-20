<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartNotesModel extends Model 
{
    protected $table = 'cart_product_notes';

    protected $fillable = [
                            'cart_id',
    	                    'notes',
                        ];
}
						   