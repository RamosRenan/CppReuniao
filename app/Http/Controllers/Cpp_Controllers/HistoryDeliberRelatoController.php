<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\ Auth;
use App\Models\Roles\roles;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\Http\Controllers\Cpp_Controllers\AtaController;
use  App\Models\Ata\ata;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use App\Models\Deliberacao\          deliberacao;
use App\Models\E_Protocolo\eProtocolo;
use App\Models\eProtocoloSorteados\eProtocolosSorteados;


class HistoryDeliberRelatoController extends Controller
{
    // code ...
    /*--------------------------------------|
    |   Retorna o registro de deliberações  |
    |   para um relator.                    |
    |--------------------------------------*/
    public function index(){

        //Pego id do relator, se relator de fato.
        // return $idRelator = Auth::user()->id;

        //verfico se é relator **ativo**(ATIVO)
        //na table role pego todos os users definidos como relatores.
        try {
            //code...
            $getRelator = roles::where('roles.name', 'like', '%@Relator@%')
            ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id',  '=', Auth::user()->id)
            ->get();
        } catch (\Throwable $th) {
            throw $th;
        }

        //Teste de retorno, se pegou o relator.
        // return $getRelator;

        //verifico se o relator esta ativo em 'users_ative_and_inative_cpp'
        if(count($getRelator) > 0){
            $verifyIsAtivo = users_ative_and_inative_cpp::where('has_user_id', $getRelator[0]->model_id)
            ->where('users_ative_and_inative_cpp.user_id_your_status', '=', 1)
            ->get();
        }
        
        if (isset($verifyIsAtivo) && count($verifyIsAtivo)>0){
            # code ...
            $registersDeliber = eProtocolosSorteados::where('eProtocolo_sorteados.id_membro', Auth::user()->id)
            ->join('eProtocolo', 'eProtocolo.eProtocolo', '=', 'eProtocolo_sorteados.eProtocolo')
            ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->join('deliberacao', 'deliberacao.eProtocolo', '=', 'eProtocolo.eProtocolo')
            ->get(); 

            // return $registersDeliber;
        }else{
            return redirect($_SERVER['HTTP_REFERER']);
            // return "Relator não esta ativo, ou não é relator";
        }

        return view('CPP.HistoryDeliberRelator.index')
            ->with(['registersDeliber'=>$registersDeliber, 
        ]);
    }
    // index()

    // Pega um eProtocolo especifico
    // Mostra mais informaçoes da deliberação para o relator
    public function show(){

        $registersDeliber = eProtocolosSorteados::where('eProtocolo_sorteados.id_membro', $_GET['id'])
            ->join('eProtocolo', 'eProtocolo.eProtocolo', '=', 'eProtocolo_sorteados.eProtocolo')
            ->where('eProtocolo.eProtocolo', '=', $_GET['eProtocolo'])
            ->join('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
            ->get();

        // return $registersDeliber;

        return view('CPP.HistoryDeliberRelator.show')->with('registersDeliber', $registersDeliber);
    }
}
