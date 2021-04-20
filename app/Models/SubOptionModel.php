<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SubOptionModel extends Model 
{
    protected $table = 'suboptions';

    protected $fillable = [
                            'option_id',
    	                    'english_name',
                            'arabic_name',
    	                    'status',
                        ];
 
    public function get_option_detail()
    {
        return $this->hasOne('App\Models\OptionModel', 'id', 'option_id');
    }

}
	