<?php

namespace App\Http\Controllers\Cpp_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\homolog_pontos_positivos\homolog_pontos_positivos;
use Illuminate\Http\Request;
use App\Models\Notification\notification;
use Illuminate\Support\Facades\ Auth;
use App\Models\Deliberacao\deliberacao;
use App\Models\Relation_Vote_Deliber\relation_vote_each_deliberacao;
use ArrayObject;

// foreach($alfabeto as $k => $ch){
//     echo "<br> ";
//    converteEmLetra2((int)($k + 1));
//     echo " - texto: $ch.";
// }

//    function converteEmLetra2($num) {
//        $alfabeto = array('', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
//        if ($num <= 26) {
//            print $alfabeto[$num];
//        } else {
//            $quociente = ((int) ($num / 26));
//            $resto = $num % 26;
//            echo $quociente . " - " . $resto . " ";
//            if ($resto == 0) {
//                return converteEmLetra2($quociente - 1) + converteEmLetra2(26);
//            } else {
//                return converteEmLetra2($quociente) + converteEmLetra2($resto);
//            }
//        }
//    }



class clientController extends Controller{

    static $resultado   = 0;
    static $resto       = 0;
    static $divisor     = 26;    
    static $volateArray = [];
    static $bet         = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'y', 'x','z'];

    public function index(){

        $hpp = DB::table('homlog_pontos_positivos')
        ->where('pertence_ata', 779)
        ->groupBy('distincao', 'key_inciso', 'id' )
        ->orderBy('distincao', 'asc')
        ->orderBy('key_inciso', 'asc')
        ->get();
        
        $distinct   = $hpp[0]->distincao;
        $key_inciso = $hpp[0]->key_inciso;
        $indice     = 0;

        // return $hpp;
        
        for ($i=0; $i < count($hpp); $i++){ 
            # code ...
            if($distinct != $hpp[$i]->distincao || $key_inciso != $hpp[$i]->key_inciso){
                $distinct   = $hpp[$i]->distincao;
                $key_inciso = $hpp[$i]->key_inciso;
                $indice     = 0;
            }
            $arrObj = new ArrayObject($hpp[$i]);
            $arrObj->offsetSet("word", clientController::searchWords($indice));
            $indice++;
        }   
        
        return $hpp;    
    
    }//index()


    
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

}# class PresidenteComissao








// clientController::$explode = explode('.',clientController::$tot);
    // clientController::$tot = (clientController::$explode[0] / clientController::$cont);
    // clientController::$other = explode('.',clientController::$tot);
    // clientController::$ex = (clientController::$tot - clientController::$other[0]);

    // array_push(clientController::$restDiv, ( clientController::$ex * clientController::$cont));

    // if(clientController::$tot < clientController::$cont){
    //     print_r(clientController::$restDiv);
    //     echo clientController::$other[0];
    //     echo "<br> <br>";
    //     return "Concluido";
    //     die();
    // }    


    // $cont = 54 - 26;
    // $i = 0;
    // $stop = 25;

    //      return ((1024 / 26));

    // $loop =1;

    // #code...
    // if( $cont > (count($bet)) ){
    //     $resp = ($cont / count($bet)); //significa quantas vezes percorre o array
    //     while($i < ($resp)-1){
    //         for ($j=0; $j < $cont; $j++){ 
    //             #code ...                
    //             array_push($arraySom, $bet[$i].$bet[$j]);
    //             if($stop == $j){                     
    //                 $cont = ($cont = ($cont - (count($bet))));                     
    //                 if($cont < (count($bet))){                        
    //                     for ($k=0; $k < $cont; $k++) { 
    //                         # code...
    //                         array_push($arraySom, $bet[$i].$bet[$k]);
    //                     }
    //                     break;
    //                 }
    //                 $j = -1;
    //                 break;
    //             }
    //         }            
    //         $i++;
    //     }

    // }//if

    // $arrayUnion = array_merge($bet, $arraySom);
    // return $arrayUnion;

    // phpinfo();

    //     return view('/CPP/Notification/client');

    //     $recuper = relation_vote_each_deliberacao::where('relation_vote_each_deliberacao.id_membro', '=',  3)
    //     ->where('relation_vote_each_deliberacao.id_deliberacao', '=',  306)
    //     ->join('users', 'users.id', '=', 'relation_vote_each_deliberacao.id_membro')->get();

    //     return $recuper;

    //     $membersreturn = relation_vote_each_deliberacao::where('relation_vote_each_deliberacao.id_membro', '=',  3)
    //     ->join('users', 'users.id', '=', 'relation_vote_each_deliberacao.id_membro')->get();

    //     return $membersreturn;

    //     $RelationUsersVoted = relation_vote_each_deliberacao::where('id_deliberacao', 304)->get();
    //     return  $RelationUsersVoted[0]->id_membro;

    //     $respis = notification::where('read_at', null)
    //     ->orderBy('created_at', 'Desc')->paginate(1);

    //     return COUNT($respis);

    //     // $resp = notification::where('read_at', null)
    //     // ->orderBy('created_at', 'Desc')->paginate(1);     
    //     // $decode_json = json_decode($resp[0]->data);
    //     // return $decode_json->{'dados'};
    //     // print_r($decode_json);
    //     // // return $decode_json;
    //     // return "olaaaa";
    //     $user_logged_now = Auth::user();

    //     $resp = notification::where('read_at', null)
    //     ->orderBy('created_at', 'Desc')->paginate(1);
    //     // return $resp;


    //     $resp = notification::where('read_at', null)
    //     ->orderBy('created_at', 'Desc')->paginate(1);

    //     $resp02 = deliberacao::where('id_notification', '=',  $resp[0]->id)
    //     ->paginate(1);
    //     return $resp02;

    //     $verify_if_notify = relation_vote_each_deliberacao::where('id_deliberacao', '=', $resp02[0]->id)
    //     ->where('eProtocolo', '=', $resp02[0]->eProtocolo)
    //     ->where('id_membro', '=', $user_logged_now->id)
    //     ->where('was_voted', 'true')->get();

    //     return count($verify_if_notify);

    //     $rr = Auth::user();
    //     // var_dump($rr);
    //     return $rr;

    //     //  $resp = notification::where('read_at', null)
    //     // ->orderBy('created_at', 'Desc')->paginate(1);
    //     // return $resp[0];
    //     return view('/CPP/Notification/client');
    // }#index()


    // public function create(Request $request){       
    //     return response()->json(['msg','this is message from ajax']);
    // }#create()
