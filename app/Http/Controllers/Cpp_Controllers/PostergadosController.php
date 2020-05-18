<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\ata;
use App\Models\Deliberacao\deliberacao;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use Illuminate\Support\Facades\Auth;

class PostergadosController extends Controller
{
    //code ...

    public function index(){
        $allLastDeliberPostergados = deliberacao::where('numero_ata', '<',  ata::max('numero_ata'))
        ->where('condicao_this_deliberacao', 'Postergado')
        ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'deliberacao.eProtocolo')
        ->join('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('users', 'eProtocolo_sorteados.id_membro', '=', 'users.id')
        ->get();

        $searchallMembersAtive = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)->get();

        return view('/CPP/SalaVotacaoPost.index')->with(['allLastDeliberPostergados'=>$allLastDeliberPostergados,  'searchall'=>$searchallMembersAtive]);

    }// index()

    public function create(Request $request){

            # Pega a útima ata criada que está abeta.
            $verify_ata_has_open = ata::where('data_termino', null)
            ->where('ata_finalizada', null)
            ->orderBy('numero_ata', 'DESC')
            ->orderBy('data_inicio', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(1);
            // return  $verify_ata_has_open ;
        
            $num_sid          = $request->input('eProtocolo'         );
            $selectdecision   = $request->input('decisao_da_comissao');
            $ComissaoOpnou    = $request->input('ComissaoOpnou'      );
            $ComissaoCorum    = $request->query('ComissaoCorum'      );
            $Condicao         = $request->query('Condicao'           );
            $numeration_deliberation_deliberacao_ = deliberacao::where('eProtocolo', $num_sid)->get(); 
            
            deliberacao::where('eProtocolo', $num_sid)->update(['numero_ata'=>$verify_ata_has_open[0]->numero_ata, 'num_deliberacao'=>null, 'condicao_this_deliberacao'=>$Condicao]);

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
}//final class
