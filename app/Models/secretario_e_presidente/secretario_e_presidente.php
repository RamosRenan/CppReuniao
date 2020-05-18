<?php

namespace App\Models\secretario_e_presidente;

use Illuminate\Database\Eloquent\Model;

class secretario_e_presidente extends Model
{
    //
    protected $table = ('secretario_e_presidente');
    protected $fillable = ['id', 'nome', "posto", 'rg', 'cpf', 'qualificacao', 'id_membro', 'created_at'];

     
}
