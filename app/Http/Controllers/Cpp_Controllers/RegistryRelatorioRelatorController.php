<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Models\files_anexo_relatorios_relator\files_anexo_relatorios_relator;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use Illuminate\Support\Facades\ Auth;
use Illuminate\Support\Facades\Storage;



class RegistryRelatorioRelatorController extends Controller
{
    //  code ...

    // metodo antigo, para localhost
    // const file =  '/home/pmpr/public/reuniaoCpp/cpp/relator/relatorAnexo/';

    // metodo novo, para servidor de arquivo
    private $file;// = pathinfo($_SERVER['DOCUMENT_ROOT'])['dirname'].'/storage/app/public/CppArquivo/windows/Relatorio/';//'.$loginRelator.'/'.$objectFile[0]->hash;

    private $request;

    private $loginRelator;

    function __construct(Request $request, $loginRelator){
        $this->request      = $request;
        $this->loginRelator = $loginRelator;
    }
     

    private function update(){
        $relat = users_ative_and_inative_cpp::where('has_user_id',  Auth::user()->id)->get();

        // Não necessário o metodo Storage put cria o HAsh
        // $hashedNameArq = Hash::make($this->request->file('fileRelatRelat')->getClientOriginalName().time('H:i:s'), [
        //     'memory'    => 1,
        //     'time'      => 2,
        //     'threads'   => 2,
        // ]);

        // $hashSplit = str_split($hashedNameArq);

        // for($i=0; $i < strlen($hashedNameArq); $i++){
        //     # code...
        //     if($hashSplit[$i] == '/')
        //         $hashSplit[$i] = '%';
        // }

        // $hash = implode('', $hashSplit);

        /*
         * nova forma de inserção 
         */
        // coloca arquivo em /storage/app/public/
        // envia para servidor arquivo, e retorna path com hash do arquivo
        $returnStorage = Storage::disk('Relatorio')->put($this->loginRelator, $this->request->file('fileRelatRelat'));
        // return substr(strstr($returnStorage, '/'), 1);
        $justHash = substr(strstr($returnStorage, '/'), 1);

        try {
            //code ...
            $novofiles_anexo_relatorios_relator = new files_anexo_relatorios_relator;
            $novofiles_anexo_relatorios_relator->nome_arquivo   = $this->request->file('fileRelatRelat')->getClientOriginalName();
            $novofiles_anexo_relatorios_relator->eprotocolo     = $this->request->input('eProtocolo');
            $novofiles_anexo_relatorios_relator->path           = pathinfo($_SERVER['DOCUMENT_ROOT'])['dirname'].'/storage/app/public/CppArquivo/windows/CppArquivo/Relatorio/'.$this->loginRelator;
            $novofiles_anexo_relatorios_relator->FK_relator     = $relat[0]->has_user_id;
            $novofiles_anexo_relatorios_relator->hash           = $justHash;   
            $novofiles_anexo_relatorios_relator->save();   

            // $this->request->file('fileRelatRelat')->move(self::file.$this->loginRelator, $hash);
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    //update()


    private function create(){
        // return $file.$this->loginRelator;
        if(is_dir(self::file.$this->loginRelator)){
            return $this->update();
        }else{

            //cria diretorio para o relator;
            mkdir(self::file.$this->loginRelator, 0700);
            return $this->update();
        }
    }
    //create()

    //registro do relatório do relator
    public function store(){
        return $this->update();
    }
    //store()
    
}
//RegistryRelatorioRelatorController
