<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\Policial\Policial;
use App\Models\M4PRO\POLICE;
use App\Models\M4PRO\POLICE_OPM;
use Illuminate\Support\Facades\ Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;


class CadastroeProtocoloDiversos extends Controller
{
    //
    public function index(Request $request){

        // return $id->roles[0]->name;
        // return url()->current();
        $id = Auth::user();
        Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Acessou a pagina de cadastro - '.'id: '.$id->id.' 
        - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name."\n");

        $search_cpf_police = $request->input('search_cpf_police');
        $arr = array(".", "-");
        $subs = str_replace($arr, "", $search_cpf_police);
        try {
            //code...
            if(!empty( $subs)){
                
                $result_search_police = POLICE::where('RG', 'like', '%'.$subs.'%')->orWhere('CPF', 'like', '%'.$subs.'%')->orWhere('NOME', 'like', '%'.$subs.'%')->get();
                $result_search_police_opm = POLICE_OPM::where( 'META4', '=', $result_search_police[0]->OPM_META4 )->get();
                
                $police_more_opm = array_merge(json_decode($result_search_police), json_decode($result_search_police_opm) );
                
                return view('/CPP/CadastroEprotocolos/index')->with( [ 'result_search'=>$police_more_opm  ] );
            }
        } catch (\Throwable $th) {           
            return view('/CPP/CadastroEprotocolos/index')->with( [ 'messageError'=>'error' ] );
        }            
        return view('/CPP/CadastroEprotocolos/index');
    }



    /*@  store() REsponsável por inserir os pedidos  dos policiais @*/
    public function store(Request $request){

        //valida os campos ...
        $validatedData = $request->validate([
            'Nome'      =>  ['required', 'max:55', 'string', 'not_regex:/[0-9]/i'],
            'Unidade'   =>  ['required', 'max:95', 'string'],
            'Graduacao' =>  ['required', 'max:30', 'string'],
            'rg'        =>  ['required', 'max:15', 'string', 'not_regex:/[A-z]/i'],
            'cpf'       =>  ['required', 'max:11', 'string'],
            'situacao'  =>  ['required', 'max:12', 'string'],
            'pedido'    =>  ['required', 'max:80', 'string'],
            'sid'       =>  ['required', 'max:12', 'string'],
            'keypedido' =>  ['required', 'max:12', 'string'],
            'data_sid'  =>  ['required', 'max:80', 'date'  ],
        ]);

        // teste ...
        // return $validatedData;

        $eProtocolo = new eProtocolo;

        $Policial   = new Policial;

        $Policial->nome        = $request->input ('Nome'        );
        $Policial->unidade     = $request->input ('Unidade'     );
        $Policial->graduacao   = $request->input ('Graduacao'   );
        $Policial->rg          = $request->input ('rg'          );
        $Policial->cpf         = $request->input ('cpf'         );

        $eProtocolo->cpf           = $request->input ('cpf'         );
        $eProtocolo->status        = $request->input ('situacao'    );
        $eProtocolo->conteudo      = $request->input ('descricao'   );
        $eProtocolo->pedido        = $request->input ('pedido'      );
        $eProtocolo->eProtocolo    = $request->input ('sid'         );
        $eProtocolo->codigopedido  = $request->input ('keypedido'   );
        $eProtocolo->entry_system_data = date('Y/m/d');
        $eProtocolo->data_eProtocolo   = $request->input('data_sid');
        $eProtocolo->id_responsavel_cadastro   = Auth::user()->id;

        /*
        * Bloco responsável por validar os dados do formulário     
        * Verificar se já existe no banco o mesmo numero de S.I.D
        */      
        if(eProtocolo::where('eProtocolo', $eProtocolo->eProtocolo)->count() > 0)
            return view('CPP.CadastroEprotocolos.index')->with(['qtdDBeProtocolo'=>1]);


        // if necessário somente para o caso em que não existe o policial.
        if(Policial::where('cpf', $eProtocolo->cpf)->count() == 0){

            $Policial->save();

            $eProtocolo->save();

            $id = Auth::user();

            Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um cadastro - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");
            
            return view('CPP.CadastroEprotocolos.index')->with(['succes'=>'succes']);
        
        // se o policial já existe, apenas insiro o novo eProtocolo.
        }else{ 

            $eProtocolo->save();

            Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um cadastro - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");
            
            return view('CPP.CadastroEprotocolos.index')->with(['succes'=>'succes']);
        }
    } /*@  store()  @*/




    /*@  show()  @*/
    public function show(Request $request){
        // return "hello'";

        if( !empty( $search_pedido = $request->input('search_pedido')) ){
            $resp = eProtocolo::where('eProtocolo.eProtocolo', '=',  $search_pedido)
            ->join('policial', 'eProtocolo.cpf', '=', 'policial.cpf')
            ->get();
            return view('/CPP/CadastroEprotocolos/.show')->with(['Police_Together_eProtocolo' => $resp]);
        }

        $Police_Together_eProtocolo = eProtocolo::where('status', 'Cadastrado')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')                    
        ->orderBy('data_eProtocolo', 'Desc')
        ->paginate(30);
        return view('/CPP/CadastroEprotocolos/.show')->with('Police_Together_eProtocolo', $Police_Together_eProtocolo);

    } /*@  show()  @*/




    /*@  create()  @*/
    public function create(){
        $hh = $_GET['search_cpf_police'];
        return $hh;
    } /*@  create()  @*/




    /*@  update()  @*/
    public function update(Request $request){

        $findSid = $request->input('findSid');       
        $findcpf = $request->input('findcpf');

        eProtocolo::where('eProtocolo', $findSid)
        ->update(['eProtocolo'=> $request->input('eProtocolo'),
                  'pedido'=> $request->input('pedido'),
                  'codigopedido'=> $request->input('keypedido'),
                  'conteudo'=>$request->input('conteudo'),
                  'status'=>$request->input('status'),
                  'entry_system_data'=>$request->input('entry_system_date'),
        ]);

        $resp = Policial::where('cpf', '=', $findcpf)
        ->update(['nome'=> $request->input('nome'),
                  'rg'=> $request->input('rg'),
                  'cpf'=> $request->input('cpf'),
                  'unidade'=> $request->input('unidade'),
                  'graduacao'=> $request->input('graduacao')
        ]);

        $id = Auth::user();
        Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou uma alteração - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.
        ' - ALTERAÇÕES: '.' - Policial: '.$request->input ('nome').' - RG: '.$request->input ('rg').' - cpf: '. $request->input('cpf').' - Unidade: '.$request->input('unidade').
        ' - Graduacao: '.$request->input('graduacao').' - eProtocolo: '.$request->input('eProtocolo').' - pedido: '.$request->input('pedido')."\n");

        return  redirect()->route('cpp.cadastroE-protocolo.show', 0);

        
    } /*@  update()  @*/




    /*@  edit()  @*/
    public function edit($id){
        $resultsid = Policial::where('policial.cpf', '=',  $id)
        ->where('status', 'Cadastrado')
        ->join('eProtocolo', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->get();
        // return $resultsid[0]->nome;
        
        return  view('/CPP/CadastroEprotocolos/.edit')->with('editSid',  $resultsid);

    } /*@  edit()  @*/




    /*@  destroy()  @*/
    public function destroy(){

    } /*@  destroy()  @*/



}#CadastroeProtocoloDiversos
