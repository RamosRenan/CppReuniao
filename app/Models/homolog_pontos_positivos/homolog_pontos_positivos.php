<?php

namespace App\Models\homolog_pontos_positivos;

use Illuminate\Database\Eloquent\Model;

class homolog_pontos_positivos extends Model
{
    //
    protected $table = ('homlog_pontos_positivos');
    protected $fillable = ['id', 'id_policial', 'eProtocolo', 'qtd_pontos', 'pertence_ata', 'identifier_in_ata', 'universidade',
     'curso', 'distincao', 'inciso', 'data_do_registro_eProtocolo', 'inicio_do_curso', 'termino_do_curso', 'contain_oficial_homolocao', 
     'descricao_da_homologacao', 'cursos_e_participacoes'];
}
