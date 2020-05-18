<?php

namespace App\Models\eProtocoloSorteados;

use Illuminate\Database\Eloquent\Model;

class eProtocolosSorteados extends Model
{
    protected $table = ('eProtocolo_sorteados');
    protected $fillable = ['id_eProtocolo_sorteados', 'eProtocolo', 'id', 'parecer_relator', 'votacao_comissao', 'opnou_por', 'relator_votou'];

    public function users(){
        return $this->belongsTo('App\User', 'id');
    }


    public function eProtocolo(){
        return $this->belongsTo('App\Models\E_Protocolo\eProtocolo', 'eProtocolo');
    }
}
