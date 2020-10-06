<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles\roles;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;
use Illuminate\Support\Facades\DB;

class ChartRelatorioRelator extends Controller
{
    //code ...
    public function index(){
        $CountIsertMembers = new ChartRelatorioRelator;
        // return $CountIsertMembers->allMembers();
        return view('/CPP/ChartRelatorioRelator/index')->with(['CountIsertMembers'=>$CountIsertMembers->allMembers()]);
    }//index()

    public function create(Request $request){
        $legendChart = DB::select('SELECT e.pedido, codigopedido, COUNT(codigopedido) Total
        FROM public."eProtocolo" e 
        INNER JOIN "eProtocolo_sorteados" eP on eP."eProtocolo" = e."eProtocolo"
        WHERE eP.id_membro = '.$request->get('id').'
        GROUP BY e.codigopedido, e.pedido');

        foreach($legendChart as $key => $val){
            $val->codigopedido = rtrim($val->codigopedido);
        }
        // return $legendChart;
        $CountIsertMembers = new ChartRelatorioRelator;
        return view('/CPP/ChartRelatorioRelator/index')->with(['legendChart'=>$legendChart, 'CountIsertMembers'=>$CountIsertMembers->allMembers()]);
    }//create()

    private function allMembers(){
        // após inserir os novos relatores na table 'users_ative_inative' junto com a table role.
        $allUser = roles::where('roles.name', 'like', '@Relator@%')
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('users_ative_and_inative_cpp', 'users_ative_and_inative_cpp.has_user_id', '=', 'users.id')
        ->distinct('name')
        ->get();

        // # Busco todos os relatores
        // $members = roles::where('roles.name', 'like', '%Relator%')
        // ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        // ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        // ->get();
        return $allUser;
    }// allMembers()

    public function show($idRelator){

        //busca eProtocolos com o id $idRelator
        $Usorteados = eProtocolosSorteados::where('id_membro', '=', $_GET['id'])
        ->where('parecer_relator', null)
        ->where('relator_votou', null)
        ->join ('eProtocolo', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->join ('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->get();

        //teste de retorno $Usorteados
        // return $Usorteados;

        return view('/CPP/ChartRelatorioRelator/show')->with(['Usorteados'=>$Usorteados]);
    }
    //show()
}
