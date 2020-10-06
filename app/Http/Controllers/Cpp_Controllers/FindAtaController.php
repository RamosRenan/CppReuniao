<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\ata;
use App\Models\homolog_pontos_positivos\homolog_pontos_positivos;
use App\Models\_A44A\_A44A;
use App\Models\FileAta\fileAta;
use Illuminate\Support\Facades\DB;


class FindAtaController extends Controller
{
    //
    public function index(){

        $allAtas =  DB::select('SELECT * FROM public."fileAta" ');

        // return $allAtas;
        return view('CPP.FindAta.index')->with(['allAtas'=>$allAtas]);

    }#index()



    public function create(){
         
        $AtaContent = ata::where('ata.numero_ata', $_GET['numero_ata'])
        ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        ->orderBy('deliberacao.num_deliberacao', 'Asc')
        ->get();

        $Ata44A = _A44A::where('pertence_ata_num_ata', $AtaContent[0]->numero_ata)->get();

        $HomlogAtaContent = homolog_pontos_positivos::where('pertence_ata', $AtaContent[0]->numero_ata)->get();

        return view('CPP\Ata\show')->with(['AtaContent'=>$AtaContent, 'HomlogAtaContent'=>$HomlogAtaContent, 'Ata44A'=>$Ata44A]);

        // $HomlogAtaContent = homolog_pontos_positivos::where('pertence_ata',  $numeroAta['numero_ata'])->get();
        // $AtaContent = ata::where('ata.numero_ata', $numeroAta['numero_ata'])
        // ->join('deliberacao', 'ata.numero_ata', '=', 'deliberacao.numero_ata')
        // ->orderBy('deliberacao.num_deliberacao', 'Asc')
        // ->get();

        // // return $AtaContent;

        // return view('CPP.Ata.index')->with(['AtaContent'=>$AtaContent, 'HomlogAtaContent'=>$HomlogAtaContent]); 
         
     }#create()



    public function show(Request $request){
 
        $num_ata    = $request->input('num_ata');
        $date_i     = $request->input('datai');
        $date_f     = $request->input('dataf');

        if( !empty($date_i) && !empty($date_f) ){
            $allAtas = ata::whereBetween('ata.created_at', [$date_i, $date_f])
            ->join('users', 'users.id', '=', 'ata.response_finalized_ata')
            ->get();
            if(count( $allAtas) == 0) return redirect($_SERVER['HTTP_REFERER'])->with('notFoundDeliber', 'false');
            // return  $allAtas;
            return view('CPP.FindAta.show')->with(['allAtas'=>$allAtas]);
        }elseif(!empty($num_ata)){
            $finAta = ata::where('numero_ata', $num_ata )
            ->join('users', 'users.id', '=', 'ata.response_finalized_ata')
            ->get();
            if(count( $finAta) == 0) return redirect($_SERVER['HTTP_REFERER'])->with('notFoundDeliber', 'false');
            return view('CPP.FindAta.show')->with(['allAtas'=>$finAta]);
            // return $finAta;
        }else{
            return redirect($_SERVER['HTTP_REFERER'])->with('allInputsEmpty', 'false');
        }
    }#show()


    public function edit(Request $request, $id){
        $ata = DB::select('SELECT * FROM public."fileAta" WHERE id = '.$id.'');
        $call = new FindAtaController;
        return $call->pesentingAta($ata);
    }//show()


    public function presentingAta(){
        $file = '../public/ata/reunioes/cpp/pdf/'.$_GET['nameata'].'';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' .$_GET['nameata']. '"');
        header('Content-Transfer-Encoding; binary');
        readfile($file);
    }

    public function store(){
        return "okokokokoatata";
    }
}#FindAta
