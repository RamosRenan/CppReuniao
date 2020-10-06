<?php

namespace App\Models\Deliberacao;

use Illuminate\Database\Eloquent\Model;

class deliberacao extends Model
{
    // code ...
    protected $table=('deliberacao');
    protected $fillable=['id', 'numero_ata', 'num_deliberacao', 'deliberacao', 'eProtocolo', 'id_notification'];

    public function ata(){
       return $this->belongsTo('App\Models\Ata\ata');
    }
    
}#finall class deliberacao
