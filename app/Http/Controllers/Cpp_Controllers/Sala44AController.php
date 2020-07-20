<?php

namespace App\Http\Controllers\Cpp_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use  App\Models\Ata\ata;
use App\Models\_A44A\_A44A;
use App\Http\Controllers\Cpp_Controllers\DeliberController;
use App\Models\Notification\         notification;
use App\                             User;
use Illuminate\Support\Facades\      Auth;
use App\Notifications\               InvoicePaid;
use App\Models\Members_Relatores_President\Members_Relatores_and_President;

class Sala44AController extends Controller
{
    //
    public function index(){

        $searchall = users_ative_and_inative_cpp::join('users', 'users.id', '=', 'users_ative_and_inative_cpp.has_user_id')
        ->where('user_id_your_status', '=', 1)->get();
        // return $searchall;

        $naoAlanisadosPorComissao = _A44A::where('A_44_A.votacao_comissao', null)
        ->where('A_44_A.relator_opnou_por', '!=', null)
        ->join('users', 'users.id', '=', 'A_44_A.id_response_relator')
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        ->get();
        // return $naoAlanisadosPorComissao;

        return view('/CPP/Sala44A.index')->with(['naoAlanisadosPorComissao'=>$naoAlanisadosPorComissao, 'searchall'=>$searchall]);

    }# index()


    
    public function create(Request $request){ 

        $verifyIfExistRelatoresRegistrered = Members_Relatores_and_President::select('*')->get();

        if(count($verifyIfExistRelatoresRegistrered)<2) 
            return redirect($_SERVER['HTTP_REFERER'])->with('emptyRelatores', true);
        
        $respis = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')->paginate(1);

        $ComissaoOpnou          = $request->input('ComissaoOpnou'       );
        $decisao_da_comissao    = $request->input('decisao_da_comissao' );
        $ComissaoCorum          = $request->input('ComissaoCorum'       );
        $Condicao               = $request->input('Condicao'            );
        $eProtocolo             = $request->input('eProtocolo'          );

        if(count($respis) == 0){
    
            _A44A::where('eProtocolo', $eProtocolo)->update(['quorum'=>$ComissaoCorum, 'votacao_comissao'=>$ComissaoOpnou, 
            'deliberou_por'=>$decisao_da_comissao, 'condicao'=>$Condicao ]);
    
            $callDeliber  = new DeliberController;

            return $callDeliber->newDeliber44A($eProtocolo);

        }else{

            // $callDeliber  = new DeliberController;            
            return "Não atualize a pagina";//$callDeliber->newDeliber44A($eProtocolo);
            echo "Não atualize a pagina";

        }

    }# create()





    public function store(Request $request){

        $eProtocolo44_A = $request->input('eProtocolo44_A');
        $data = $request->input('contain_deli');

        $respis = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')->paginate(1);

        if(count( $respis) == 0){

            $resp   = User::find(Auth::user()->id);
            $resp->notify(new InvoicePaid($data));
            $actualNotification = notification::where('read_at', null)
            ->orderBy('id_notification', 'Desc')->paginate(1);
            _A44A::where('eProtocolo', $eProtocolo44_A)->update([ 'id_notification'=>$actualNotification[0]->id_notification, 'contain_delibercao'=>$data ]);

            return redirect($_SERVER['HTTP_REFERER']);
    
        }else{

            return "Error.: Create deliber 44-A com notification em aberto";

        }# else

    }# store()



    public function show(Request $request){

        $eProtocolo44_A = $request->input('eProtocolo44_A');
        $data = $request->input('contain_deli');

        // verifico se há alguma notificação com 'read_at' null. 
        // Isso significa que se houver, então pego o id desta notificação e a vinculo com o pedido 44A.
        $respis = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')->paginate(1);

        if(count( $respis) == 0){
                
            $resp    = User::find(Auth::user()->id);
            $resp->notify(new InvoicePaid($data));
            $actualNotification = notification::where('read_at', null)
            ->orderBy('id_notification', 'Desc')->paginate(1);

            _A44A::where('eProtocolo', $eProtocolo44_A)->update([ 'id_notification'=>$actualNotification[0]->id_notification, 'contain_delibercao'=>$data ]);
            $votoRelatoresDeliber44A = new DeliberController;
            
            return $votoRelatoresDeliber44A->votoRelatoresDeliber44A($eProtocolo44_A);
    
        }else{

            // Se entrar no else há notificação com 'read_at' null
            // Atualizo eProtocolo com novo conteúdo da deliberação.
            _A44A::where('eProtocolo', $eProtocolo44_A)->update(['contain_delibercao'=>$data]);
            $votoRelatoresDeliber44A = new DeliberController;

            return  $votoRelatoresDeliber44A->votoRelatoresDeliber44A($eProtocolo44_A);
            
        }# else

    }# show()



    public function edit(Request $request){

    }# edit()



    public function update(){

    }# update()


}# 
