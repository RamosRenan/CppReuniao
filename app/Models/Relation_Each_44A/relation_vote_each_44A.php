<?php

namespace App\Models\Relation_Each_44A;

use Illuminate\Database\Eloquent\Model;

class relation_vote_each_44A extends Model
{
    //
    protected $table = ('relation_vote_each_44A');
    protected $fillable = ['id', 'id_membro', 'was_voted', 'secretario_desta_deliberacao', 'presidente_desta_deliberacao', 'votou_contra', 'votou_favoravel', 'is_relator_from_this_pedido', 'created_at'];

}
