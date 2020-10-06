<?php

namespace App\Http\Controllers\Cpp_Controllers;

use App\Http\Controllers\Controller;
use App\Models\M4PRO\POLICE;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;
use App\Models\userInvoicePad;
use App\Models\_A44A\_A44A;
use App\Models\Notification\         notification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Models\anexo_eProtocolos\files_anexo_eProtocolos_refence_pedidos;
use App\Http\Controllers\Cpp_Controllers\__44AController;
use App\Models\Ata\ata;
use App\Models\Policial\Policial;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;


class registry44A extends Controller
{
    //
    public function index(){
        phpinfo();
    }


    public function store(Request $request){

        // return $request->file('FormControlFile_44A')->getClientOriginalExtension();
         
        $verify_has_ata_open  = ata::where('ata_finalizada', null)->get();
 
        // necessário verificar se existe ata aberta para serem inseridos 44A.
        if(count($verify_has_ata_open) == 0 || empty( $verify_has_ata_open )){

            $CountIsertMembers = Members_Relatores_and_President::select('*')->get();

            return view('CPP.44A.index')->with(['CountIsertMembers'=>$CountIsertMembers, 'ataVazia'=>false]);
        }
        // if

        if(_A44A::where('eProtocolo', $request->input('eProtocolo'))->count() > 0)
            return redirect($_SERVER['HTTP_REFERER'])->with(['alredy_existy_eProtocolo'=>true]); 

        // Validação dos campos ...
        $validatedData = $request->validate([
            'eProtocolo'        =>  ['required', 'max:12', 'string'],
            'Nome'              =>  ['required', 'max:60', 'string', 'not_regex:/[0-9]/i'],
            'Unidade'           =>  ['required', 'max:100', 'string'],
            'RG'                =>  ['required', 'max:15', 'string', 'not_regex:/[A-z]/i'],
            'CPF'               =>  ['required', 'max:11', 'string', 'not_regex:/[A-z]/i'],
            'Graduacao'         =>  ['required', 'max:15', 'string'],
            'relator_designado' =>  ['required', 'max:120','string'],
            'descricao_pedido'  =>  ['required', 'string'],
        ]);
        // teste return...
        // return $validatedData;

        // validacao do arquivo
        if ($request->file('FormControlFile_44A')->isValid() && $request->file('FormControlFile_44A')->getClientOriginalExtension() == "pdf") {
            
            // cria hash com base no nome do arquivo e tempo
            $hashedNameArq = Hash::make($request->file('FormControlFile_44A')->getClientOriginalName().time('H:i:s'), [
                'memory'    => 1,
                'time'      => 2,
                'threads'   => 2,
            ]);

            // return  $hashedNameArq;

            try {
                //code...
                //instancia para novo anexo
                $newAnexoeProtcolo                      = new files_anexo_eProtocolos_refence_pedidos;
                $newAnexoeProtcolo->nome_arquivo        = $request->file('FormControlFile_44A')->getClientOriginalName();
                $newAnexoeProtcolo->path                = $request->file('FormControlFile_44A')->path();
                $newAnexoeProtcolo->eprotocolo_foreign  = $request->input ('eProtocolo');
                $newAnexoeProtcolo->PK_cpf__policial    = $request->input ('CPF');
                $hashSplit = str_split($hashedNameArq);
                
                for($i=0; $i < count($hashSplit); $i++){
                    # code...
                    if($hashSplit[$i] == '/')
                    $hashSplit[$i] = '.';
                }
                
                $newAnexoeProtcolo->hash = implode('', $hashSplit);
                $newAnexoeProtcolo->save();

                $file =  '/home/pmpr/public/reuniaoCpp/cpp/policialPedidos/anexo_eProtocolos/';

                move_uploaded_file($_FILES['FormControlFile_44A']['tmp_name'], $file.implode('', $hashSplit));

            } catch (\Throwable $th) {
                throw $th;
            }

        }else{
            return redirect()->back()->with('errorAnexo', 'Error no Arquivo enviado'); 
        }

        // se foi encontrado policial não insiro novo policial, apenas crio novo 44A.
        if(Policial::where('cpf', $request->input('CPF'))->orWhere('rg', $request->input('RG'))->count() > 0 ){

            #Insere novo 44-A
            $insert44A                          = new _A44A;
            $insert44A->eProtocolo              = $request->input('eProtocolo');            
            $insert44A->id_policial             = $request->input('CPF');
            $insert44A->descricao_pedido        = $request->input('descricao_pedido');
            $insert44A->id_response_relator     = $request->input('relator_designado');
            $insert44A->condicao                = 'Cadastrado';
            $insert44A->pertence_ata_num_ata    = $verify_has_ata_open[0]->numero_ata;

            $insert44A->save();

            $id = Auth::user();

            //log do cadastro ... 
            // Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um cadastro 44A - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");
 
            //busca membros ativos
            $CountIsertMembers = Members_Relatores_and_President::select('*')->get();

            return view('CPP.44A.index')->with(['successIsert44A'=>"success",'CountIsertMembers'=>$CountIsertMembers]);

        }else{

            #Se policial não esxiste, então crio um novo policial.
            $insertPolicial             = new Policial;
            $insertPolicial->cpf        = $request->input('CPF');
            $insertPolicial->rg         = $request->input('RG');
            $insertPolicial->nome       = $request->input('Nome');
            $insertPolicial->graduacao  = $request->input('Graduacao').' '.$request->input('Quadro');
            $insertPolicial->unidade    = $request->input('Unidade');
            $insertPolicial->save();
            
            #Insere novo 44A.
            $insert44A                          = new _A44A;
            $insert44A->eProtocolo              = $request->input('eProtocolo');            
            $insert44A->id_policial             = $request->input('CPF');
            $insert44A->descricao_pedido        = $request->input('descricao_pedido');
            $insert44A->id_response_relator     = $request->input('relator_designado');
            $insert44A->condicao                = 'Cadastrado';
            $insert44A->pertence_ata_num_ata    = $verify_has_ata_open[0]->numero_ata;
            $insert44A->save();

            $id = Auth::user();
        }
        //else

        $returnCreate44A = new __44AController;
        return $returnCreate44A->create();
    }
    //store()



}# class PresidenteComissao