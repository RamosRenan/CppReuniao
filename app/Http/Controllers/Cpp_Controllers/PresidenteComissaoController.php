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
        }else{
            $notifyDeliber = $notifyNewDeliber[0]->data;
        }
 
        $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);

        return view('/CPP/Presidente_da_Comissao/index')
        ->with(['allUser'=> $allUser, 'lastAta'=>$lastAta, 
        'notifyNewDeliber'=>$notifyNewDeliber, 
        'decodeDeliber'=>$notifyDeliber]);
    }#index()


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
            return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'DangerAtaFinalized'=>'DangerAtaFinalized']);
        }elseif(empty($novAta)){
            $biggerNumAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);
            if(count($biggerNumAta) == 0){
                $newAta = new ata;
                $newAta->numero_ata = 1;
                $newAta->data_inicio = date('d/m/Y H:i:s');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                $callIndexSec = new SecretarioController();
                return $callIndexSec->index();
                return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }else{
                // return $biggerNumAta;
                $newAta = new ata;
                $newAta->numero_ata = $biggerNumAta[0]->numero_ata+1;
                $newAta->data_inicio = date(' Y-m-d H:i:s ');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                $callIndexSec = new SecretarioController();
                return $callIndexSec->index();
                return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }
        }else{
            $newAta = new ata;
            $newAta->numero_ata = $novAta;
            $newAta->data_inicio = date(' Y-m-d H:i:s ');
            $newAta->save();
            $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
            $callIndexSec = new SecretarioController();
            return $callIndexSec->index();
            return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
        }
    }



}# class PresidenteComissao
