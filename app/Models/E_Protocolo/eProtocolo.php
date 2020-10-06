<?php

namespace App\Models\E_Protocolo;

use Illuminate\Database\Eloquent\Model;

class eProtocolo extends Model
{
    protected $table = ('eProtocolo');
    protected $fillable = ['id','cpf','eProtocolo', 'pedido', 'conteudo', 'status', 'entry_system_data', 'data_eProtocolo', 'data_sid', 'responsavel_cadastro', 'codigopedido'];

    public function policial(){
        return $this->belongsTo('App\Models\Policial\Policial', 'cpf');
    }

    public function sorteados(){
        return $this->hasMany(' App\Models\TableSorteados\sorteados', 'numero_sid');
    }


    public function eProtocolo(){
        return $this->hasOne('App\Models\E_Protocolo\eProtocolo');
     }
}
