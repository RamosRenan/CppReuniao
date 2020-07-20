<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles\roles;
use Illuminate\Support\Facades\Auth;
use App\Models\Ata\ata;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\                             User;
use App\Models\Deliberacao\deliberacao;
use App\Models\Notification\         notification;
use App\Models\secretario_e_presidente\secretario_e_presidente;


class SecretarioController extends Controller
{
    //
    public function index(){
        //na table role pego todos os users definidos como relatores.
        $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->get();

        // percorro o array e cada relator encontrado insiro na table 'users_ative_and_instive_cpp' 
        for ($i=0; $i < count( $CountIsertMembers); $i++) { 
            // verify se existy relator, se naõ existe, então isiro novo relator.
            $verify = users_ative_and_inative_cpp::where('has_user_id', $CountIsertMembers[$i]->model_id)->paginate(1);

            if(count($verify) == 0){
                $create_users_ative_and_inative_cpp                         = new users_ative_and_inative_cpp;
                $create_users_ative_and_inative_cpp->has_user_id            = $CountIsertMembers[$i]->model_id;
                $create_users_ative_and_inative_cpp->id_roles_permission    = $CountIsertMembers[$i]->role_id;
                $create_users_ative_and_inative_cpp->user_id_your_status    = 0;
                $create_users_ative_and_inative_cpp->who_alter_status_user  = Auth::user()->id;
                $create_users_ative_and_inative_cpp->save();
            }
            // if
        }
        //for

        // após inserir os novos relatores na table 'users_ative_inative' junto com a table role.
        $allUser = roles::where('roles.name', 'like', '@Relator@%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'users.id')
        ->distinct('name')
        ->get();
        
        // teste retorno dos relatores encontrados 
        //return $allUser;
        
        /*
        $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(6);
        $Members_Relatores_and_President = users_ative_and_inative_cpp::join('Members_Relatores_and_President', 'Members_Relatores_and_President.id_membro', '=', 'users_ative_and_inative_cpp.id')->get();
        $LastDeliberacao = notification::orderBy('notifications.id_notification', 'Desc')
        ->join('deliberacao', 'deliberacao.id_notification', '=', 'notifications.id_notification')
        ->paginate(5);

        $ativePresidenteSecretario = secretario_e_presidente::all(); */
        // return $ativePresidenteSecretario;

        return view('CPP.Secretario.hdrelator')->with(['allUser'=> $allUser]);
    }#index


    public function create(Request $request){

        $userName       = $request->input('relator_name');
        $relator_posto  = $request->input('relator_posto');
        $relator_rg     = $request->input('relator_rg');
        $relator_cpf    = $request->input('relator_cpf');
        $relator_qualificacao = $request->input('relator_qualificacao');
        $portariaCg = $request->input('portariaCg');
        $datePortaria = $request->input('datePortaria');
 
        // return count($request->all());
        if( count($request->all()) == 7 ){

            $search_users_ative_and_inative_cpp = User::where('name', 'like', $userName.'%')->get();
            // return $search_users_ative_and_inative_cpp;
            if(count($search_users_ative_and_inative_cpp) == 0) return redirect($_SERVER['HTTP_REFERER'])->with(['not_found_name_user'=>true]); 
            
            // return $search_users_ative_and_inative_cpp;
            if(count($search_users_ative_and_inative_cpp) > 0){
                $this_user = users_ative_and_inative_cpp::where('has_user_id', $search_users_ative_and_inative_cpp[0]->id)->get();
                $Members_Relatores_and_President = new Members_Relatores_and_President;
                $Members_Relatores_and_President->id_membro    = $this_user[0]->id;
                $Members_Relatores_and_President->id    = $search_users_ative_and_inative_cpp[0]->id;
                $Members_Relatores_and_President->nome  = $search_users_ative_and_inative_cpp[0]->name;
                $Members_Relatores_and_President->posto = $relator_posto;
                $Members_Relatores_and_President->rg    = $relator_rg;
                $Members_Relatores_and_President->cpf   = $relator_cpf;
                $Members_Relatores_and_President->qualificacao  = $relator_qualificacao;
                $Members_Relatores_and_President->portariaCG    = $portariaCg;
                $Members_Relatores_and_President->datePortaria  = $datePortaria;
                $Members_Relatores_and_President->save();

                // $allUser = roles::where('roles.name', 'like', '%Relator%')
                // ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->join('users', 'users.id', '=', 'model_has_roles.model_id')
                // ->get();
                // $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                return redirect($_SERVER['HTTP_REFERER'])->with(['saveSuccess'=> true]); 
                
                return SecretarioController::index();
                
            }else{
                return redirect($_SERVER['HTTP_REFERER'])->with(['lack_fields'=> false]); 
                // return "Error.: Não foi preenchido todos os campos ... ={";
                }#else
            }else{
                return redirect($_SERVER['HTTP_REFERER'])->with(['lack_fields'=> false]); 
            }#else
    }#create
    
    
    public function edit(){
         
    } #update
    
    
    public function show($id){

        // return $_GET['close'];
        if(isset($_GET['visualizar'])){
            $turn_back_vote = deliberacao::where('id_notification', $id)
            ->get();             
            return view('CPP.Secretario.edit')->with(['turn_back_vote'=>$turn_back_vote]);
        }
        elseif(isset($_GET['close'])  && $_GET['close'] == 0){           
            notification::where('id_notification', $id)->update(['read_at'=>date('Y-m-d H:i:s')]);
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            $countNotificationOpen = notification::where('read_at', null)->get();   
            if(count($countNotificationOpen) > 0){
                return redirect($_SERVER['HTTP_REFERER'])->with('moreThanOneDeliberOpen', "true");
            }else{  
                $verifyIfAtaIsFinalized = notification::where('notifications.id_notification', $id)->join('deliberacao', 'deliberacao.id_notification', '=', 'notifications.id_notification')
                ->join('ata', 'ata.numero_ata', '=', 'deliberacao.numero_ata')->get();
                if($verifyIfAtaIsFinalized[0]->ata_finalizada == "true"){
                    return redirect($_SERVER['HTTP_REFERER'])->with('ataFinalized', true);
                }else{
                    
                    notification::where('id_notification', $id)->update(['read_at'=>null]);
                    return redirect($_SERVER['HTTP_REFERER']);
                }       
            }
        }#esle        
        
    }#show
    

    
    public function editRegistryRelator(){
        // return $id;
        if( isset($_GET['H']) ){
            // return $_GET['H'];
            users_ative_and_inative_cpp::where('has_user_id', $_GET['key'])->update(['user_id_your_status'=>1, 'who_alter_status_user'=>Auth::user()->id ]);
            return SecretarioController::novorelator();
        }elseif( isset($_GET['D']) ){
            // return $_GET['D'];
            users_ative_and_inative_cpp::where('has_user_id', $_GET['key'])->update(['user_id_your_status'=>0, 'who_alter_status_user'=>Auth::user()->id ]);
            return SecretarioController::novorelator();
        }elseif (isset($_GET['Del'])) {
            // return $_GET['Del'];
            users_ative_and_inative_cpp::where('has_user_id', $_GET['key'])->delete();
            // return $id;
            Members_Relatores_and_President::where('id', $id)->delete();
            return SecretarioController::index();
        }elseif( isset( $_GET['edit_status_membro']) ) {
            Members_Relatores_and_President::where('id', $_GET['keyid'])->update( ['qualificacao'=>$_GET['edit_status_membro']] );
            return SecretarioController::novorelator();
        }else{
            return "Não existe";
        }
        
        
    }#edit

    public function editRegistryPresidentSecretario(){
        // return $id;
        if( isset($_GET['H']) ){
            // return $_GET['H'];
            secretario_e_presidente::where('id', $_GET['key'])->update(['status'=>1]);
            return SecretarioController::novopresidentsecretario();
        }elseif( isset($_GET['D']) ){
            // return $_GET['D'];
            secretario_e_presidente::where('id', $_GET['key'])->update(['status'=>0]);
            return SecretarioController::novopresidentsecretario();
        }elseif (isset($_GET['Del'])) {
            // return $_GET['Del'];
            secretario_e_presidente::where('id', $_GET['key'])->delete();
            // return $id;
             return SecretarioController::novopresidentsecretario();
        }else{
            return "Não existe";
        }
    }#edit
    
    
    public function novoSecretarioPresidente(Request $request){
        
        #Obs.: Não permitir dois secretarios ou presidentes habilitados
        
        
        
        // return [$presidenteSecretario_name, $presidenteSecretario_posto, $presidenteSecretario_rg, $presidenteSecretario_cpf, $presidenteSecretario_qualificacao];
        
        try{
            if(count($request->all()) < 5){
                return redirect($_SERVER['HTTP_REFERER'])->with('allFields', 'false');
            }else {
                # code... nome, posto, rg, cpf, qualificacao, id_membro
                $search_users_ative_and_inative_cpp = User::where('name', 'like', $request->input('presidenteSecretario_name').'%')
                ->orWhere('username', 'like', $request->input('presidenteSecretario_name').'%')
                ->get();
                // return $search_users_ative_and_inative_cpp;
                if(empty($search_users_ative_and_inative_cpp) || count($search_users_ative_and_inative_cpp) == 0) 
                return redirect($_SERVER['HTTP_REFERER'])->with('not_found_name_user', "true");
                
                        $novoSecretarioPresidente               = new secretario_e_presidente;
                        $novoSecretarioPresidente->nome         = $search_users_ative_and_inative_cpp[0]->name;
                        $novoSecretarioPresidente->posto        = $request->input('presidenteSecretario_posto');
                        $novoSecretarioPresidente->rg           = $request->input('presidenteSecretario_rg');
                        $novoSecretarioPresidente->cpf          = $request->input('presidenteSecretario_cpf');
                        $novoSecretarioPresidente->qualificacao = $request->input('presidenteSecretario_qualificacao');
                        $novoSecretarioPresidente->id_membro    = $search_users_ative_and_inative_cpp[0]->id;
                        $novoSecretarioPresidente->status       = true;
                        $novoSecretarioPresidente->save(); 
                        
                        return redirect($_SERVER['HTTP_REFERER'])->with('saveSuccess', "true");
                    }
                } catch (\Throwable $th) {
                    throw $th;
                    // return redirect($_SERVER['HTTP_REFERER'])->with('errorCadastPresidentSecretario', 'false');
                }
                
            }#store
            

    public function novata(){
        
        $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(20);
        
        // return $lastAta;

        return view('CPP.Secretario.novata')
        ->with(['lastAta'=>$lastAta]);

    }
    //novata
    
    public function novorelator(){

        $verifyIfExistRelatoresRegistrered = Members_Relatores_and_President::select('*')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'Members_Relatores_and_President.id')
        ->get();
        
        return view('CPP.Secretario.novorelator')->with(['Members_Relatores_and_President'=>$verifyIfExistRelatoresRegistrered]);

    }
    //novata

    public function novopresidentsecretario(){

        $ativePresidenteSecretario = secretario_e_presidente::select('*')->get(); 

        return view('CPP.Secretario.novopresidentsecretario')->with(['ativeInativePresidenteSecretario'=>$ativePresidenteSecretario]);
    }

    public function reabrirvotacao(){

        $LastDeliberacao = notification::orderBy('notifications.id_notification', 'Desc')
        ->join('deliberacao', 'deliberacao.id_notification', '=', 'notifications.id_notification')
        ->paginate(5);

        return view('CPP.Secretario.reabrirvotacao')->with(['LastDeliberacao'=>$LastDeliberacao]);
    }

    
}#SecretarioController
