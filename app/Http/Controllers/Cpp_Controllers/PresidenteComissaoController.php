<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Roles\roles;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use Illuminate\Support\Facades\Auth;
use App\Models\Ata\ata;
use App\Models\Notification\notification;
use App\Http\Controllers\Cpp_Controllers\SecretarioController;
use App\Models\Deliberacao\deliberacao;
use App\Models\Relation_Vote_Deliber\relation_vote_each_deliberacao;
use App\Models\secretario_e_presidente\secretario_e_presidente;


class PresidenteComissaoController extends Controller
{
    //
    public function index(){
        $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->get();

        // return $allUser;
        $allUser = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'users.id')
        ->get();
 
        $notifyNewDeliber = notification::where('read_at', null)->get();

        
        if(empty( $notifyNewDeliber) || count($notifyNewDeliber) == 0){
            $notifyDeliber = null;
            $return_to_vote_member = null;
        }else{
            $notifyDeliber = $notifyNewDeliber[0]->data;

            $return_to_vote_member = deliberacao::where('id_notification', $notifyNewDeliber[0]->id_notification)
            ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
            ->paginate(1);
        }

        // return $return_to_vote_member;
 
        $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);

        return view('/CPP/Presidente_da_Comissao/index')
        ->with(['allUser'=> $allUser, 'lastAta'=>$lastAta, 
        'notifyNewDeliber'=>$notifyNewDeliber, 
        'decodeDeliber'=>$notifyDeliber,
        'return_to_vote_member'=>$return_to_vote_member
        ]);
    }#index()


    public function registry_vote_presidente(){

        $eProtoc = $_GET['eProtocolo'];
         
        if(empty($_GET['Favoravel']) && empty($_GET['Contra'])){
            return "voto vazio";
        }elseif(!empty($_GET['Favoravel']) && !empty($_GET['Contra'])){
            return "Selecione apenas um campo";
        }

        //pego o atual presidente
        $president = secretario_e_presidente::where('status', true)->where('qualificacao', 'Presidente')->get();

        //pego o atual secretario
        $secretario = secretario_e_presidente::where('status', true)->where('qualificacao', 'Secretaria(o)')->get();
        
        //verifico se presidente ja votou este protocolo
        $verify_has_voted = relation_vote_each_deliberacao::where('eProtocolo', $eProtoc)->where('id_membro', $president[0]->id)->get();

        $id_deliberacao = deliberacao::select('id')->where('eProtocolo', $eProtoc)->get();

        // return $id_deliberacao;

        if(!empty($_GET['Favoravel'])){
            if( count($verify_has_voted) > 0 ) return "Você já votou esta deliberação";
            $NewVote = new relation_vote_each_deliberacao;
            $NewVote->id_deliberacao                    = $id_deliberacao[0]->id;
            $NewVote->eProtocolo                        = $eProtoc;
            $NewVote->presidente_desta_deliberacao      = $president[0]->id;
            $NewVote->secretario_desta_deliberacao      = $secretario[0]->id;
            $NewVote->id_membro                         = $president[0]->id;
            $NewVote->was_voted                         = "true";
            $NewVote->votou_favoravel                   = "true";
            $NewVote->save();

            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            if( count($verify_has_voted) > 0 ) return "Você já votou esta deliberação";
            $NewVote = new relation_vote_each_deliberacao;
            $NewVote->id_deliberacao                    = $id_deliberacao[0]->id;
            $NewVote->eProtocolo                        = $eProtoc;
            $NewVote->presidente_desta_deliberacao      = $president[0]->id;
            $NewVote->secretario_desta_deliberacao      = $secretario[0]->id;
            $NewVote->id_membro                         = $president[0]->id;
            $NewVote->was_voted                         = "true";
            $NewVote->votou_contra                      = "true";
            $NewVote->save();

            return redirect($_SERVER['HTTP_REFERER']);
        }

        

        
    }
    // registry_vote_presidente


    public function create(Request $request){

        $countMembers = $request->input('countMembers');
        // return $countMembers;
        try {
            //code...
            $allUser = roles::where('roles.name', 'like', '%Relator%')
            ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->get();
            // return $allUser;


                for ($i=0; $i < $countMembers; $i++) { 
                    # code...                    
                    $resp[] = $request->input('OPCAO'.$i); 
                    $explode_resp = explode(':', $resp[$i]); 
                    // return  $resp;
                    $explode_resp[$j=0]; // @ id único do user;
                    $explode_resp[$j+1]; // @ Habilitar ou desabilitar;
                    $explode_resp[$j+2]; // @ id único da funcão 'Relator' AdminLte da tabela 'Role'
                    $verify_exist__member = users_ative_and_inative_cpp::where('has_user_id', '=', $explode_resp[$j=0])->get();
                    // return count($verify_exist__member);

                    if(empty($verify_exist__member) || count($verify_exist__member) == 0){

                        if($explode_resp[$j+1] == "Desabilitar"){
                            $member_ative_inative = new users_ative_and_inative_cpp;
                            $member_ative_inative->has_user_id = $explode_resp[$j=0];
                            $member_ative_inative->id_roles_permission = $explode_resp[$j=2];
                            $member_ative_inative->user_id_your_status = 0;
                            $member_ative_inative->who_alter_status_user =  Auth::user()->id;
                            $member_ative_inative->save();
                            
                        }else{
                            $member_ative_inative = new users_ative_and_inative_cpp;
                            $member_ative_inative->has_user_id = $explode_resp[$j=0];
                            $member_ative_inative->id_roles_permission = $explode_resp[$j=2];
                            $member_ative_inative->user_id_your_status = 1;
                            $member_ative_inative->who_alter_status_user =  Auth::user()->id;
                            $member_ative_inative->save();                        
                        }// @else

                    }//@ if()  
                    else{
                        if($explode_resp[$j+1] == "Desabilitar"){
                            users_ative_and_inative_cpp::where('has_user_id', $explode_resp[$j=0])
                            ->update(['user_id_your_status'=>0]);
                        }// @if()
                        else{
                            users_ative_and_inative_cpp::where('has_user_id', $explode_resp[$j=0])
                            ->update(['user_id_your_status'=>1]);
                        }// @else

                    }// @else            

                    
                }#for() 

                    return redirect($_SERVER['HTTP_REFERER']);

        } catch (\Throwable $th){

            //throw $th;
            return "Error.: Consulte o Suporte Técnico !";

        }// @cath

    }#create()


    public function show(){

        $novAta = $_GET['novAta'];
        // return $novAta;

        $allUser = roles::where('roles.name', 'like', '%Relator%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->get();
        $verifyAtaOpen = ata::where('ata_finalizada', '=', null)->get();

        if(count($verifyAtaOpen) > 0 ){
            return redirect($_SERVER['HTTP_REFERER'])->with(['allUser'=> $allUser, 'DangerAtaFinalized'=>true]);
        }elseif(empty($novAta)){
            $biggerNumAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);
            if(count($biggerNumAta) == 0){
                $newAta = new ata;
                $newAta->numero_ata = 1;
                $newAta->data_inicio = date('d/m/Y H:i:s');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                return redirect($_SERVER['HTTP_REFERER']);
                // $callIndexSec = new SecretarioController();
                // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }else{
                // return $biggerNumAta;
                $newAta = new ata;
                $newAta->numero_ata = $biggerNumAta[0]->numero_ata+1;
                $newAta->data_inicio = date(' Y-m-d H:i:s ');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                return redirect($_SERVER['HTTP_REFERER']);
                // $callIndexSec = new SecretarioController();
                // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }
        }else{
            $newAta = new ata;
            $newAta->numero_ata = $novAta;
            $newAta->data_inicio = date(' Y-m-d H:i:s ');
            $newAta->save();
            $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
            return redirect($_SERVER['HTTP_REFERER']);
            // $callIndexSec = new SecretarioController();
            // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
        }
    }



}# class PresidenteComissao
