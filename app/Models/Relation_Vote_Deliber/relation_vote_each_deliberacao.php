<?php

namespace App\Models\Relation_Vote_Deliber;

use Illuminate\Database\Eloquent\Model;

class relation_vote_each_deliberacao extends Model
{
    //
    protected $table = ('relation_vote_each_deliberacao');
    protected $fillable = ['id', 'id_deliberacao', "eProtocolo", 'id_membro', 'was_voted', 'votou_contra', 'votou_favoravel', 'is_relator_from_this_pedido', 'desempate_presidente', 'created_at'];

}
