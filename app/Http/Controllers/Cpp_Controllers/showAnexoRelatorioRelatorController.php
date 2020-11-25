<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\files_anexo_relatorios_relator\files_anexo_relatorios_relator;
use Illuminate\Support\Facades\ Auth;
use Illuminate\Auth\Events\Login;


class showAnexoRelatorioRelatorController extends Controller
{
    // code ... 

    public function index(){}
    // index

    private function showAnexoeRelatorioRelator(object $objectFile){
        // return $objectFile[0]->hash;
        $resp = trim($objectFile[0]->hash, " ");
        $file = $objectFile[0]->path.'/'.$resp;
  
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="teste.pdf"');
        header('Content-Transfer-Encoding; binary');

        try {
            //code...
            @readfile($file);
        } catch (\Throwable $th){
            throw $th;
        }
    }
    //showAnexoeProtocolo()

    public function create(){
        // return $_GET['eProtocolo'];
        //verifica se exite eProtocolo na DB
        $objectFile = files_anexo_relatorios_relator::where('eprotocolo', $_GET['eProtocolo'])->get();
        // return $objectFile;

        if(empty($objectFile) || count($objectFile)==0)
            return redirect($_SERVER['HTTP_REFERER'])->withErrors("Nenhum arquivo encontrado")->withInput();

        return self::showAnexoeRelatorioRelator($objectFile);
    }
    //show()
}
