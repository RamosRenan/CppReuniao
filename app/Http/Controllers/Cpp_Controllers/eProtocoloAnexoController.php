<?php

namespace App\Http\Controllers\Cpp_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cpp_Controllers\eProtocoloAnexoControllerService;


class eProtocoloAnexoController extends Controller
{
    // code ...

    public function index(Request $request){
        if(!$request->isMethod('get')) 
            return redirect()->back()->with('Method', 'Methodo não aceito');
            
        $eProtocoloAnexoService = new eProtocoloAnexoControllerService($request->query('hid'), $request->method(), $request->query('cpf'));
        
        // return $_SERVER['HTTP_REFERER'];/
        return $eProtocoloAnexoService->show() == false ? self::show() : $eProtocoloAnexoService->show();
    }

    public function show(){
        return view('/CPP/ChartRelatorioRelator/default');
    }
}
