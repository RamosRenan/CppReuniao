<?php

namespace App\Models\Ative_Inative_Relator;

use Illuminate\Database\Eloquent\Model;

class users_ative_and_inative_cpp extends Model
{
    //
    protected $table=('users_ative_and_inative_cpp');
    protected $fillable=['id', 'user_id', 'id_roles_permission', 'user_id_your_status', 'who_alter_status_user', 'is_president'];

    public function model_has_roles(){
       return $this->hasMany('App\Models\Model_has_roles\model_has_roles');
    }
}
