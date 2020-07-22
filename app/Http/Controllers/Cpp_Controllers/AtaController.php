<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\ata;
use Illuminate\Support\Facades\Auth;
use App\Models\homolog_pontos_positivos\homolog_pontos_positivos;
use App\Models\_A44A\_A44A;
use App\User;
use App\Models\Deliberacao\deliberacao;
use Illuminate\Support\Facades\DB;
use  App\Models\E_Protocolo\eProtocolo;
use ArrayObject;
use PDF;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
// use App\Models\Members_Relatores_President\Members_Relatores_and_President;
// use App\Http\Controllers\Cpp_Controllers\get;


class AtaController extends Controller{

    static $resultado   = 0;
    static $resto       = 0;
    static $divisor     = 26;    
    static $volateArray = [];
    static $bet         = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'y', 'x','z'];

    public function index(){        
        $ativePresidenteSecretario = secretario_e_presidente::all();
        $users_ative_and_inative_cpp = users_ative_and_inative_cpp::where('user_id_your_status', true)
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->get();

        $AtaContent = ata::where('ata.ata_finalizada', null)
        ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        ->orderBy('deliberacao.num_deliberacao', 'Asc')
        ->get();

        if(count($AtaContent) == 0){
            return view('CPP.Sala44A.index');
        }

        $ataOpen = ata::where('ata.ata_finalizada', null)->get();

        if(!empty($ataOpen)){
            $hpp = DB::table('homlog_pontos_positivos')
            ->where('pertence_ata', $ataOpen[0]->numero_ata)
            ->groupBy('distincao', 'key_inciso', 'id' )
            ->orderBy('distincao', 'asc')
            ->orderBy('key_inciso', 'asc')
            ->get();
        }
         
        if(count($hpp) > 0){
            $distinct   = $hpp[0]->distincao;
            $key_inciso = $hpp[0]->key_inciso;
            $indice     = 0;
            
            for ($i=0; $i < count($hpp); $i++){ 
                # code ...
                # $indice recebe zero para haja o recalculo e ordenacao conforme muda para Cbs e Sds e seus respectivos incisos
                # e conforme muda para Sgts e seus respectivos incisos
                # se $indice n recebe zero a ordanecao seguiria sem levar em consideracao a mudanca de Sgts, Cbs e Sds e seus incisos
                # Para cada um deles deve haver a reordenacao alfabetica
                if($distinct != $hpp[$i]->distincao || $key_inciso != $hpp[$i]->key_inciso){
                    $distinct   = $hpp[$i]->distincao;
                    $key_inciso = $hpp[$i]->key_inciso;
                    $indice     = 0;
                }
                $arrObj = new ArrayObject($hpp[$i]);
                $arrObj->offsetSet("word", AtaController::searchWords($indice));
                $indice++;
            }
        }

        $Ata44A = _A44A::where('pertence_ata_num_ata', $ataOpen[0]->numero_ata)->where('was_voted', true)->get();
 
        $userLoged = User::where('id', Auth::user()->id)->get();        

        return view('CPP.Ata.index')
        ->with(['AtaContent'=>$AtaContent, 
                'HomlogAtaContent'=>$hpp, 
                'Ata44A'=>$Ata44A,
                'ativePresidenteSecretario'=> $ativePresidenteSecretario,
                'users_ative_and_inative_cpp'=>$users_ative_and_inative_cpp, 
                'userLoged'=>$userLoged[0]->name]); 

    }// final index();


    function create(){

        $AtaContent = ata::where('ata.ata_finalizada', null)
        ->orderBy('ata.numero_ata', 'Desc')
        ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        ->orderBy('deliberacao.num_deliberacao', 'Asc')
        ->get();

        $hpp = DB::table('homlog_pontos_positivos')
        ->where('pertence_ata', $AtaContent[0]->numero_ata)
        ->groupBy('distincao', 'key_inciso', 'id' )
        ->orderBy('distincao', 'asc')
        ->orderBy('key_inciso', 'asc')
        ->get();
         
        if(count($hpp) > 0){
            $distinct   = $hpp[0]->distincao;
            $key_inciso = $hpp[0]->key_inciso;
            $indice     = 0;
            
            for ($i=0; $i < count($hpp); $i++){ 
                # code ...
                # $indice recebe zero para haja o recalculo e ordenacao conforme muda para Cbs e Sds e seus respectivos incisos
                # e conforme muda para Sgts e seus respectivos incisos
                # se $indice n recebe zero a ordanecao seguiria sem levar em consideracao a mudanca de Sgts, Cbs e Sds e seus incisos
                # Para cada um deles deve haver a reordenacao alfabetica
                if($distinct != $hpp[$i]->distincao || $key_inciso != $hpp[$i]->key_inciso){
                    $distinct   = $hpp[$i]->distincao;
                    $key_inciso = $hpp[$i]->key_inciso;
                    $indice     = 0;
                }
                $arrObj = new ArrayObject($hpp[$i]);
                $arrObj->offsetSet("word", AtaController::searchWords($indice));
                $indice++;
            }
        }

        $Ata44A = _A44A::where('pertence_ata_num_ata', $AtaContent[0]->numero_ata)->get();
 
        $userLoged = User::where('id', Auth::user()->id)->get(); 

        $ativePresidenteSecretario = secretario_e_presidente::all();
        
        $data = [
            'AtaContent'=>$AtaContent, 
            'HomlogAtaContent'=>$hpp, 
            'Ata44A'=>$Ata44A, 
            'userLoged'=>$userLoged[0]->name,
            'ativePresidenteSecretario'=> $ativePresidenteSecretario,
        ];

        $pdf = PDF::loadView('CPP.TesteView.index', $data);

        return $pdf->setPaper('a4')->stream('invoice.pdf');
         
    }// final create();


    # funcao recursiva q realiza divisoes sucessivas ate q seja menor q 26
    # divisao de base 26, de acordo com o tmanho do alfabeto
    # restos e resultado correspondem a posicao das letras do alfabeto;
    public function searchWords($dividendo){

        if($dividendo < 26){
            return  clientController::$bet[$dividendo];
        }
       
        clientController::$resultado = explode('.', $dividendo / clientController::$divisor);           
        clientController::$resto = ($dividendo % 26);       
        
        array_push(clientController::$volateArray, clientController::$bet[clientController::$resto]);

        if(clientController::$resultado[0] < 26){             
            array_push(clientController::$volateArray, clientController::$bet[clientController::$resultado[0]-1]);
            $printWord = (implode("",array_reverse(clientController::$volateArray)));
            clientController::$volateArray = [];
            return $printWord;
        }
        else{
            $dividendo = clientController::$resultado[0];            
            return  searchWords();
        } 

    }# searchWords();
    
    
    
    function edit(Request $request){

        $numero_ata = $request->input('numero_ata');
        $encerramento_reuniao = $request->input('encerramento_reuniao_inner');
        $introducao_reuniao = $request->input('introducao_reuniao');

        //@ Pega o maior número das deliberações independente da ata. 
        //@ A partir do último número inicia-se a numeração das deliberações que não possuem número.
        //@ A contagem deve deve ser zerada a cada ano.
        $maxNumDeliber = deliberacao::where('date_create_deliberacao','like', date('Y').'%')->max('num_deliberacao');
        $selectNumdeliberNullApreciado = deliberacao::where('numero_ata', $numero_ata)->where('num_deliberacao', null)->where('condicao_this_deliberacao', "Apreciado")->get();
        $selectNumdeliberNullRelatado = deliberacao::where('numero_ata', $numero_ata)->where('num_deliberacao', null)->where('condicao_this_deliberacao', "Relatado")->get();
        $selectNumdeliberNullPostergado = deliberacao::where('numero_ata', $numero_ata)->where('num_deliberacao', null)->where('condicao_this_deliberacao', "Postergado")->get();
        $getYearLastCreateDeliber = explode('-', deliberacao::where('date_create_deliberacao','like', date('Y').'%')->max('created_at'));
        
        if( ( (date('Y')) - $getYearLastCreateDeliber[0] ) == 1 ){
            
            //@ 'for' responsável por numerar APRECIADOS
            $maxNumDeliber = 0;
            for ($i=0; $i < count($selectNumdeliberNullApreciado); $i++){ 
                #code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullApreciado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } catch (\Throwable $th) {
                    throw $th;
                }            
            }#for 

             
            //@ 'for' responsável por numerar RELATADOS
            // $maxNumApreciado = deliberacao::where('numero_ata', $numero_ata)->where('condicao_this_deliberacao', "Apreciado")->max('num_deliberacao');
            for ($i=0; $i < count($selectNumdeliberNullRelatado); $i++){ 
                #code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullRelatado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } catch (\Throwable $th) {
                    throw $th;
                }            
            }#for 

             
            //@ Para numerar as deliberacoes 44A pego o maior 'num_deliberacao' das deliberacoes da Ata em questão
            //@ Percorro todas as deliberacoes 44A cujo numero é 'null'
            // $maxNumRelatado = deliberacao::where('numero_ata', $numero_ata)->where('condicao_this_deliberacao', "Relatado")->max('num_deliberacao');
            $get44ANumNull = _A44A::where('pertence_ata_num_ata', $numero_ata)->where('num_44A', null)->get();
            for($i=0; $i < count($get44ANumNull); $i++){ 
                # code...
                try {
                    //code...
                    _A44A::where('id', $get44ANumNull[$i]->id)->update(['num_44A'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } 
                catch (\Throwable $th) {
                    throw $th;
                }
            }#for


            //@ 'for' responsavel por numerar POSTERGADOS 
            // $maxNum44a = _A44A::where('numero_ata', $numero_ata)->max('num_44A');
            for($i=0; $i < count($selectNumdeliberNullPostergado); $i++){ 
                # code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullPostergado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } 
                catch (\Throwable $th) {
                    throw $th;
                }
            }#for


        }else{
             
            //@ 'for' responsável por numerar APRECIADOS
            for ($i=0; $i < count($selectNumdeliberNullApreciado); $i++){ 
                #code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullApreciado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } catch (\Throwable $th) {
                    throw $th;
                }            
            }#for 

             
            //@ 'for' responsável por numerar RELATADOS
            // $maxNumApreciado = deliberacao::where('numero_ata', $numero_ata)->where('condicao_this_deliberacao', "Apreciado")->max('num_deliberacao');
            for ($i=0; $i < count($selectNumdeliberNullRelatado); $i++){ 
                #code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullRelatado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } catch (\Throwable $th) {
                    throw $th;
                }            
            }#for 

             
            //@ Para numerar as deliberacoes 44A pego o maior 'num_deliberacao' das deliberacoes da Ata em questão
            //@ Percorro todas as deliberacoes 44A cujo numero é 'null'
            // $maxNumRelatado = deliberacao::where('numero_ata', $numero_ata)->where('condicao_this_deliberacao', "Relatado")->max('num_deliberacao');
            $get44ANumNull = _A44A::where('pertence_ata_num_ata', $numero_ata)->where('num_44A', null)->get();
            for($i=0; $i < count($get44ANumNull); $i++){ 
                # code...
                try {
                    //code...
                    _A44A::where('id', $get44ANumNull[$i]->id)->update(['num_44A'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } 
                catch (\Throwable $th) {
                    throw $th;
                }
            }#for


            //@ 'for' responsavel por numerar POSTERGADOS 
            // $maxNum44a = _A44A::where('pertence_ata_num_ata', $numero_ata)->max('num_44A');
            for($i=0; $i < count($selectNumdeliberNullPostergado); $i++){ 
                # code...
                try {
                    //code...
                    deliberacao::where('id', $selectNumdeliberNullPostergado[$i]->id)->update(['num_deliberacao'=>$maxNumDeliber = $maxNumDeliber + 1]);
                } 
                catch (\Throwable $th) {
                    throw $th;
                }
            }#for

        }#else   

        
        ata::where( 'numero_ata', $numero_ata )
        ->update([
            'ata_finalizada'=>'true', 
            'response_finalized_ata'=>Auth::user()->id, 
            'data_termino'=>date('Y-m-d'), 'TERMO_ENCERRAMENTO_REUNIAO'=>$encerramento_reuniao, 
            'INTRODUCAO_REAUNIAO_ORDINARIA'=>$introducao_reuniao 
            ]);        

        $newAta = new AtaController();
        return $newAta->show($numero_ata);

        // return redirect()->route('cpp.ata.show',$numero_ata);

    }// final edit();    
    
    
    
    
    
    function show($numero_ata){
        $AtaContent = ata::where('ata.numero_ata', $numero_ata)
        ->orderBy('ata.numero_ata', 'Desc')
        ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        ->orderBy('deliberacao.num_deliberacao', 'Asc')
        ->get();

        $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->where('eProtocolo.status', '=', 'Sorteado')
        ->orderBy('eProtocolo.created_at', 'asc')
        ->paginate(500);

        $Ata44A = _A44A::where('pertence_ata_num_ata', $AtaContent[0]->numero_ata)
        ->where('was_voted', true)
        ->orderBy('num_44A', 'Asc')
        ->get();

        $ativePresidenteSecretario = secretario_e_presidente::all(); 
        $users_ative_and_inative_cpp = users_ative_and_inative_cpp::where('user_id_your_status', true)
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->get();

        $HomlogAtaContent = homolog_pontos_positivos::where('pertence_ata', $AtaContent[0]->numero_ata)->get();

        $userLoged = User::where('id', Auth::user()->id)->get();

        return view('CPP.Ata.create')
                ->with(['AtaContent'=>$AtaContent, 
                        'HomlogAtaContent'=>$HomlogAtaContent, 
                        'Ata44A'=>$Ata44A, 'userLoged'=>$userLoged[0]->name, 
                        'totcadastrado'=>$totcadastrado,
                        'ativePresidenteSecretario'=> $ativePresidenteSecretario,
                        'users_ative_and_inative_cpp'=>$users_ative_and_inative_cpp,

                        'numero_ata'=>$numero_ata]);
    }// final show();  





    function store(){
         
    }// final store();  


    public function generatePdf(Request $request){
        // return $request->input('num_ata');

        $AtaContent = ata::where('ata.numero_ata', $request->input('num_ata'))
        ->orderBy('ata.numero_ata', 'Desc')
        ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        ->orderBy('deliberacao.num_deliberacao', 'Asc')
        ->get();

        $hpp = DB::table('homlog_pontos_positivos')
        ->where('pertence_ata', $AtaContent[0]->numero_ata)
        ->groupBy('distincao', 'key_inciso', 'id' )
        ->orderBy('distincao', 'asc')
        ->orderBy('key_inciso', 'asc')
        ->get();
         
        if(count($hpp) > 0){
            $distinct   = $hpp[0]->distincao;
            $key_inciso = $hpp[0]->key_inciso;
            $indice     = 0;
            
            for ($i=0; $i < count($hpp); $i++){ 
                # code ...
                # $indice recebe zero para haja o recalculo e ordenacao conforme muda para Cbs e Sds e seus respectivos incisos
                # e conforme muda para Sgts e seus respectivos incisos
                # se $indice n recebe zero a ordanecao seguiria sem levar em consideracao a mudanca de Sgts, Cbs e Sds e seus incisos
                # Para cada um deles deve haver a reordenacao alfabetica
                if($distinct != $hpp[$i]->distincao || $key_inciso != $hpp[$i]->key_inciso){
                    $distinct   = $hpp[$i]->distincao;
                    $key_inciso = $hpp[$i]->key_inciso;
                    $indice     = 0;
                }
                $arrObj = new ArrayObject($hpp[$i]);
                $arrObj->offsetSet("word", AtaController::searchWords($indice));
                $indice++;
            }
        }

        $totcadastrado = eProtocolo::join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->where('eProtocolo.status', '=', 'Sorteado')
        ->orderBy('eProtocolo.created_at', 'asc')
        ->paginate(500);
        
        $Ata44A = _A44A::where('pertence_ata_num_ata', $AtaContent[0]->numero_ata)
        ->where('was_voted', true)
        ->orderBy('num_44A', 'Asc')
        ->get();

        $userLoged = User::where('id', Auth::user()->id)->get(); 

        $ativePresidenteSecretario = secretario_e_presidente::all(); 
        $users_ative_and_inative_cpp = users_ative_and_inative_cpp::where('user_id_your_status', true)
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->get();
        // return $users_ative_and_inative_cpp;
        // $Members_Relatores_and_President = Members_Relatores_and_President::all();
        
        $data = [
            'AtaContent'=>$AtaContent, 
            'HomlogAtaContent'=>$hpp, 
            'Ata44A'=>$Ata44A, 
            'userLoged'=>$userLoged[0]->name,
            'totcadastrado'=>$totcadastrado,
            'ativePresidenteSecretario'=> $ativePresidenteSecretario,
            'users_ative_and_inative_cpp'=>$users_ative_and_inative_cpp
        ];

        $pdf = PDF::loadView('/CPP/TesteView/index', $data);

        return $pdf->setPaper('a4')->stream("Ata".$request->input('num_ata').date('Y').".pdf");
    }//generatePdf()
     

    function update(){
    }// final update();  


    public function editDeliberAta(Request $request){
        $idThisDeliber = $request->post('editdeliberinata');
        $contentThisDeliberInAta = $request->post('contentDeliberAprec');
        deliberacao::where('id', $idThisDeliber)->update(['deliberacao'=>$contentThisDeliberInAta]);
        $reCall = new AtaController();
        return $reCall->index();
    }


    public function editDeliberAtaRelatado(Request $request){
        $idThisDeliber = $request->post('editdeliberinatarelatado');
        $contentThisDeliberInAta = $request->post('contentDeliberRel');
        deliberacao::where('id', $idThisDeliber)->update(['deliberacao'=>$contentThisDeliberInAta]);
        $reCall = new AtaController();
        return $reCall->index();
    }
    

    public function editDeliberAta44a(Request $request){
        $idThisDeliber = $request->post('editdeliberinata44a');
        $contentThisDeliberInAta = $request->post('contentDeliber44A');
        _A44A::where('id', $idThisDeliber)->update(['contain_delibercao'=>$contentThisDeliberInAta]);
        $reCall = new AtaController();
        return $reCall->index();
    }


    public function editDeliberAtaPostergado(Request $request){
        $idThisDeliber = $request->post('editDeliberInAtaPost');
        $contentThisDeliberInAta = $request->post('contentDeliberPost');
        deliberacao::where('id', $idThisDeliber)->update(['deliberacao'=>$contentThisDeliberInAta]);
        $reCall = new AtaController();
        return $reCall->index();
    }



    function destroy(){

    }// final destroy(); 
    
    

}//final class Ata;
