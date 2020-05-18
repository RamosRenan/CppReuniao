<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table = ('roles');
    protected $fillable = ['id','name','guard_name'];

}#roles

?>