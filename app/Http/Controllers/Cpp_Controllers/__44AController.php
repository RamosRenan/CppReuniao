<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\_A44A\_A44A;
use App\Models\Policial\Policial;
use App\Models\Roles\roles;
use App\Models\Ata\ata;
use App\Models\Relation_Each_44A\relation_vote_each_44A;
use App\Models\Notification\notification;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use App\Models\M4PRO\POLICE;
use App\Models\M4PRO\POLICE_OPM;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\ Auth;


class __44AController extends Controller
{
    /*@  index()  @*/
    public function index(){
        # Busco todos os relatores
        $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->get();

        return view('CPP.44A.index')->with(['CountIsertMembers'=>$CountIsertMembers]);
        
    } /*@  index()  @*/




    /*@  store()  @*/
    public function store(Request $request){

        try {
            //code...
            $newRelationVote44A = new relation_vote_each_44A;
            $newRelationVote44A->id = $request->input('id44A');
            $newRelationVote44A->id_membro = $request->input('id_membro');
            $newRelationVote44A->secretario_desta_deliberacao = $request->input('secretario_desta_deliberacao');
            $newRelationVote44A->presidente_desta_deliberacao = $request->input('presidente_desta_deliberacao');
            $newRelationVote44A->was_voted = true;
            $newRelationVote44A->is_relator_from_this_pedido = false;
            $newRelationVote44A->save();

            return view('CPP/Relator/create')->with('Success', true);

        } catch (\Throwable $th) {
            throw $th;
        }
        
    } /*@  store()  @*/




    /*@  show()  @*/
    public function show($request){

        // return $request;

        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteESecretario =  secretario_e_presidente::where('status', 1)->get();

        $this44A = _A44A::where('A_44_A.eProtocolo', $request)
        ->join('notifications', 'notifications.id_notification', '=', 'A_44_A.id_notification' )
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        ->get();

        $relationVote44A = relation_vote_each_44A::where('relation_vote_each_44A.id', $this44A[0]->id)
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'relation_vote_each_44A.id')->get();

        return view('CPP.Deliberacoes44A.show')->with(['this44A'=>$this44A, 
        'this44AeProtocolo'=>$this44A[0]->eProtocolo,
        'dataThis44A'=>$this44A[0]->contain_delibercao,
        'presidenteSecretario'=>$presidenteESecretario,
        'currentAta'=>$currentAta[0]->numero_ata,
        'relationVote44A'=>$relationVote44A]);

    } /*@  show()  @*/




    /*@  create() Resposável por criar pedidos 44A @*/
    public function create(Request $request){

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
 

        // se foi encontrado policial não insiro novo policial, apenas crio novo 44A.
        if(Policial::where('cpf', $request->input('CPF'))->orWhere('rg', $request->input('RG'))->count() > 0 ){

            #Insere novo 44-A
            $insert44A = new _A44A;
            $insert44A->eProtocolo       = $request->input('eProtocolo');            
            $insert44A->id_policial      = $request->input('CPF');
            $insert44A->descricao_pedido = $request->input('descricao_pedido');
            $insert44A->id_response_relator = $request->input('relator_designado');
            $insert44A->condicao                = 'Cadastrado';
            $insert44A->pertence_ata_num_ata = $verify_has_ata_open[0]->numero_ata;
            $insert44A->save();

            $id = Auth::user();

            //log do cadastro ... 
            Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um cadastro 44A - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");
 
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
 
            //log do cadastro ... 
            Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um cadastro 44A - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");

            //busca membros ativos
            $CountIsertMembers = Members_Relatores_and_President::select('*')->get();
 
            return view('CPP.44A.index')->with(['successIsert44A'=>"success",'CountIsertMembers'=>$CountIsertMembers]);
 
        }#else

    } /*@ create() @*/

   

    /*@  update()  @*/
    public function update(Request $request){
          
    } /*@  update()  @*/




    /*@  edit()  @*/
    public function edit(Request $request){

        if(empty($request->input('vote'))){
            return "Error: Voto NULLO !";
        }
        
        try {
            //code...
            $newRelationVote44A = new relation_vote_each_44A;
            $newRelationVote44A->id = $request->input('id44A');
            $newRelationVote44A->id_membro = $request->input('id_membro');
            $newRelationVote44A->secretario_desta_deliberacao = $request->input('secretario_desta_deliberacao');
            $newRelationVote44A->presidente_desta_deliberacao = $request->input('presidente_desta_deliberacao');
            $newRelationVote44A->was_voted = true;
            if($request->input('vote') == 'contra'){
                $newRelationVote44A->votou_contra = true;
                $newRelationVote44A->votou_favoravel = false;
            }else{
                $newRelationVote44A->votou_favoravel = true;
                $newRelationVote44A->votou_contra = false;
            }
            $newRelationVote44A->is_relator_from_this_pedido = false;
            $newRelationVote44A->save();

            return view('CPP/Relator/create')->with('Success', true);

        } catch (\Throwable $th) {
            throw $th;
        }
    } /*@  edit()  @*/




    /*@  destroy()  @*/
    public function destroy(){

    } /*@  destroy()  @*/


    public function getPolicial(Request $request)
    {
        $arr = array(".", "-");
        $search_cpf_police = str_replace($arr, "", $request->input('search_cpf_police'));
        try {
             //code...
            if(!empty( $search_cpf_police)){

                $result_search_police = POLICE::where('RG', 'like', '%' . $search_cpf_police . '%')->orWhere('CPF', 'like', '%' . $search_cpf_police . '%')->orWhere('NOME', 'like', '%' . $search_cpf_police . '%')->get();
        
                $result_search_police_opm = POLICE_OPM::where('META4', '=', $result_search_police[0]->OPM_META4)->get();
        
                $result_search = array_merge(json_decode($result_search_police), json_decode($result_search_police_opm));
         
                # Busco todos os relatores
                $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
                ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->join('users', 'users.id', '=', 'model_has_roles.model_id')
                ->get();
        
                return view('CPP.44A.index')->with(['result_search' => $result_search, 'CountIsertMembers' => $CountIsertMembers]);
            }
        } catch (\Throwable $th) {
             //throw $th;
             return  redirect()->route('cpp.__44a.index');

             return __44AController::index();
        }
    }

    public function create44A(){
 

    }

} #class __44AController
