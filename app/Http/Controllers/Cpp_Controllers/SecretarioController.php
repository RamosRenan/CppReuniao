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

        $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->get();

        for ($i=0; $i < count( $CountIsertMembers); $i++) { 
            $verify = users_ative_and_inative_cpp::where('has_user_id', $CountIsertMembers[$i]->model_id)->paginate(1);
            if(count($verify) == 0){
                $create_users_ative_and_inative_cpp = new users_ative_and_inative_cpp;
                $create_users_ative_and_inative_cpp->has_user_id = $CountIsertMembers[$i]->model_id;
                $create_users_ative_and_inative_cpp->id_roles_permission = $CountIsertMembers[$i]->role_id;
                $create_users_ative_and_inative_cpp->user_id_your_status = 0;
                $create_users_ative_and_inative_cpp->who_alter_status_user = Auth::user()->id;
                $create_users_ative_and_inative_cpp->save();
            }
        }


        $allUser = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'users.id')
        ->get();
        
        $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(6);
        $Members_Relatores_and_President = users_ative_and_inative_cpp::join('Members_Relatores_and_President', 'Members_Relatores_and_President.id_membro', '=', 'users_ative_and_inative_cpp.id')->get();
        $LastDeliberacao = notification::orderBy('notifications.id_notification', 'Desc')
        ->join('deliberacao', 'deliberacao.id_notification', '=', 'notifications.id_notification')
        ->paginate(5);
        $ativePresidenteSecretario = secretario_e_presidente::all();
        // return $ativePresidenteSecretario;
        return view('\CPP\Secretario\index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta,  'ativeInativePresidenteSecretario'=>$ativePresidenteSecretario, 'Members_Relatores_and_President'=>$Members_Relatores_and_President, 'LastDeliberacao'=>$LastDeliberacao]);
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
                // $Members_Relatores_and_President = users_ative_and_inative_cpp::join('Members_Relatores_and_President', 'Members_Relatores_and_President.id_membro', '=', 'users_ative_and_inative_cpp.id')->get();
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





    public function editSecretarioEPresidente(){

        // return  $_GET['Del'];        
        if( isset($_GET['Hbl']) ){
            // return $_GET['H'];
            secretario_e_presidente::where('id', $_GET['id'])->update(['status'=>1 ]);
            return SecretarioController::index();
        }elseif( isset($_GET['Des']) ){
            // return $_GET['D'];
            secretario_e_presidente::where('id', $_GET['id'])->update(['status'=>0 ]);
            return SecretarioController::index();
        }elseif (isset($_GET['Del'])) {
            // return $_GET['Del'];
            secretario_e_presidente::where('id', $_GET['id'])->delete();
            // return $id;
            return SecretarioController::index();
        }else{
            return "Não existe";
        }

    } #update





    public function show($id){

        // return $_GET['close'];
        if(isset($_GET['visualizar'])){
            $turn_back_vote = deliberacao::where('id_notification', $id)
            ->get();             
            return view('\CPP\Secretario\edit')->with(['turn_back_vote'=>$turn_back_vote]);
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






    public function edit($id){

        // return $id;
        
        if( isset($_GET['H']) ){
            // return $_GET['H'];
            users_ative_and_inative_cpp::where('has_user_id', $id)->update(['user_id_your_status'=>1, 'who_alter_status_user'=>Auth::user()->id ]);
            return SecretarioController::index();
        }elseif( isset($_GET['D']) ){
            // return $_GET['D'];
            users_ative_and_inative_cpp::where('has_user_id', $id)->update(['user_id_your_status'=>0, 'who_alter_status_user'=>Auth::user()->id ]);
            return SecretarioController::index();
        }elseif (isset($_GET['Del'])) {
            // return $_GET['Del'];
            users_ative_and_inative_cpp::where('has_user_id', $id)->delete();
            // return $id;
            Members_Relatores_and_President::where('id', $id)->delete();
            return SecretarioController::index();
        }elseif( isset( $_GET['edit_status_membro']) ) {
            Members_Relatores_and_President::where('id', $id)->update( ['qualificacao'=>$_GET['edit_status_membro']] );
            return SecretarioController::index();
        }else{
            return "Não existe";
        }


    }#edit







    public function novoSecretarioPresidente(Request $request){

        #Obs.: Não permitir dois secretarios ou presidentes habilitados

        $presidenteSecretario_name   = $request->input('presidenteSecretario_name'    );
        $presidenteSecretario_posto  = $request->input('presidenteSecretario_posto'   );
        $presidenteSecretario_rg     = $request->input('presidenteSecretario_rg'      );
        $presidenteSecretario_cpf    = $request->input('presidenteSecretario_cpf'     );
        $presidenteSecretario_qualificacao = $request->input('presidenteSecretario_qualificacao');

        // return [$presidenteSecretario_name, $presidenteSecretario_posto, $presidenteSecretario_rg, $presidenteSecretario_cpf, $presidenteSecretario_qualificacao];

        try {
            if(count($request->all()) < 5){
                return redirect($_SERVER['HTTP_REFERER'])->with('allFields', 'false');
            }else {
                # code... nome, posto, rg, cpf, qualificacao, id_membro
                $search_users_ative_and_inative_cpp = User::where('name', 'like',  $presidenteSecretario_name.'%')->get();
                if(empty($search_users_ative_and_inative_cpp) || count($search_users_ative_and_inative_cpp) == 0) return redirect($_SERVER['HTTP_REFERER'])->with('not_found_name_user', "true");
                $novoSecretarioPresidente = new secretario_e_presidente;
                $novoSecretarioPresidente->nome = $presidenteSecretario_name;
                $novoSecretarioPresidente->posto = $presidenteSecretario_posto;
                $novoSecretarioPresidente->rg = $presidenteSecretario_rg;
                $novoSecretarioPresidente->cpf = $presidenteSecretario_cpf;
                $novoSecretarioPresidente->qualificacao = $presidenteSecretario_qualificacao;
                $novoSecretarioPresidente->id_membro = $search_users_ative_and_inative_cpp[0]->id;
                $novoSecretarioPresidente->status = false;
                $novoSecretarioPresidente->save(); 
                return redirect($_SERVER['HTTP_REFERER'])->with('saveSuccess', "true");
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect($_SERVER['HTTP_REFERER'])->with('errorCadastPresidentSecretario', 'false');
        }


    }#store


}#SecretarioController
