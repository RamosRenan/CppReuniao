<?php

namespace App\Models\anexo_eProtocolos;

use Illuminate\Database\Eloquent\Model;

class files_anexo_eProtocolos_refence_pedidos extends Model
{ 
   // code ...
   protected $table=('FilesAnexoEProtocolosRefencePedidos');
   protected $fillable=['id', 'nome_arquivo', 'eprotocolo_foreign', 'path', 'PK_cpf__policial', 'hash', 'created_at', 'updated_at'];

   public function policial(){
      return $this->hasOne('App\Models\Policial\Policial');
   }

   public function eProtocolo(){
      return $this->hasOne('App\Models\E_Protocolo\eProtocolo');
   }
}
