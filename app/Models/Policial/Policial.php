<?php

namespace App\Models\Policial;

use Illuminate\Database\Eloquent\Model;

class Policial extends Model
{
    protected $table = ('policial');
    protected $fillable = ['id', 'cpf', 'rg', 'nome', 'unidade', 'graduacao'];

    public function eProtocolo(){
        return $this->hasMany(' App\Models\E_Protocolo\eProtocolo');
    }


    public function policial(){
        return $this->hasOne('App\Models\Policial\Policial');
     }
 
}
