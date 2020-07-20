<?php

namespace App\Models\_A44A;

use Illuminate\Database\Eloquent\Model;

class _A44A extends Model
{
    // 
    protected $table = ('A_44_A');
    protected $fillable = ['id', 'eProtocolo', 'id_policial', 'id_response_relator', 'num_44A', 'votacao_comissao', 'relator_opnou_por', 'descricao_pedido', 'quorum', 'contain_delibercao', 'created_at'];

}
