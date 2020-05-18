<?php

namespace App\Http\Controllers\Cpp_Controllers;

# use App\                        User;
# use App\Models\E_Protocolo\eProtocolo;
# use App\Models\Policial\Policial;
# use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;
use App\Models\Deliberacao\deliberacao;
use Illuminate\Support\Facades\Auth;
use  App\Models\Ata\ata;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\secretario_e_presidente\secretario_e_presidente;



class SalaVotacaoController extends Controller
{
    /*@  index()  @*/
    public function index(){

        $allLastDeliberPostergados = deliberacao::where('numero_ata', '<',  ata::max('numero_ata'))
        ->where('condicao_this_deliberacao', 'Postergado')
        ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get(); 
        // return $allLastDeliberPostergados;

        $totPost = count($allLastDeliberPostergados);

        $searchallMembersAtive = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)->get();
        // return $searchall;

        $relatados = eProtocolosSorteados::where('relator_votou', 'true')
        ->where('deliberou_por', null )
        ->where('quorum', null )
        ->where('votacao_comissao', null )
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get();
        // return $relatados;

        return view('/CPP/SalaVotacao.index')->with(['relatados'=>$relatados, 'allLastDeliberPostergados'=>$totPost,  'searchall'=>$searchallMembersAtive]);

    } /*@  index()  @*/




    /*@  store()  @*/
    public function store(Request $request){
        $allLastDeliberPostergados = deliberacao::where('numero_ata', '<',  ata::max('numero_ata'))
        ->where('condicao_this_deliberacao', 'Postergado')
        ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get(); 
        // return $allLastDeliberPostergados;

        $totPost = count($allLastDeliberPostergados);

        $eProtocolo = $request->input('numeProtocolo');
        $searchallMembersAtive = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)->get();

        $relatados = eProtocolosSorteados::where('eProtocolo_sorteados.eProtocolo', $eProtocolo )
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get();
        // return $relatados;

        return view('/CPP/SalaVotacao.index')->with(['relatados'=>$relatados, 'allLastDeliberPostergados'=>$totPost,  'searchall'=>$searchallMembersAtive]);

    } /*@  store()  @*/




    /*@  show()  @*/
    public function show($num_sid, $selectdecision, $ComissaoOpnou, $ComissaoCorum){

        
    } /*@  show()  @*/




    /*@  create()  @*/
    public function create(Request $request){

        $num_sid          = $request->input('eProtocolo'         );
        $selectdecision   = $request->input('decisao_da_comissao');
        $ComissaoOpnou    = $request->input('ComissaoOpnou'      );
        $ComissaoCorum    = $request->query('ComissaoCorum'      );
        $Condicao         = $request->query('Condicao'           );

        # Pega a útima ata criada que está abeta.
        $verify_ata_has_open = ata::where('data_termino', null)
        ->where('ata_finalizada', null)
        ->orderBy('numero_ata', 'DESC')
        ->orderBy('data_inicio', 'DESC')
        ->orderBy('created_at', 'DESC')
        ->paginate(1);
        // return  $verify_ata_has_open ;


        
        # Faz verificação e pega presidente e secretário atual q estejam ativos ('status' == true);
        $presidente_response_e_response_secretary = secretario_e_presidente::orWhere('qualificacao', 'Presidente')
        ->orWhere('qualificacao', 'Secretario')
        ->where('status', '=', 1)->get();
        # return $presidente_response_e_response_secretary;
        if( count($presidente_response_e_response_secretary ) == 1 || count($presidente_response_e_response_secretary ) == 0 || empty($presidente_response_e_response_secretary ) )
            return redirect('http://'.$_SERVER['HTTP_HOST'].'/'.'cpp'.'/'.'salavotacao')->with('is_not_has_president_or_secretary', 'exxced'); 



        # Retorna para mesma pagina de requisição com aviso de que não há ata aberta.
        # É necessário ter ata em aberto para gerar deliberacão.
        if(count( $verify_ata_has_open) == 0){
            return redirect('http://'.$_SERVER['HTTP_HOST'].'/'.'cpp'.'/'.'salavotacao')->with('excedeu', 'exxced');
        }
        else{     

            $verify_exist_eProtoc_in_table_deliberacao = deliberacao::where('eProtocolo', $num_sid)->paginate(1);

            # Na tabela deliberação não pode ser inserido número eProtocolo repetido. (Em hipótese alguma).
            # Mensagem exibida na View(CPP.deliberacoes.index);
            # Na View Deliberacoes.index, impede que o usuario ao atualizar a pagina insira uma nova deliberação com o mesmo eProtocolo.
            if(count($verify_exist_eProtoc_in_table_deliberacao) > 0){
                echo "<div class='alert alert-danger' role='alert'>
                            Atenção ! Não ATUALIZE, FECHE ou VOLTE a pagina nesta fase da deliberação. Favor seguir com o ciclo da votação.
                    </div>";// view('\CPP\Deliberacoes\show');
            }
            else{   # Pego a última deliberação com base no id (increments 1). 
                    $numeration_deliberation_deliberacao_confere = deliberacao::orderBy('id',  'Desc')
                    ->paginate(1);
                    // return $numeration_deliberation_deliberacao_confere[0]->date_create_deliberacao;
                    # Tratamento do dado com explode, para pegar apenas o ano da deliberação em " $numeration_deliberation_deliberacao_confere "
                    // $getYearDeliber = explode('-', $numeration_deliberation_deliberacao_confere[0]->date_create_deliberacao);
                    $o = 1;
                    # Crio uma nova deliberecao e Zero a numeracao caso Ano Novo.
                    if($o == 1){
                        $newDeliber = new deliberacao;
                        $newDeliber->eProtocolo = $num_sid;
                        $newDeliber->numero_ata =  $verify_ata_has_open[0]->numero_ata;
                        $newDeliber->condicao_this_deliberacao =  $Condicao;
                        if($presidente_response_e_response_secretary[0]->qualificacao == 'Secretario'){
                            $newDeliber->response_secretary =  $presidente_response_e_response_secretary[0]->nome;
                            $newDeliber->presidente_response =  $presidente_response_e_response_secretary[1]->nome;
                        }
                        else{
                            $newDeliber->presidente_response =  $presidente_response_e_response_secretary[1]->nome;
                            $newDeliber->response_secretary =  $presidente_response_e_response_secretary[0]->nome;
                        }                        
                        $newDeliber->date_create_deliberacao = date('Y-m-d H:i:s');
                        $newDeliber->save();
                    }else{
                        # Crio uma nova deliberacao e incremento numero da delieracao se NAO ano novo.
                        $newDeliber = new deliberacao;
                        $newDeliber->eProtocolo = $num_sid;
                        $newDeliber->numero_ata =  $verify_ata_has_open[0]->numero_ata;
                        $newDeliber->condicao_this_deliberacao =  $Condicao;
                        if($presidente_response_e_response_secretary[0]->qualificacao == 'Secretario'){
                            $newDeliber->response_secretary=  $presidente_response_e_response_secretary[0]->nome;
                        }
                        else{
                            $newDeliber->presidente_response =  $presidente_response_e_response_secretary[1]->nome;
                        }
                        $newDeliber->date_create_deliberacao = date('Y-m-d H:i:s');
                        $newDeliber->save();
                    }#else

            }#else;

            

            $numeration_deliberation_deliberacao_ = deliberacao::where('eProtocolo', $num_sid)->get();  

            $sidTableTotable = eProtocolosSorteados::where('eProtocolo_sorteados.eProtocolo', $num_sid)
            ->join('eProtocolo', 'eProtocolo.eProtocolo' , '=', 'eProtocolo_sorteados.eProtocolo')
            ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')->get();

            $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretario')
            ->where('status', true)->get();

            # @ Atualizo table eProtocolosSorteados com o resultado da sala de votacao  @ #            
            eProtocolosSorteados::where('eProtocolo', $num_sid)
            ->update(['deliberou_por'=>$selectdecision, 'quorum'=>$ComissaoCorum, 'votacao_comissao'=>$ComissaoOpnou, 'condicao_this_deliber'=>$Condicao]);
            
            $data_users =  users_ative_and_inative_cpp::where('user_id_your_status', 1);//colocar condição;    
            # @ @

            // return  $sidTableTotable[0];
            return view('\CPP\Deliberacoes\index')->with([
                'deliberacao'=> $numeration_deliberation_deliberacao_,
                'presidenteSecretario'=> $presidenteSecretario,
                'sidTableTotable'=> $sidTableTotable,
                'ComissaoOpnou'=>$ComissaoOpnou, 
                'ComissaoCorum'=>$ComissaoCorum,
                'numeration_deliberation_ata'=>$verify_ata_has_open[0]->numero_ata,
                'numeration_deliberation_deliberacao'=>$numeration_deliberation_deliberacao_[0]->num_deliberacao,
                'numeration_deliberation_deliberacao_ID'=>$numeration_deliberation_deliberacao_[0]->id,
                'data_users'=>$data_users,
                'id_auth'=> Auth::user()->id,
                
            ]); 

        }
 
        

    } /*@  create()  @*/




    /*@  update()  @*/
    public function update(Request $request){

        
        
    } /*@  update()  @*/




    /*@  edit()  @*/
    public function edit($id){
        

    } /*@  edit()  @*/




    /*@  destroy()  @*/
    public function destroy(){
        
    } /*@  destroy()  @*/
}
