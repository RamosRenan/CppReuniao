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
use App\Models\Relation_Each_44A\relation_vote_each_44A;
use App\Models\_A44A\_A44A;

class PresidenteComissaoController extends Controller
{
    //
    public function index(){

        // $CountIsertMembers = roles::where('roles.name', 'like', '%Relator%')
        // ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        // ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        // ->get();


        /*------------------------------------------------------------------| 
        | Na tabela 'Members_Relatores_and_President' encontram-se de fato  |
        |   os relatores ativos e operantes                                 |
        |------------------------------------------------------------------*/
        //Busca todos os 'relatores' ativos e habilitados
        $todosRelatoresAtivosHablitados = roles::where('roles.name', 'like', '%@Relator@%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'users.id')
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('users_ative_and_inative_cpp.user_id_your_status', 1)
        ->get();
        //teste retorno variável
        // return $todosRelatoresAtivosHablitados;


        // Busca em table notification a deliebração q esta em votação
        $notifyNewDeliber = notification::where('read_at', null)->get();
        // return $notifyNewDeliber[0]->data;

        // verifica se existe notification
        // Este if não separa se é uma deliebração ordinária ou uma 44a
        if(isset($notifyNewDeliber) && count($notifyNewDeliber)>0){
            // pega todos os relatores que já votaram deliberação 44a que esta em votação
            
            //verifica se a notificacao é refernte a 44a
            $is_Referer_44a = _A44A::where('A_44_A.id_notification', $notifyNewDeliber[0]->id_notification)
            ->get();

            //busca relação de votos 
            $get_all_Relator_already_voted_44a = _A44A::where('A_44_A.id_notification', $notifyNewDeliber[0]->id_notification)
            ->join('relation_vote_each_44A', 'relation_vote_each_44A.id', '=', 'A_44_A.id')
            ->get();

            // return $get_all_Relator_already_voted_44a;

            /*--------------------------------------------------------------|
            |   Bloco responśavel por pegar deliberação 44a, e os votos     |
            |    de cada relator, para a deliberação 44a                    |
            |--------------------------------------------------------------*/
            //Só entra no if for uma notificação referente a deliebração 44a.
            if( count($is_Referer_44a) > 0){
                $eProtocolo44a = _A44A::where('id_notification', $notifyNewDeliber[0]->id_notification)->get();
                if(count($get_all_Relator_already_voted_44a)>0){

                    $registerId44a =  $get_all_Relator_already_voted_44a[0]->id;

                    // verifica se todos os relatores votaram deliberação 44a
                    if(count($get_all_Relator_already_voted_44a)<count($todosRelatoresAtivosHablitados)){
                        //Se for menor que 3 não há corum para deliberação
                        if(count($get_all_Relator_already_voted_44a)<3)
                            $naoHaCorum44a = true; // verdade, não ha corumn
                            else{
                                $naoHaCorum44a = false; //sim, ha corum
                            }
                        $falta_Voto_Relatores_44a = true; // sim, falta voto
                    }elseif(count($get_all_Relator_already_voted_44a)==count($todosRelatoresAtivosHablitados)){
                        $falta_Voto_Relatores_44a = false; // não falta, todos votaram
                    }


                    /*---------------------------------------------------------------------|
                    |    Faz a contagem dos votos de cada relator referente a deliberacao  |
                    |    44a 'votou_contra' X 'votou_favoravel'                            |
                    |---------------------------------------------------------------------*/
                    $get_count_vote_contra = relation_vote_each_44A::where('relation_vote_each_44A.id', $registerId44a)
                    ->where('relation_vote_each_44A.votou_contra', true)
                    ->count();

                    $get_count_vote_favoravel = relation_vote_each_44A::where('relation_vote_each_44A.id', $registerId44a)
                    ->where('relation_vote_each_44A.votou_favoravel', true)
                    ->count();

                    // Verifica se houve empate ou não
                    if($get_count_vote_contra == $get_count_vote_favoravel){
                        $empateVotacao44a = true;
                    }else{
                        $empateVotacao44a = false;
                    }
                }else{
                    $empateVotacao44a               =null; 
                    $lastAta                        =null;
                    $naoHaCorum44a                  =null; 
                    $falta_Voto_Relatores_44a       =null;
                }

                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);

                return view('/CPP/Presidente_da_Comissao/index')
                ->with([
                    'empateVotacao44a'          =>$empateVotacao44a, 
                    'lastAta'                   =>$lastAta, 
                    'naoHaCorum44a'             =>$naoHaCorum44a, 
                    'falta_Voto_Relatores_44a'  =>$falta_Voto_Relatores_44a,
                    'containDeliber44a'         =>$notifyNewDeliber[0]->data,
                    'eProtocolo44a'             =>$eProtocolo44a[0]->eProtocolo
                ]);

                // return $empateVotacao44a;
                //----------------------------------------------------------------------|
            }
            //if() //verifica se é 44a

            //else para deliberação ordinária
            //notificação não se refere a uma deliberação 44a
            else{

                // pega todos os relatores que já votaram deliberação ordinaria que esta em votação
                $get_all_Relator_already_deliber_ordinaria = deliberacao::where('deliberacao.id_notification', $notifyNewDeliber[0]->id_notification)
                ->join('relation_vote_each_deliberacao', 'relation_vote_each_deliberacao.id_deliberacao', '=', 'deliberacao.id')
                ->get();

                $eProtocoloOrdinaria = deliberacao::where('id_notification', $notifyNewDeliber[0]->id_notification)->get();

                if(count($get_all_Relator_already_deliber_ordinaria)>0){
                    // verifica se todos os relatores votaram deliberação ordinaria
                    if(count($get_all_Relator_already_deliber_ordinaria)<count($todosRelatoresAtivosHablitados)){
                        //Se for menor que 3 não há corum para deliberação
                        if(count($get_all_Relator_already_deliber_ordinaria)<3)
                            $naoHaCorumThisDeliber = true; // verdade, não ha corumn
                            else{
                                $naoHaCorumThisDeliber = false; //sim, ha corum
                            }
                        $falta_Voto_Relatores_desta_deliber = true; // sim, falta voto
                    }elseif(count($get_all_Relator_already_deliber_ordinaria)==count($todosRelatoresAtivosHablitados)){
                        $falta_Voto_Relatores_desta_deliber = false; // não falta, todos votaram
                    }

                    //conta votos contra
                    $qtdVotosContraDeliberOrdinaria = deliberacao::where('id_notification', $notifyNewDeliber[0]->id_notification)
                    ->join('relation_vote_each_deliberacao', 'relation_vote_each_deliberacao.id_deliberacao', '=', 'deliberacao.id')
                    ->where('relation_vote_each_deliberacao.votou_contra', 'true')
                    ->count();
                    // return $return_to_vote_member;

                    //conta votos favoraveis
                    $qtdVotosFavoravelDeliberOrdinaria = deliberacao::where('id_notification', $notifyNewDeliber[0]->id_notification)
                    ->join('relation_vote_each_deliberacao', 'relation_vote_each_deliberacao.id_deliberacao', '=', 'deliberacao.id')
                    ->where('relation_vote_each_deliberacao.votou_contra', 'true')
                    ->count();

                    //verifica se houve empate nesta deliberaçao ordinaria
                    if($qtdVotosContraDeliberOrdinaria == $qtdVotosFavoravelDeliberOrdinaria){
                        $empateVotacaoOrdinaria=true; //sim, houve empate
                    }
                    //if()
                    
                    else{
                        $empateVotacaoOrdinaria=false; //não houve empate
                    }
                    //else
                }
                //if()

                else{
                    $empateVotacaoOrdinaria                     =null; 
                    $naoHaCorum44a                              =null; 
                    $falta_Voto_Relatores_desta_deliber         =null;
                    $naoHaCorumThisDeliber                      =null;
                }

                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(1);

                return view('/CPP/Presidente_da_Comissao/index')
                ->with([
                    'empateVotacaoOrdinaria'            =>$empateVotacaoOrdinaria, 
                    'lastAta'                           =>$lastAta, 
                    'naoHaCorumThisDeliber'             =>$naoHaCorumThisDeliber, 
                    'falta_Voto_Relatores_desta_deliber'=>$falta_Voto_Relatores_desta_deliber,
                    'containDeliberOrdinaria'           =>$notifyNewDeliber[0]->data,
                    'eProtocoloOrdinaria'               =>$eProtocoloOrdinaria[0]->eProtocolo
                ]);
            }
            //else

        }
        //if()

        // else, nao há notificação
        else{
            return view('/CPP/Presidente_da_Comissao/index')
                ->with([
                    'empateVotacaoOrdinaria'            =>null, 
                    'lastAta'                           =>null, 
                    'naoHaCorumThisDeliber'             =>null, 
                    'falta_Voto_Relatores_desta_deliber'=>null,
                    'containDeliberOrdinaria'           =>null,
                    'eProtocoloOrdinaria'               =>null,

                    'empateVotacao44a'          =>null, 
                    'lastAta'                   =>null, 
                    'naoHaCorum44a'             =>null, 
                    'falta_Voto_Relatores_44a'  =>null,
                    'containDeliber44a'         =>null,
                    'eProtocolo44a'             =>null
                ]);
        }
        //else
 

    }#index()


    public function registry_vote_presidente(Request $request){

        // Teste para validar retorno dos campos
        // return $_GET['gender'];
        // return $_GET['eProtocolo'];

        $response_method = $_SERVER['REQUEST_METHOD'] == 'GET' ? 
            (int)(isset($_GET['gender']) && isset($_GET['eProtocolo'])) : 
                0;
        
        //teste de retorno para --> $response_method
        // return $response_method;
        if($response_method){}
        else {
            // return"entrou aqui";
            return redirect($_SERVER['HTTP_REFERER']);
        }
        
        //pego o atual presidente;
        $president = secretario_e_presidente::where('status', true)->where('qualificacao', 'Presidente')->get();

        //pego o atual secretario
        $secretario = secretario_e_presidente::where('status', true)->where('qualificacao', 'Secretaria(o)')->get();
        
        //verifico se presidente ja votou este protocolo
        $verify_has_voted = relation_vote_each_deliberacao::where('eProtocolo', $_GET['eProtocolo'])->where('id_membro', $president[0]->id)->get();

        $id_deliberacao = deliberacao::select('id')->where('eProtocolo', $_GET['eProtocolo'])->get();

        // return $id_deliberacao;

        if(!empty($_GET['gender']) &&  $_GET['gender'] == 'Favoravel'){
            if( count($verify_has_voted) > 0 ) return "Você já votou esta deliberação";
            $NewVote = new relation_vote_each_deliberacao;
            $NewVote->id_deliberacao                    = $id_deliberacao[0]->id;
            $NewVote->eProtocolo                        = $_GET['eProtocolo'];
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
            $NewVote->eProtocolo                        = $_GET['eProtocolo'];
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

        /* Verifica se existe número ata */
        if(isset($novAta) && !empty($novAta)) 
            $verifyExistNumAta = ata::where('numero_ata', '=', $novAta)->get();

        if(isset($verifyExistNumAta) && count($verifyExistNumAta) > 0)
            return back()->withErrors("Numero de Ata já existe !");

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
                $newAta->data_inicio = date('Y-m-d');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                return redirect($_SERVER['HTTP_REFERER']);
                // $callIndexSec = new SecretarioController();
                // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }else{
                // return $biggerNumAta;
                $newAta = new ata;
                $newAta->numero_ata = $biggerNumAta[0]->numero_ata+1;
                $newAta->data_inicio = date('Y-m-d');
                $newAta->save();
                $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
                return redirect($_SERVER['HTTP_REFERER']);
                // $callIndexSec = new SecretarioController();
                // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
            }
        }else{
            $newAta = new ata;
            $newAta->numero_ata = $novAta;
            $newAta->data_inicio = date('Y-m-d');
            $newAta->save();
            $lastAta = ata::orderBy('numero_ata', 'Desc')->paginate(5);
            return redirect($_SERVER['HTTP_REFERER']);
            // $callIndexSec = new SecretarioController();
            // return view('/CPP/Presidente_da_Comissao/index')->with(['allUser'=> $allUser, 'lastAta'=>$lastAta]);
        }
    }



}# class PresidenteComissao
