<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\ata;
use Illuminate\Support\Facades\DB;


class RelatorioController extends Controller
{
    //
    public function index(){

        $legendrelatorio = DB::select('SELECT  ata.created_at, condicao_this_deliberacao,d.numero_ata, COUNT(condicao_this_deliberacao) tot
            from public."deliberacao" d
                INNER JOIN public."ata" ON ata.numero_ata = d.numero_ata
                    WHERE ata.ata_finalizada = \'true\'
                        GROUP BY d.condicao_this_deliberacao, d.numero_ata, ata.created_at
                            ORDER BY d.numero_ata ASC');
        // return $legendrelatorio;
        return view('\CPP\Relatorios\index')->with(['legendrelatorio'=>$legendrelatorio]);
    }#index()





    public function create(){

    }#create()





    public function show(){

    }#show()





    public function edit(){

    }#edit()



}#RelatorioController
