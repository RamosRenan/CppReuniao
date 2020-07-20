<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\E_Protocolo\eProtocolo;
use Illuminate\Support\Facades\ Auth;
use App\                        User;
use App\Http\Controllers\Cpp_Controllers\RelatorController;


class FilterPedidosRelatorController extends Controller
{
    //code ...

    public function index(){
        return view('CPP/FilterPedidosRelator/index');
    }//index()

    public function create(Request $request){
        // return $request->input('keypedido');
        $usename    = User::where('id',  Auth::user()->id)->get();
        $selectedPedidos = eProtocolo::where('codigopedido', $request->input('keypedido'))
        ->join ('policial', 'policial.cpf', '=', 'eProtocolo.cpf')
        ->join('eProtocolo_sorteados', 'eProtocolo_sorteados.eProtocolo', '=', 'eProtocolo.eProtocolo')
        ->where('eProtocolo_sorteados.parecer_relator', null)
        ->where('eProtocolo_sorteados.relator_votou', null)
        ->where('eProtocolo_sorteados.id_membro', Auth::user()->id)
        ->get();
        if(empty($selectedPedidos)){
            $res = new RelatorController();
            return $res->index();
        }else{
            $res = new RelatorController();
            // return $res->index();
            return view('/CPP/Relator.index')->with(['usename'=>$usename, 'Usorteados'=>$selectedPedidos]);
        }
    }//show()
    

}//final class
