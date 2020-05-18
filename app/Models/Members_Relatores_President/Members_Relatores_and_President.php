<?php

namespace App\Models\Members_Relatores_President;

use Illuminate\Database\Eloquent\Model;

class Members_Relatores_and_President extends Model
{
    // code ...
    protected $table = ('Members_Relatores_and_President');
    protected $fillable = ['id', 'nome', "posto", 'rg', 'cpf', 'qualificacao', 'id_membro', 'created_at', 'portariaCG', 'datePortaria'];

    public function users_ative_and_inative_cpp(){
        return $this->hasOne('App\Models\Ative_Inative_Relator', 'users_ative_and_inative_cpp');
    }
}
