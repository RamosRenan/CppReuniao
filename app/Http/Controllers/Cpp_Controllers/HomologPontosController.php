<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\homolog_pontos_positivos\homolog_pontos_positivos;
use App\Models\Policial\Policial;
use App\Models\Ata\ata;
use Illuminate\Support\Facades\Lang;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use App\Models\M4PRO\POLICE;
use App\Models\M4PRO\POLICE_OPM;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\ Auth;


class HomologPontosController extends Controller
{
    /*@  index()  @*/
    public function index(){
        return view('/CPP/Homolog_Pontos.index');
     } /*@  index()  @*/
 
 
 
 
     /*@  store()  @*/
     public function store(Request $request){

        // valida formulario de pontos positivos
        $validator = Validator::make($request->all(), [

            // 'title' => 'required|unique:posts|max:255',
            'descricao'                     => ['required', 'string'], 
            'curso'                         => ['required',  'max:305', 'string'],
            'Nome'                          => ['required',  'max:55', 'string', 'not_regex:/[0-9]/i'], //regex 'no_regex', siginifca que não quero os caracteres informados.
            'RG'                            => ['required',  'max:55', 'string', 'not_regex:/[a-zA-Z]/i'],
            'CPF'                           => ['required',  'max:55', 'string', 'not_regex:/[a-zA-Z]/i'], 
            'Graduacao'                     => ['required',  'max:200', 'string'],
            'qtd_pontos'                    => ['required',  'max:12', 'integer', 'not_regex:/[a-zA-Z]/i'],
            'distincao'                     => ['required'],
            'faculdade'                     => ['required',  'max:200', 'string'],
            'curso'                         => ['required',  'max:200', 'string'],
            'sid'                           => ['required',  'max:12', 'string', 'not_regex:/[a-zA-Z]/i'],
            'inciso'                        => ['required'],
            'data_registro_eProtocolo'      => ['required', 'date',  'max:55', 'not_regex:/[a-zA-Z]/i'],
            'inicio_curso'                  => ['required', 'date', 'not_regex:/[a-zA-Z]/i'],
            'termino_curso'                 => ['required', 'date', 'not_regex:/[a-zA-Z]/i'],
            'unidade'                       => ['required', 'string', 'max:100'],
            'descricao'                     => ['required', 'string'],

        ]);

        // verifica se ocorreu erro ou inconsistencia na validação do form
        if ($validator->fails()) {
            return redirect($_SERVER['HTTP_REFERER'])->with('missing_fields', 'missing_fields');
        }

        // teste se keypedido foi rEcebido...
        //  return $request->input('keypedido');
         
        # Verifica se existe ata aberta
        $ifHasAtaOpen = ata::orderBy('id', 'Desc')
        ->where('ata_finalizada', null)
        ->paginate(1); 

        //se não ata aberta então retorno que não há ata aberta, não é possivel inserir pontos;
        if( count($ifHasAtaOpen) == 0 ) return redirect($_SERVER['HTTP_REFERER'])->with('isNotHasAtaOpen', 'isNotHasAtaOpen');

        //verifico se existe policial, se existe naõ crio novo, caso contrário crio novo policial
        $ifVerifyExistPolicial = Policial::where('cpf', $request->input('CPF'))->get();

        // if() Caso true não cria novo policial, apenas cria uma nova homologação com referencia ao ' $ifVerifyExistPolicial '
        if( count($ifVerifyExistPolicial) > 0 ){            

            // return $request->all();
            switch ($request->input('keypedido')) {
                case 'I':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#", "#F#A#C#U#L#D#A#D#E#", "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, $request->input('curso'),
                              $request->input('faculdade'), $request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoI.homologation.ata') # Texto a ser convertido,
                    );
                    // return $request->all();
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                     'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                    break;
                
                case 'II':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#", "#F#A#C#U#L#D#A#D#E#",  "#D#A#T#A#I#", "#D#A#T#A#F#" , "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, $request->input('curso'),
                        $request->input('faculdade'), $request->input('inicio_curso'), $request->input('termino_curso'),$request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoII.homologation.ata') # Texto a ser convertido,
                    );                     
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                     'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                    // return $conteudoOficial;
                    break;
                
                case 'III':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#", "#F#A#C#U#L#D#A#D#E#",  "#D#A#T#A#I#", "#D#A#T#A#F#" , "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, $request->input('curso'),
                        $request->input('faculdade'), $request->input('inicio_curso'), $request->input('termino_curso'),$request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoIII.homologation.ata') # Texto a ser convertido,
                    );                                         
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                     'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                     // return $conteudoOficial;
                    break;
                
                case 'IV':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#", "#F#A#C#U#L#D#A#D#E#",  "#D#A#T#A#I#", "#D#A#T#A#F#" , "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, $request->input('curso'),
                        $request->input('faculdade'), $request->input('inicio_curso'), $request->input('termino_curso'),$request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoIV.homologation.ata') # Texto a ser convertido,
                    );                                         
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                     'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                     // return $conteudoOficial;
                    break;
                
                case 'V':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#", "#F#A#C#U#L#D#A#D#E#",  "#D#A#T#A#I#", "#D#A#T#A#F#" , "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, $request->input('curso'),
                        $request->input('faculdade'), $request->input('inicio_curso'), $request->input('termino_curso'), $request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoV.homologation.ata') # Texto a ser convertido,
                    );                                         
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                     'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                     // return $conteudoOficial;
                    break;
                
                case 'VI':
                    # code...
                    $conteudoOficial = str_replace(
                        array("#P#O#N#T#O#S#", "#G#R#A#U#", "#N#O#M#E#", "#R#G#", "#B#P#M#", "#C#U#R#S#O#E#P#A#R#T#I#C#I#P#E#", "#e#P#R#O#T#O#C#O#L#O#"), # array com caracteres para serem substituidos,
                        array( $request->input('qtd_pontos'), $ifVerifyExistPolicial[0]->graduacao, $ifVerifyExistPolicial[0]->nome, $ifVerifyExistPolicial[0]->rg, $ifVerifyExistPolicial[0]->unidade, 
                        $request->input('cursosEParticipacoes'), $request->input('sid')), # array com variaveis para substitur,
                        __('globalDocsCpp.comissaoVotacao.textIncisoVI.homologation.ata') # Texto a ser convertido,
                    );
                    return view('CPP.Homolog_Pontos.show')->with(['conteudoOficial'=>$conteudoOficial, 'requestAll'=>$request->all(),
                    'cpfPolicial'=>$ifVerifyExistPolicial[0]->cpf,  'numAta'=> $ifHasAtaOpen[0]->numero_ata,'idAta'=>$ifHasAtaOpen[0]->id,'createSuccess'=>true]);
                     // return $conteudoOficial;
                    break;
                
                default:

                    # code...
                    return $_SERVER['HTTP_REFERER'];
                    // return " Error.: Deu ruim ... ={ ";
                    break;

            }# @end switch()     

 
        }
        # else - Cria um novo policial pois o policial informado não existe 
        else{

            $novoPolicial = new Policial;
            $novoPolicial->cpf          = $request->input('CPF');
            $novoPolicial->rg           = $request->input('RG');
            $novoPolicial->nome         = $request->input('Nome');
            $novoPolicial->unidade      = $request->input('unidade');
            $novoPolicial->graduacao    = $request->input('Graduacao').' '.$request->input('quadro');
            $novoPolicial->save();

            $id = Auth::user();

            Log::channel('single')->notice('Acessou Url: '.url()->current().' - '.$id->name.' Realizou um novo cadastro de policial - '.'id: '.$id->id.' - Token: '.$id->token_access.' - Permission Accesss: '.$id->roles[0]->name.' - Policial Cadastrado: '.$request->input ('Nome').' - RG: '.$request->input ('rg')."\n");
            
            $call = new HomologPontosController;

            return $call->store($request);

         }# else

     } /*@  store()  @*/
 
 
 
 
     /*@  show()  @*/
     public function show(){
        $currentAta = ata::max('numero_ata');
        $homologP = homolog_pontos_positivos::where('pertence_ata', $currentAta)->get();
        // return $homologP ;
        return view('CPP.Homolog_Pontos.edit')->with(['homologP'=>$homologP]);
     } /*@  show()  @*/
 
 
 
    /*@  create()  @*/
    public function create(Request $request){
        $search_cpf_police = $request->input('search_cpf_police');
        $arr = array(".", "-");
        $subs = str_replace($arr, "", $search_cpf_police);
        // return var_dump($subs);
        try {
             //code...
            if(!empty($subs)){

                
                $result_search_police = POLICE::where('RG', 'like', '%'.$subs.'%')->orWhere('CPF', 'like', '%'.$subs.'%')->orWhere('NOME', 'like', '%'.$subs.'%')->get();
                // return $result_search_police;
                $result_search_police_opm = POLICE_OPM::where('META4', '=', $result_search_police[0]->OPM_META4)->get();
                
                $result_search = array_merge(json_decode($result_search_police), json_decode($result_search_police_opm));
                
                return view('CPP.Homolog_Pontos.index')->with(['result_search' => $result_search ]);
            }
            
        } catch (\Exception $th) {
            /* Print error message. */
            return self::thr();
            //  echo __44AController::index();
        }
    } 
    /*@  create()  @*/
 
    private function thr(){
        try {
            //code...
            throw new \Exception("Não foi possível realizar a busca. &nbsp; <a href='/cpp/HomologP'> <u>Voltar aqui</u> </a> ");
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
 
     /*@  editPontos()  @*/
     public function editPontos(Request $request){
        $eProtocolo = $request->input('eProtocolo');
        $getHomolog = homolog_pontos_positivos::where('eProtocolo', $eProtocolo)->get();
        return view('CPP.Homolog_Pontos.editPontos')->with(['getHomolog' => $getHomolog ]);
    } /*@  editPontos()  @*/
 
 
    /*@  efetiveAlterPontos()  @*/
    public function efetiveAlterPontos(Request $request){
        // return "okok";
        $eProtocolo = $request->input('eProtocolo');
        try {
            //code...
            homolog_pontos_positivos::where('eProtocolo', $eProtocolo)->update(['descricao_da_homologacao'=>$request->input('newTexto')]);
            return view('CPP.Homolog_Pontos.editPontos')->with(['success'=>true ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    } /*@  efetiveAlterPontos()  @*/


 
     /*@  edit()  @*/
     public function edit(Request $request){

        $homolog_pontos_positivos = new homolog_pontos_positivos;
        $homolog_pontos_positivos->qtd_pontos                   = $request->input('qtd_pontos');
        $homolog_pontos_positivos->pertence_ata                 = $request->input('qtd_pontos');
        $homolog_pontos_positivos->universidade                 = $request->input('faculdade');
        $homolog_pontos_positivos->curso                        = $request->input('curso');
        $homolog_pontos_positivos->eProtocolo                   = $request->input('sid');
        $homolog_pontos_positivos->distincao                    = $request->input('distincao');
        $homolog_pontos_positivos->key_inciso                   = $request->input('keypedido');
        $homolog_pontos_positivos->data_do_registro_eProtocolo  = $request->input('data_registro_eProtocolo');
        $homolog_pontos_positivos->inicio_do_curso              = $request->input('inicio_curso');
        $homolog_pontos_positivos->termino_do_curso             = $request->input('termino_curso');
        $homolog_pontos_positivos->cursos_e_participacoes       = $request->input('cursosEParticipacoes');
        $homolog_pontos_positivos->pertence_ata                 = $request->input('pertence_ata');
        $homolog_pontos_positivos->identifier_in_ata            = $request->input('identifier_in_ata');
        $homolog_pontos_positivos->contain_oficial_homolocao    = $request->input('conteudoOficial');
        $homolog_pontos_positivos->descricao_da_homologacao     = $request->input('descricao');
        $homolog_pontos_positivos->id_policial                  = $request->input('CPF');
        $homolog_pontos_positivos->save();

        return HomologPontosController::index();
 
     } /*@  edit()  @*/
 
 
 
     /*@  destroy()  @*/
     public function destroy(){
         
     } /*@  destroy()  @*/

     public function storedHmologPointing(){
        
        $selectedHom = homolog_pontos_positivos::where('homlog_pontos_positivos.eProtocolo', $_GET['eProtocolo'])
        ->join('policial', 'policial.cpf', '=', 'homlog_pontos_positivos.id_policial')
        ->get();
        
        // return $selectedHom;
        
        return view('CPP.Homolog_Pontos.create')->with('selectedHom', $selectedHom);
    }
}
