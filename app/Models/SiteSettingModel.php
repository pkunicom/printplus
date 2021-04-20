<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettingModel extends Model
{
    protected $table = 'site_settings';

    protected $fillable = 
    [
        'title',
        'meta_keyword',
        'meta_description',
        'send_order_email',
        'printplus_margin_for_saudi_arabia',
        'printplus_margin_for_others',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'logo',
        'favicon'
    
    ];

    public $timestamps = false; 
}
