<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileAta\fileAta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Storage;


class uploadFileController extends Controller
{
    //code ...

    public function index(){
        return view('CPP.UploadFile.index');
    }//index ...


    public function store(Request $request){

        // return $request->all();

        $id = Auth::user();

        $name = Auth::user()->name;

        Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou Upload de um documento - '.'id: '.$id->id.' 
        - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Doc name: '.$_FILES['userfile']['name']."\n");

        // verifica se ata ja existe
        $issetExistdoc = fileAta::where('name', $_FILES['userfile']['name'])->get();

        // return $_FILES['userfile']['size'];
        if($_FILES['userfile']['size'] > 0 && count($issetExistdoc) == 0){
            try {
                //code...
                // $file = '../public/ata/reunioes/cpp/pdf/';
                // $uploadfile = $file . basename($_FILES['userfile']['name']);
                
                $returnStorage = Storage::disk('Ata')->put('', $request->file('userfile'));
                // return $returnStorage;

                // return substr(strstr($returnStorage, '/'), 1);
                // $justHash = substr(strstr($returnStorage, '/'), 1);
                
                $newAta = new fileAta;
                $newAta->name = $_FILES['userfile']['name'];
                $newAta->responsavel = Auth::id();
                $newAta->responseUpload = $name;
                $newAta->hash = $returnStorage;
                $newAta->size = $_FILES['userfile']['size'];
                $newAta->save();

                return view('CPP.UploadFile.index')->with(['moveAta'=>'ok']);

                // if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
                
                // }else{
                // }
                
            }catch (\Throwable $th) {
                throw $th;
                return view('CPP.UploadFile.index')->with(['moveAta'=>'false']);
            }

        }else{
            return view('CPP.UploadFile.index')->with(['moveAta'=>'false']);
        }

        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="' .$_FILES['userfile']['name']. '"');
        // header('Content-Transfer-Encoding; binary');
        // readfile($fil);

        //$request->input('userfile');
        //return $_FILES['userfile']['name'];

    }//create ...

    public function edit(Request $request){
        
    }//edit()

    public function update(Request $request){
        
    }//update()

    
}
