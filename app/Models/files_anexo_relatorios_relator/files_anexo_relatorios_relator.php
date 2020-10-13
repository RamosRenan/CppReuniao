<?php

namespace App\Models\files_anexo_relatorios_relator;

use Illuminate\Database\Eloquent\Model;

class files_anexo_relatorios_relator extends Model
{
    // code ... 

    protected $table=('files_anexo_relatorios_relator');
    protected $fillable=['id', 'nome_arquivo', 'eprotocolo', 'path', 'FK_relator', 'hash', 'created_at', 'updated_at'];

    public function relator(){
        return $this->hasOne('App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp');
    }

    public function eProtocolo(){
        return $this->hasOne('App\Models\E_Protocolo\eProtocolo');
    }

    public function eProtocolo44a(){
        return $this->hasOne('App\Models\_A44A\_A44A');
    }
}
