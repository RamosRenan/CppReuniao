<?php

namespace App\Models\Model_has_roles;

use Illuminate\Database\Eloquent\Model;

class model_has_roles extends Model
{
    //
    protected $table=('model_has_roles');
    protected $fillable=['role_id', 'model_type', 'model_id'];

    public function roles(){
    //    return $this->hasOne('App\Models\Ata\ata');
    }
}
