<?php

namespace App\Http\Controllers\Cpp_Controllers;


# use App\Http\Controllers\Cpp_Controllers\AtaController;
use Illuminate\Http\                 Request;
use App\Models\Deliberacao\          deliberacao;
use App\Http\Controllers\            Controller;
use App\Notifications\               InvoicePaid;
use Illuminate\Support\Facades\      Auth;
use App\                             User;
use App\Models\Notification\         notification;
use App\Models\Ative_Inative_Relator\users_ative_and_inative_cpp;
use App\Models\Relation_Vote_Deliber\relation_vote_each_deliberacao;
use App\Models\secretario_e_presidente\secretario_e_presidente;
use App\Models\_A44A\_A44A;
use  App\Models\Ata\ata;
use App\Http\Controllers\Cpp_Controllers\AtaController;





class DeliberController extends Controller
{
    //




    public function index(){

        $callAta = new AtaController;
        return $callAta->index();
 
    }# index()





    public function create(Request $request){

        $eProtocolo = $request->input('eProtocolo');        
        $data = $request->input('contain_deli');

        $respis = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')->paginate(1);

        # Abre uma nova notificacao
        # Se  $respis maior que 0 significa que a deliberacao em questao esta aberta
        # Se esta aberta e usuario clicou em 'Submeter aos relatores' na view cpp.deliebracao.index significa q ele editou
        # Se usuario editou então envio novamente delibercao editada para os membros votarem,
        # Tal edicao ocorre no 'else' pois $respis > 0;
        if(count($respis ) == 0 ){
            $resp    = User::find(Auth::user()->id);
            $resp->notify(new InvoicePaid($data));

            $respis = notification::where('read_at', null)
            ->orderBy('id_notification', 'Desc')->paginate(1);

            deliberacao::where('eProtocolo', '=', $eProtocolo )->update(['deliberacao'=>$data, 'id_notification'=>$respis[0]->id_notification]);
            $resp_request_return = deliberacao::where( 'eProtocolo', '=', $eProtocolo )->get();

            $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretario')
            ->where('status', true)->get();

            $AllUsers = users_ative_and_inative_cpp::all();

            foreach ($AllUsers as $key){
                # code...
                $ArrayUsersMember[] = User::find($key->id);
            }
            
            return view('\CPP\Deliberacoes\Create')
            ->with(['redirect_this_page'=>$resp_request_return, 
                    'users_members'=>$ArrayUsersMember, 
                    'id_notification'=>$respis[0]->id_notification, 
                    'presidenteSecretario'=> $presidenteSecretario,
                    ]);

        }else{
            notification::where('read_at', null)->update(['data'=>$data]);

            $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretario')
            ->where('status', true)->get();

            deliberacao::where('eProtocolo', '=', $eProtocolo )->update(['deliberacao'=>$data, 'id_notification'=>$respis[0]->id_notification]);
            $resp_request_return = deliberacao::where('eProtocolo', '=', $eProtocolo )->get();

            $AllUsers = users_ative_and_inative_cpp::all();

            foreach($AllUsers as $key){
                # code...
                $ArrayUsersMember[] = User::find($key->id);
            }
                
            return view('\CPP\Deliberacoes\Create')
            ->with(['redirect_this_page'=>$resp_request_return, 
                    'users_members'=>$ArrayUsersMember, 
                    'id_notification'=>$respis[0]->id_notification,
                    'presidenteSecretario'=>$presidenteSecretario,]);
        }#else      

        # echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$request_uri.">";
        # echo "<a href=".$request_uri.">"."click here"."</a>";
        # header("Refresh: 5;".$request_uri);
        # header('Location:'.$request_uri);
    }#create()


   






    public function edit(Request $request){
         # Fecha deliebracao em questao com comlum 'read_at' da tabela notification recebendo data e hora do fechamento; 
        $id_notification = $request->input('id_notification');
        $id_44a = $request->input('id_44a');
        _A44A::where('eProtocolo', $id_44a)->update(['was_voted'=>true]);
        notification::where('id_notification', $id_notification)->update(['read_at'=>date('Y-m-m H:i:s')]);
        return DeliberController::index();
 
    }#request()









    public function show($request){
        # retorno para mesma requisicao, redireciono requisicao para mesma pagina de solicitacao,
        # com a relacao de votos dos membros de para deliebracao em questao
        $all_memebers_voted_deliber =  relation_vote_each_deliberacao::where('eProtocolo',  $request)
        ->where('was_voted', 'true')
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'relation_vote_each_deliberacao.id_membro')
        ->join('users', 'users.id', '=', 'relation_vote_each_deliberacao.id_membro')
        ->get();

        $presidente  =  secretario_e_presidente::where('qualificacao', 'Presidente')
        ->where('status', true)->get();

        // return $all_memebers_voted_deliber;
        return redirect($_SERVER['HTTP_REFERER'])->with(['all_memebers_voted_deliber'=>$all_memebers_voted_deliber, 'presidente'=>$presidente  ]);
        
    } #show()






    public function newDeliber44A($eProtocolo){
        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretario')
        ->where('status', true)->get();

        $this44A = _A44A::where('eProtocolo', $eProtocolo)
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        ->get();

        return view('CPP.Deliberacoes44A.index')->with(['this44A'=>$this44A, 'presidenteSecretario'=>$presidenteSecretario, 'currentAta'=>$currentAta[0]->numero_ata]);
    }# newDeliber44A






    public function votoRelatoresDeliber44A($eProtocolo44_A){

        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretario')
        ->where('status', true)->get();

        $this44A = _A44A::where('eProtocolo', $eProtocolo44_A)
        ->join('notifications', 'notifications.id_notification', '=', 'A_44_A.id_notification' )
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        ->get();
        $deliber = $this44A[0]->contain_delibercao;
        // $rp = $this44A[0]["data"];
        // return $rp;
        // $rp = json_decode($this44A[0]["data"]);
        //  return $rp->{'dados'};
         
 
        return view('CPP.Deliberacoes44A.show')->with(['this44A'=>$this44A, 
        'this44AeProtocolo'=>$this44A[0]->eProtocolo,
        'dataThis44A'=>$deliber,
        'presidenteSecretario'=>$presidenteSecretario,
        'currentAta'=>$currentAta[0]->numero_ata]);

    }# votoRelatoresDeliber44A










}#class DeliberController


        // $AllUsersAtive = users_ative_and_inative_cpp::where('user_id_your_status', true)->get();
        // for ($i=0; $i < count( $AllUsersAtive); $i++) { 
        //     # code...
        //     $RelationUsersVoted[] = relation_vote_each_deliberacao::where('id_membro', '=', $AllUsersAtive[$i]->user_id)
        //     ->where('was-voted', '=', "true")
        //     ->where('eProtocolo', '=', $_GET[0])->get();
        // }