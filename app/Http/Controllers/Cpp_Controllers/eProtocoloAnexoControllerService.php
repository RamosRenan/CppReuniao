<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\anexo_eProtocolos\files_anexo_eProtocolos_refence_pedidos;
use Illuminate\Support\Facades\Storage;

class eProtocoloAnexoControllerService extends Controller
{
    // code ... 

    private  $eprotocolo;
    private  $method;

    public function __construct($eprotocolo, $method){
        $this->eprotocolo   = $eprotocolo;
        $this->method       = $method;
    }

    private function showAnexoeProtocolo(object $objectFile){

        // return $objectFile;

        $file = '/home/pmpr/public/reuniaoCpp/cpp/policialPedidos/anexo_eProtocolos/'.$objectFile[0]->hash;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="papo.pdf"');
        header('Content-Transfer-Encoding; binary');

        try {
            //code...
            @readfile($file);
        } catch (\Throwable $th){
            throw $th;
        }
    }
    //showAnexoeProtocolo()

    public function show(){
        //verifica se exite eProtocolo na DB
        $objectFile = files_anexo_eProtocolos_refence_pedidos::where('eprotocolo_foreign', $this->eprotocolo)->get();
        // return count($objectFile);

        if(empty($objectFile) || count($objectFile)==0)
             return false;

        return self::showAnexoeProtocolo($objectFile);
    }
    //show()
}
// eProtocoloAnexoControllerService
