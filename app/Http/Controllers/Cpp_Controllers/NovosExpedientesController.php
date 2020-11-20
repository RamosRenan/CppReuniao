<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\Policial\Policial;
use Illuminate\Support\Facades\DB;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\Models\Deliberacao\deliberacao;
use  App\Models\Ata\ata;

class NovosExpedientesController extends Controller
{
    /*@  index()  @*/
    public function index(Request $request){
        
        $sorteio_qtd    = $request->query  ('sorteio_qtd'   );
        $sorteio_tipo   = $request->query  ('keypedido'     );
        $sorteio_datai  = $request->query  ('sorteio_datai' ); 
        $sorteio_dataf  = $request->query  ('sorteio_dataf' );

        $searchall = users_ative_and_inative_cpp::where('users_ative_and_inative_cpp.user_id_your_status', true)
        ->join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->get();


        if( $request->query ('search_all') == "on" ){

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->orderBy('eProtocolo.created_at', 'asc')
            ->get(); 

            return  view('/CPP/NovosExpedientes.show')->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);
        }

        if( !empty($sorteio_qtd) && !empty($sorteio_tipo) && !empty($sorteio_datai) && !empty($sorteio_dataf) ){

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->where('eProtocolo.codigopedido', '=', $sorteio_tipo)
            ->whereBetween('eProtocolo.entry_system_data', [$sorteio_datai, $sorteio_dataf])
            ->orderBy('eProtocolo.created_at', 'asc')
            ->paginate($sorteio_qtd); 
            return  view('/CPP/NovosExpedientes.show')->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);

        }elseif(!empty($sorteio_qtd)){

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->orderBy('eProtocolo.created_at', 'asc')
            ->paginate($sorteio_qtd); 
            return  view('/CPP/NovosExpedientes.show')->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);

        }elseif(!empty($sorteio_tipo)){

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->where('eProtocolo.codigopedido', '=', $sorteio_tipo)
            ->orderBy('eProtocolo.created_at', 'asc')
            ->get(); 
            return  view('/CPP/NovosExpedientes.show')->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);
    
        }elseif( !empty($sorteio_datai) && !empty($sorteio_dataf) ){

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->whereBetween('eProtocolo.entry_system_data', [$sorteio_datai, $sorteio_dataf])
            ->orderBy('eProtocolo.created_at', 'asc')
            ->get(); 
            return  view('/CPP/NovosExpedientes.show')->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);

        }else{
            return view('/CPP/NovosExpedientes.index')->with(['verify_request_button'=> false]);
        }
              

    } /*@  index()  @*/





     /*@  create()  @*/
     public function create(Request $request){
        $relator_id = $_GET['user_membro'];
        $ePotocolo  = $_GET['numero_sid' ];

        $findeProtocolo = eProtocolosSorteados::where('eProtocolo', $ePotocolo)->get(); //verifica na tabela 'eProtocolosSorteados' se N. protocolo já foi sorteado 
        $searchall     = users_ative_and_inative_cpp::where('user_id_your_status', true)
        ->get();//colocar condição;       

        if(!count($findeProtocolo) > 0 && !empty($relator_id) && !empty($ePotocolo)){
            eProtocolo::where('eProtocolo', '=', $ePotocolo)->update(['status'=>'Sorteado']);
            $sorteioManual = new \App\Models\eProtocoloSorteados\eProtocolosSorteados;
            $sorteioManual->eProtocolo = $ePotocolo;
            $sorteioManual->id_membro = $relator_id;
            $sorteioManual->save(); 

            $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->where('eProtocolo.status', '=', 'Cadastrado')
            ->orderBy('eProtocolo.created_at', 'asc')
            ->get(); 

            return  redirect($_SERVER['HTTP_REFERER'])->with(['tot'=>$totcadastrado, 'searchall'=>$searchall]);

        }else{
            echo "<h1> Info: Você atualizou a após designar manualmente um pedido para um relator. Número de sid já existente. Volter ao inicio. <h1/>";
        }
    } /*@  create()  @*/

    /*@  edit()  @*/
    public function edit(Request $request){

        $tot = $request->all();

        /* Get just relators ative */
        $relator = users_ative_and_inative_cpp::where('user_id_your_status', 1)->get();

        try {
            for ($i=0; $i < count($tot); $i++) {
                $verify = eProtocolosSorteados::where('eProtocolo', $tot['object'.$i])->get();
                if(!count($verify) > 0){
                    eProtocolo::where('eProtocolo', '=', $tot['object'.$i])->update(['status'=>'Sorteado']);
                    $sorteio = new \App\Models\eProtocoloSorteados\eProtocolosSorteados;
                    $sorteio->eProtocolo = $tot['object'.$i];
                    $sorteio->id_membro = $relator[$i % count($relator)]->has_user_id;
                    $sorteio->save(); 
                }else{
                    return "Error.: Consulte o Suporte Técnico !";
                }
            }
            // endfor
            
            return view('/CPP/NovosExpedientes.show')->with(['succes'=>'succes']);
        } 
        catch (\Throwable $th) {
            //     return $th;
            return $th."Error.: Consulte o Suporte Técnico !";
        }
    } /*@  edit()  @*/

    /*@  store()  @*/
    public function store(){

    } /*@  store()  @*/

    /*@  show()  @*/
    public function show($idmembro){

        // return $request;
        // $relator_id = $_GET['user_membro'];

        $verify = eProtocolosSorteados::where('eProtocolo_sorteados.id_membro', $idmembro)
        ->where('relator_votou', 'true')
        ->where('deliberou_por', null)
        ->where('quorum', null)
        ->where('votacao_comissao', null)
        ->join ('eProtocolo', 'eProtocolo.eProtocolo' , '=', 'eProtocolo_sorteados.eProtocolo')
        ->join ('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join ('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')->get();

        $allLastDeliberPostergados = deliberacao::where('numero_ata', '<',  ata::max('numero_ata'))
        ->where('deliberacao.condicao_this_deliberacao', 'Postergado')
        ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get(); 

        $totPost = count($allLastDeliberPostergados);

        // return $verify;

        $searchall = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)
        ->get();

        // return $searchall;

        if( count($verify) > 0 ){
            return  view('/CPP/SalaVotacao.index')->with(['relatados'=>$verify, 'allLastDeliberPostergados'=>$totPost, 'searchall'=>$searchall]);
        }else{
            return  view('/CPP/SalaVotacao.index')->with(['emptyrelatados'=>false, 'allLastDeliberPostergados'=>$totPost, 'searchall'=>$searchall]);
        }

    } /*@  show()  @*/
   




    /*@  update()  @*/
    public function update(){        
        
        
    } /*@  update()  @*/


    

    /*@  newExpedienteProtocolSelected()  @*/
    public function newExpedienteProtocolSelected(Request $request){   

        // return $request->all();
        
        if($request->isMethod('post')){

            $req = json_encode($request->all());

            // return $req;

            return view('/CPP/NovosExpedientes/create')->with(['showSelected'=>$request->all()]);

        }else{
            return redirect($_SERVER['HTTP_REFERER']);
        }
        
    } /*@  newExpedienteProtocolSelected()  @*/



    /*@  destroy()  @*/
    public function destroy(){
        
    } /*@  destroy()  @*/

}//final class

