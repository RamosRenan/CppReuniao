<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\ata;
use App\Models\Deliberacao\          deliberacao;
use App\Models\Relation_Vote_Deliber\relation_vote_each_deliberacao;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;




class FindDeliberacaoController extends Controller
{
    //
    public function index(){

        return view('\CPP\FindDeliberacao\index');

    }#index()



    public function create(){

    }#create()



    public function show(Request $request){

        $num_deliberacao = $request->input('num_deliberacao');
        $num_ata = $request->input('num_ata');

        if(!empty($request->all())){

            $choiceDeliber = deliberacao::where('num_deliberacao', $num_deliberacao)
            ->where('numero_ata', $num_ata)->get();

            if(count( $choiceDeliber) == 0){
                return redirect($_SERVER['HTTP_REFERER'])->with('notFoundDeliber', 'false');
            }else{

                $all_memebers_voted_deliber =  relation_vote_each_deliberacao::where('eProtocolo',  $choiceDeliber[0]->eProtocolo)
                ->where('was_voted', 'true')
                ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'relation_vote_each_deliberacao.id_membro')
                ->join('users', 'users.id', '=', 'relation_vote_each_deliberacao.id_membro')
                ->get();
                
                return view('/CPP/FindDeliberacao.show')->with(['all_memebers_voted_deliber'=>$all_memebers_voted_deliber, 'choiceDeliber'=>$choiceDeliber]);
 
            }# else

        }# if()


    }#show()

}#FindDeliberacaoController
