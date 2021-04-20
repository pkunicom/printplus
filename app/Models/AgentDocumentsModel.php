<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentDocumentsModel extends Model
{
    protected $table  = "agent_documents";
    protected $fillable = ['agent_id','company_cr','license','vat_reg','status'];

    public function cities()
    {
		return $this->hasMany('App\Models\CitiesModel', 'country_code', 'id');
    }
}
