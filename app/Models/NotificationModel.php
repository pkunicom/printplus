<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table      = 'notifications';

    protected $fillable   = ['receiver_id', 'receiver_type', 'sender_id', 'sender_type', 'title', 'description', 'redirect_url', 'status', 'notification_type'];

    public function get_user_details()
    {
        return $this->hasOne('App\Models\UsersModel','_id','sender_id');
    }

     public function get_admin_details()
    {
        return $this->hasOne('App\Models\WebAdmin','_id','sender_id');
    }
}
