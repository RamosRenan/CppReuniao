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
use App\Models\eProtocoloSorteados\eProtocolosSorteados;


class DeliberController extends Controller
{
    //

    public $empate = null;

    public function index(){

        $callAta = new AtaController;
        return $callAta->index();
 
    }# index()


    # Cria deliebração ordinária primeira vez
    public function create(Request $request){

        $eProtocolo = $request->input('eProtocolo');        
        $data = $request->input('contain_deli');

        $respis = notification::where('read_at', null)
        ->orderBy('id_notification', 'Desc')->paginate(1);

        # Abre uma nova notificacao
        # Se  $respis maior que 0 significa que a deliberacao em questao esta aberta
        # Se esta aberta e usuario clicou em 'Submeter aos relatores' na view cpp.deliebracao.index significa q ele editou ou nao
        # Se usuario editou então envio novamente delibercao editada para os membros votarem,
        # Tal edicao ocorre no 'else' pois $respis > 0;
        if(count($respis ) == 0 ){
            $resp    = User::find(Auth::user()->id);

            $resp->notify(new InvoicePaid($data));

            $respis = notification::where('read_at', null)
            ->orderBy('id_notification', 'Desc')->paginate(1);

            deliberacao::where('eProtocolo', '=', $eProtocolo )->update(['deliberacao'=>$data, 'id_notification'=>$respis[0]->id_notification]);
            $resp_request_return = deliberacao::where( 'eProtocolo', '=', $eProtocolo )->get();

            $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretaria(o)')
            ->where('status', true)->get();

            $AllUsers = users_ative_and_inative_cpp::all();

            foreach ($AllUsers as $key){
                # code...
                $ArrayUsersMember[] = User::find($key->id);
            }
            
            return view('CPP.Deliberacoes.create')
            ->with(['redirect_this_page'=>$resp_request_return, 
                    'users_members'=>$ArrayUsersMember, 
                    'id_notification'=>$respis[0]->id_notification, 
                    'presidenteSecretario'=> $presidenteSecretario,
                    ]);

        }else{
            notification::where('read_at', null)->update(['data'=>$data]);

            $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretaria(o)')
            ->where('status', true)->get();

            deliberacao::where('eProtocolo', '=', $eProtocolo )->update(['deliberacao'=>$data, 'id_notification'=>$respis[0]->id_notification]);
            $resp_request_return = deliberacao::where('eProtocolo', '=', $eProtocolo )->get();

            $AllUsers = users_ative_and_inative_cpp::all();

            foreach($AllUsers as $key){
                # code...
                $ArrayUsersMember[] = User::find($key->id);
            }
                
            return view('CPP.Deliberacoes.create')
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


    /* Finaliza deliberação 44A */
    public function edit(Request $request){

        # Fecha deliebracao em questao com comlum 'read_at' da tabela notification recebendo data e hora do fechamento; 
        $id_notification = $request->input('id_notification');
        $id_44a = $request->input('id_44a');

        _A44A::where('eProtocolo', $id_44a)->update(['was_voted'=>true, 'condicao'=>'Apreciado']);

        notification::where('id_notification', $id_notification)->update(['read_at'=>date('Y-m-m H:i:s')]);

        return DeliberController::index();
 
    }#request()



    //função que busca a relação dos votos de cada relator
    public function show($request){
        //pego o atual presidente
        $president  =  secretario_e_presidente::where('qualificacao', 'Presidente')
        ->where('status', true)->get();

        $relatorThis = eProtocolosSorteados::where('eProtocolo_sorteados.eProtocolo', $request)
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'eProtocolo_sorteados.id_membro')
        ->get();

        //teste
        // return $relatorThis;

        // retorno para mesma requisicao, redireciono requisicao para mesma pagina de solicitacao,
        // com a relacao de votos dos membros de para deliebracao em questao
        $all_memebers_voted_deliber =  relation_vote_each_deliberacao::where('eProtocolo',  $request)
        ->where('was_voted', 'true')
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'relation_vote_each_deliberacao.id_membro')
        ->join('users', 'users.id', '=', 'relation_vote_each_deliberacao.id_membro')
        ->get();

        //pego todos que votaram contra exceto president
        $tot_vote_contra = relation_vote_each_deliberacao::where('eProtocolo',  $request)
        ->where('id_membro', '!=', $president[0]->id)
        ->where('votou_contra', 'true')->count();

        //pego todos que votaram favoravel exceto president
        $tot_vote_favoravel = relation_vote_each_deliberacao::where('eProtocolo',  $request)
        ->where('id_membro', '!=', $president[0]->id)        
        ->where('votou_favoravel', 'true')->count();

        //pego voto do president se votou
        $vote_president = relation_vote_each_deliberacao::where('relation_vote_each_deliberacao.eProtocolo',  $request)
        ->where('relation_vote_each_deliberacao.id_membro', $president[0]->id)
        ->join('secretario_e_presidente', 'secretario_e_presidente.id', '=', 'relation_vote_each_deliberacao.id_membro')
        ->get();

        // return $vote_president[0];

        if($tot_vote_contra ==  $tot_vote_favoravel )
            $this->empate = true;

        // return $empate;

        // return $all_memebers_voted_deliber;
        return redirect($_SERVER['HTTP_REFERER'])->with([
            'all_memebers_voted_deliber'    =>$all_memebers_voted_deliber, 
            'presidente'                    =>$president,
            'empate'                        =>$this->empate,
            'vote_president'                =>$vote_president,
            'relatorThis'                   =>$relatorThis
            
        ]);
        
    } #show()






    public function newDeliber44A($eProtocolo){
        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteSecretario =  secretario_e_presidente::where('qualificacao', 'Secretaria(o)')
        ->where('status', true)->get();

        $this44A = _A44A::where('eProtocolo', $eProtocolo)
        ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        ->get();

        return view('CPP.Deliberacoes44A.index')->with(['this44A'=>$this44A, 'presidenteSecretario'=>$presidenteSecretario, 'currentAta'=>$currentAta[0]->numero_ata]);
    }# newDeliber44A





    public function votoRelatoresDeliber44A($eProtocolo44_A){

        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteSecretario = secretario_e_presidente::where('qualificacao', 'Secretaria(o)')
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


    public function updateVotoRelatoresDeliber44A(){

        $eProtocolo44_A = $_GET['this44AeProtocolo'];

        $currentAta = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)->paginate(1);

        $presidenteSecretario = secretario_e_presidente::where('qualificacao', 'Secretaria(o)')
        ->orWhere('qualificacao', 'Presidente')
        ->where('status', true)->get();
 
        $this44A = _A44A::where('eProtocolo', $eProtocolo44_A)
        ->join('notifications', 'notifications.id_notification', '=', 'A_44_A.id_notification' )
        ->join('relation_vote_each_44A', 'relation_vote_each_44A.id', '=', 'A_44_A.id')
        ->join('Members_Relatores_and_President', 'Members_Relatores_and_President.id', '=', 'relation_vote_each_44A.id_membro')
        ->get();

        if(count($this44A) > 0){
            return view('CPP.Deliberacoes44A.show')->with(['this44A'=>$this44A, 
            'this44AeProtocolo'     =>  $this44A[0]->eProtocolo,
            'dataThis44A'           =>  $this44A[0]->contain_delibercao,
            'presidenteSecretario'  =>  $presidenteSecretario,
            'currentAta'            =>  $currentAta[0]->numero_ata,
            'relationVote44A'       =>  $this44A        
            ]);
        }else{
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // $rp = $this44A[0]["data"];
        // return $rp;
        // $rp = json_decode($this44A[0]["data"]);
        //  return $rp->{'dados'};

    }# votoRelatoresDeliber44A

} 