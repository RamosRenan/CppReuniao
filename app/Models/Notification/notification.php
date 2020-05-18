<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    //
    protected $table = ('notifications');
    protected $fillable = ['id', 'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at'];
    
}
