<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\                        User;
use Illuminate\Support\Facades\ Auth;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;
use App\Models\Notification\notification;
use App\Models\Relation_Vote_Deliber\relation_vote_each_deliberacao;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\Deliberacao\deliberacao;
use App\Models\_A44A\_A44A;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use App\Models\Policial\Policial;
use App\Models\Relation_Each_44A\relation_vote_each_44A;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;


class RelatorController extends Controller
{

    public function findAllRel(){
        $searchallMembersAtive = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)->get();

        return $searchallMembersAtive;
    }


    /*@  index()  @*/
    public function index(){
        // echo "<a href=".$_COOKIE['url_dliber'].">"."click here"."</a>";
        $usename    = User::where('id',  Auth::user()->id)->get();
        $Usorteados = eProtocolosSorteados::where('id_membro', '=',  Auth::user()->id)
        ->where('parecer_relator', null)
        ->where('relator_votou', null)
        ->join ('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join ('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->get();
        return view('/CPP/Relator.index')->with(['usename'=>$usename, 'Usorteados'=>$Usorteados]);

    } /*@  index()  @*/


    public function editParecerPostergados(Request $request){
        $Usorteados = eProtocolosSorteados::where('eProtocolo_sorteados.eProtocolo', $request->get('eProtocolo'))
        ->join('eProtocolo', 'eProtocolo.eProtocolo', '=', 'eProtocolo_sorteados.eProtocolo')
        ->where('eProtocolo.eProtocolo', '=', $request->get('eProtocolo'))
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->get();

        //teste de retorno
        // return  $Usorteados;
        
        return view('/CPP/Relator.editParecerPostergados')->with(['Usorteados'=>$Usorteados]);
    }


    public function updateParecerPostergados(Request $request){
        // return "chamou certo";
        eProtocolosSorteados::where('eProtocolo',  $request->get('eProtocolo'))
        ->update(['relator_opnou_por'=>$request->get('voto_relator'), 'parecer_relator'=>$request->get('parecer')]);

          return view('/CPP/Relator.editParecerPostergados')->with(['updateok'=>true]);
    }//updateParecerPostergados()



    /*@  store()  @*/
    public function store(Request $request){
    
        $num_sid      = $request->input('num_sid'     );
        $parecer      = $request->input('parecer'     );
        $opnou_por    = $request->input('voto_relator');
                    
        eProtocolosSorteados::where( 'id_membro', Auth::user()->id )
        ->where('eProtocolo', '=', $num_sid)
        ->where('relator_votou', null)
        ->where('relator_opnou_por', null)
        ->where('parecer_relator', null)
        ->update(['parecer_relator'=>$parecer, 'relator_opnou_por'=>$opnou_por, 'relator_votou'=>'true']);

        eProtocolo::where('eProtocolo', '=', $num_sid)
        ->update(['status'=>'Relatado']);

        return redirect()->route('cpp.relator.index');

    } /*@  store()  @*/



    /*@  show()  @*/
    public function show(){
        
        $resp = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')
        ->paginate(1); 

        if(count($resp)>0){
            $turn_back_vote = deliberacao::where('id_notification', $resp[0]->id_notification)
            ->join('relation_vote_each_deliberacao', 'relation_vote_each_deliberacao.id_deliberacao', '=', 'deliberacao.id')
            ->where('id_membro', '=', Auth::user()->id)
            ->get();
            // return count($turn_back_vote);
            if(count($turn_back_vote) > 0){
                return view('/CPP/Relator/show')->with(['turn_back_vote'=>$turn_back_vote]);
            }else{
                return redirect($_SERVER['HTTP_REFERER'])->with('nothen_turnback_deliber', true);
            }
        }#if()
        else{
            return redirect($_SERVER['HTTP_REFERER'])->with('nothen_turnback_deliber', true);
        }#else


    } /*@  show()  @*/


    public function votardeliberacao(){
        return view('CPP.Relator.votardeliberacao');
    }


    /*@  create()  @*/
    public function create(){

        $resp = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')
        ->paginate(1);  

        // return $resp;

        if(empty($resp) || count($resp) == 0){
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else{
            $return_to_vote_member = deliberacao::where('id_notification', $resp[0]->id_notification)
            ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
            ->paginate(1);
            // return  $return_to_vote_member[0];

            $usename    = User::where('id', Auth::user()->id)->get();
            $Usorteados = eProtocolosSorteados::where('id_membro', '=', Auth::user()->id)
            ->where('parecer_relator', null)
            ->where('relator_votou', null)
            ->join ('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
            ->join ('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->get();
            // return $Usorteados[0];

            if(isset($return_to_vote_member[0]->eProtocolo)){
                $exist_member_voted_with_deliber = relation_vote_each_deliberacao::where('id_membro', Auth::user()->id)
                ->where('eProtocolo',  $return_to_vote_member[0]->eProtocolo)->get();
    
                if( count($exist_member_voted_with_deliber ) > 0 ){
                    return RelatorController::index();
                }# @ if()@ #
                else{
                    return view('CPP.Relator.votardeliberacao')
                    ->with(['usename'=>$usename, 
                            'Usorteados'=>$Usorteados, 
                            'return_to_vote_member'=>$return_to_vote_member, 
                            'logedUser'=>Auth::user()->id]);
                }# @ else @ #    
            
            }# @ else @ # 
            else{
                return redirect($_SERVER['HTTP_REFERER']);
            }
            
        }
 
    } /*@  create()  @*/



    /*@  update()  @*/
    public function update(Request $request){

        return RelatorController::mostra();

       $NewVote = $request->input('id_deliberacao');
       return $NewVote;
        
    } /*@  update()  @*/



    /*@  edit()  @*/
    public function edit(Request $request, $var){

        //return Auth::user()->id;
        if(count(Members_Relatores_and_President::where('id', Auth::user()->id)->get()) == 0 ){
            return redirect($_SERVER['HTTP_REFERER'])->with('itNotRelator', true);
        }

        // return $var;
        if(empty($request->input('vote'))){
            return redirect($_SERVER['HTTP_REFERER'])->with('vote_white', true);
        }

        # Bloco de código executado somente para corrigir o voto errado
        # $var == 1 será true somente quando a requisicao da pagina  /CPP/Relator/show vir com 1
        # Permite correcao dos votos 
        if($var == 1){
            $get_user_voted = relation_vote_each_deliberacao::where('eProtocolo', $request->input('eProtoc'))
            ->where('id_membro', $request->input('id_membro'))
            ->where('was_voted', "true")
            ->get();

            if(count( $get_user_voted ) > 0 ){
                if($get_user_voted[0]->votou_contra == "true" && $request->input('vote') == "favoravel"){
                    // return $get_user_voted[0]->votou_contra;
                    // return $request->input('vote');
                    relation_vote_each_deliberacao::where('eProtocolo', $request->input('eProtoc'))
                    ->where('id_membro', $request->input('id_membro'))
                    ->where('was_voted', "true")
                    ->update(['votou_contra'=>null, 'votou_favoravel'=>"true"]);
                    return RelatorController::index();
                }elseif($get_user_voted[0]->votou_favoravel == "true" && $request->input('vote') == "favoravel"){

                    return RelatorController::index();

                }elseif ($get_user_voted[0]->votou_contra == "true" && $request->input('vote') == "contra") {

                    return RelatorController::index();

                }else{
                    // return $get_user_voted[0]->votou_favoravel;
                    // return $request->input('vote');
                    relation_vote_each_deliberacao::where('eProtocolo', $request->input('eProtoc'))
                    ->where('id_membro', $request->input('id_membro'))
                    ->where('was_voted', "true")
                    ->update(['votou_favoravel'=>null, 'votou_contra'=>"true"]);
                    return RelatorController::index();
                }
            }else{
                return "Error.: RelatorController/edit - Consultar o suporte técnico.";
            }
        }
        #Corrcao dos votos


        # Registra os votos dos membros e filtra se favorável ou não.
        $verify_vote = $request->input('vote');
        if($verify_vote == "favoravel"){

            $idDelieberacao = deliberacao::where('eProtocolo', $request->input('eProtoc'))->paginate(1);

            $isRelatorThisDeliber = eProtocolosSorteados::where('eProtocolo',  $request->input('eProtoc'))
            ->where('id_membro', Auth::user()->id)
            ->get();

            //pego o atual presidente
            $president = secretario_e_presidente::where('status', true)->where('qualificacao', 'Presidente')->get();
            //pego o atual secretario
            $secretario = secretario_e_presidente::where('status', true)->where('qualificacao', 'Secretaria(o)')->get();

            //verifico na tabela eProtocolosSorteados para saber se o relator em questao é o relator da deliberacao
            $get_eProtoc_sorteado = eProtocolosSorteados::where('eProtocolo', $request->input('eProtoc'))->get();

            if($get_eProtoc_sorteado[0]->id_membro == Auth::user()->id){
                $yes_relator_this_deliber = "true";
            }else{
                $yes_relator_this_deliber = "false";
            }

            $NewVote = new relation_vote_each_deliberacao;
            if( count($isRelatorThisDeliber) > 0 ) $NewVote->is_relator_from_this_pedido = "true";
            $NewVote->id_deliberacao = $idDelieberacao[0]->id;
            $NewVote->eProtocolo     = $request->input('eProtoc');
            $NewVote->presidente_desta_deliberacao     = $president[0]->id;
            $NewVote->secretario_desta_deliberacao     = $secretario[0]->id;
            $NewVote->is_relator_from_this_pedido      = $yes_relator_this_deliber;
            $NewVote->id_membro      = $request->input('id_membro');
            $NewVote->was_voted      = "true";
            $NewVote->votou_favoravel = "true";
            $NewVote->save();
            return redirect()->route('cpp.relator.index');
        
        }else{   
            
            $idDelieberacao = deliberacao::where('eProtocolo', $request->input('eProtoc'))->paginate(1);

            $isRelatorThisDeliber = eProtocolosSorteados::where('eProtocolo',  $request->input('eProtoc'))
            ->where('id_membro', Auth::user()->id)
            ->get();

            //pego o atual presidente
            $president = secretario_e_presidente::where('status', true)->where('qualificacao', 'Presidente')->get();
            //pego o atual secretario
            $secretario = secretario_e_presidente::where('status', true)->where('qualificacao', 'Secretaria(o)')->get();

            //verifico na tabela eProtocolosSorteados para saber se o relator em questao é o relator da deliberacao
            $get_eProtoc_sorteado = eProtocolosSorteados::where('eProtocolo', $request->input('eProtoc'))->get();

            if($get_eProtoc_sorteado[0]->id_membro == Auth::user()->id){
                $yes_relator_this_deliber = "true";
            }else{
                $yes_relator_this_deliber = "false";
            }
            
            $NewVote = new relation_vote_each_deliberacao;
            if( count($isRelatorThisDeliber) > 0 ) $NewVote->is_relator_from_this_pedido = "true";
            $NewVote->id_deliberacao = $idDelieberacao[0]->id;
            $NewVote->eProtocolo     = $request->input('eProtoc');
            $NewVote->presidente_desta_deliberacao     = $president[0]->id;
            $NewVote->secretario_desta_deliberacao     = $secretario[0]->id;
            $NewVote->is_relator_from_this_pedido      = $yes_relator_this_deliber;
            $NewVote->id_membro      = $request->input('id_membro');
            $NewVote->was_voted      = "true";
            $NewVote->votou_contra   = "true";
            $NewVote->save();
            return redirect()->route('cpp.relator.index');
        
        }
        // notification::where('read_at', null)
        // ->orderBy('created_at', 'Desc')->update(['read_at'=>date("Y-m-d H:i:s")]);

    } /*@  edit()  @*/


    public function  __44A(){
        $usename    = User::where('id',  Auth::user()->id)->get();
        $my44A = _A44A::where( 'A_44_A.id_response_relator', Auth::user()->id )
        ->where('relator_opnou_por', null)
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')->get();

        // return $my44A[0];
        // $policial = Policial::where('cpf', $my44A[0]->id_policial)->paginate(1);
        // // return $policial;

        return view('CPP/Relator/edit')->with(['usename'=>$usename, 'my44A'=>$my44A]);
 
    } /*@ relationMemberTo44A @*/


    public function votar44A(){
        $ativePresidenteSecretario = secretario_e_presidente::where('status', true)
        ->get();
        // return  $ativePresidenteSecretario[0];
        foreach ($ativePresidenteSecretario as $key) {
            # code...
            if( $key->qualificacao == 'Secretaria(o)'){
                $ativeSecretario = $key->id;
            }
            elseif ($key->qualificacao == 'Presidente') {
                # code...
                $ativePresident = $key->id;
            }else{
                $ativeSecretario = null;
                $ativePresident = null;
            }
        }
 
        $toVote44A = notification::where('notifications.read_at', null)
        ->join('A_44_A', 'A_44_A.id_notification', '=', 'notifications.id_notification')->get();

        if(count( $toVote44A) == 0 || empty( $toVote44A)){
            return view('CPP/Relator/votar44A')->with('emptyToVote44A', false);
        }
        // $decode44A = json_decode( $toVote44A[0]['data'] );
        // return $decode44A->{'dados'};
 
        /*@ Verifica se existe voto do relator referente ao mesmo e-Protocolo. @*/
        $verifyExistsVote = relation_vote_each_44A::where('relation_vote_each_44A.id_membro',  Auth::user()->id)
        ->where('relation_vote_each_44A.id', $toVote44A[0]->id)
        ->join('A_44_A', 'A_44_A.id', '=', 'relation_vote_each_44A.id')->get();

        if(count($verifyExistsVote) > 0){
            return view('CPP/Relator/votar44A');
        }else{

            $decode44A = json_decode( $toVote44A[0]['data'] );      /* separa conteúdo da deliberação */
            
            return view('CPP/Relator/votar44A')                     /* retorna dados para view 'CPP/Relator/votar44A' */
            ->with([
                'vote44AData'=>$decode44A->{'dados'},                   /* conteúdo da deliberação */
                'responseRelator'=>$toVote44A[0]->id_response_relator,  /* id relator responsavel pela deliberação */
                'userLoged'=>Auth::user()->id,                          /* usuario logado */
                'ativeSecretario'=>$ativeSecretario,                    /* id do secretario ativo */ 
                'ativePresident'=>$ativePresident,                      /* id do presidente ativo */
                'id44A'=>$toVote44A[0]->id,                             /* id do pedido 44A */
                'id44ANotification'=>$toVote44A[0]->id_notification,    
                'emptyToVote44A'=>true  
            ]);
            
        }        

    }# votar44A

    
    public function update44_A(Request $request){

        $usename    = User::where('id',  Auth::user()->id)->get();

        $referer44A = $request->input('eProtocolo_referer_44A');        
        $parecer    = $request->input('opnouPor');        
        $myParecer  = $request->input('myParecer'); 

        _A44A::where('eProtocolo', $referer44A)->update(['descricao_parecer'=>$myParecer, 'relator_opnou_por'=> $parecer]);
        
        $my44A = _A44A::where( 'A_44_A.id_response_relator', Auth::user()->id )
        ->where('relator_opnou_por', null)
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')->get();
        

        return view('CPP/Relator/edit')->with(['usename'=>$usename, 'updateSuccess'=>'true', 'my44A'=>$my44A]);

    }# update44_A


    public function registre_Vote44A(Request $request){
        
        /* Test retorno request se chegou todos os dados */
        // return $request;

        if(empty($request->input('vote'))){
            return "<b> Não </b> é possível votar em branco. Volte a página e <b> insira </b> seu voto ! ";
        }
        
        try {
            //code...
            $newRelationVote44A = new relation_vote_each_44A;
            $newRelationVote44A->id = $request->input('id44A');
            $newRelationVote44A->id_membro = $request->input('id_membro');
            $newRelationVote44A->secretario_desta_deliberacao = $request->input('secretario_desta_deliberacao');
            $newRelationVote44A->presidente_desta_deliberacao = $request->input('presidente_desta_deliberacao');

            if($request->input('vote') == 'contra'){
                $newRelationVote44A->votou_contra = true;
                $newRelationVote44A->votou_favoravel = false;
            }else{
                $newRelationVote44A->votou_favoravel = true;
                $newRelationVote44A->votou_contra = false;
            }

            $newRelationVote44A->is_relator_from_this_pedido = false;
            
            $newRelationVote44A->save();

            return view('CPP/Relator/votar44A')->with('Success', true);

        } catch (\Throwable $th) {
            throw $th;
        }
    }# registre_Vote44A


    /*@  destroy()  @*/
    public function destroy(){
 
    } /*@  destroy()  @*/



    public function searcheParecer(){
        $relatados = eProtocolosSorteados::where( 'id_membro', Auth::user()->id )
        ->where('condicao_this_deliberacao', null)
        ->where('relator_votou', 'true')->get();
        return view('CPP/Relator/editParecer')->with('relatados', $relatados);
        // return  $relatados;
    }


    public function editParecer(Request $request){
        $foundEditParecer = eProtocolosSorteados::where( 'id_membro', Auth::user()->id )
        ->where('eProtocolo_sorteados.condicao_this_deliberacao', null)
        ->where('eProtocolo_sorteados.eProtocolo', $request->get('eProtocolo'))
        ->where('eProtocolo_sorteados.relator_votou', 'true')
        ->join('eProtocolo', 'eProtocolo.eProtocolo', '=', 'eProtocolo_sorteados.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->get();
        
        //teste retorno
        // return $foundEditParecer;

        return view('CPP/Relator/foundEditParecer')->with('foundEditParecer', $foundEditParecer);
    }


    public function alterParecer(Request $request){
        try {
            //code...
            eProtocolosSorteados::where( 'id_membro', Auth::user()->id )
            ->where('eProtocolo', $request->get('eProtocolo'))
            ->update(['relator_opnou_por'=>$request->get('opnou'), 'parecer_relator'=>$request->get('description')]);
            // return $foundEditParecer;
            return redirect($_SERVER['HTTP_REFERER'])->with('successedit', true);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    
    public function parecerPostergados(){
        $postergados = eProtocolosSorteados::where('id_membro', Auth::user()->id)
        ->where('relator_opnou_por', 'postergar')
        ->get();
        // return $postergados;
        return view('CPP/Relator/showParerPostergados')->with(['postergados'=>$postergados]);
    }

}# final class


