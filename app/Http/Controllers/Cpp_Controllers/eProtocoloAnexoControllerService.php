<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\anexo_eProtocolos\files_anexo_eProtocolos_refence_pedidos;
use Illuminate\Support\Facades\Storage;

class eProtocoloAnexoControllerService extends Controller
{
    // code ... 
    private     $eprotocolo;
    private     $method;
    private     $cpfPm;

    public function __construct($eprotocolo, $method, $cpfPm)
    {
        $this->eprotocolo   = $eprotocolo;
        $this->method       = $method;
        $this->cpfPm        = $cpfPm;
    }

    private function showAnexoeProtocolo(object $objectFile, $cpfPm)
    {
        $file = pathinfo($_SERVER['DOCUMENT_ROOT'])['dirname'].'/storage/app/public/CppArquivo/windows/CppArquivo/AnexoPedido/'.$cpfPm.'/'.$objectFile[0]->hash;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="Arquivo.pdf"');
        header('Content-Transfer-Encoding; binary');
        
        try{
            //code...
            @readfile($file);
        } catch (\Exception $th){
            // throw $th;
            return "Algo de errado ocorreu ao abrir o arquivo - ".$th->getMessage()."<h5> <a href='/cpp/cadastroE-protocolo'> Voltar </a> </h5>";
        }
    }
    //showAnexoeProtocolo()

    public function show()
    {
        //verifica se exite eProtocolo na DB
        $objectFile = files_anexo_eProtocolos_refence_pedidos::where('eprotocolo_foreign', $this->eprotocolo)->get();
        
        // return $objectFile;
        if(empty($objectFile) || count($objectFile)==0)
             return false;

        return self::showAnexoeProtocolo($objectFile, $this->cpfPm);
    }
    //show()
}
// eProtocoloAnexoControllerService
