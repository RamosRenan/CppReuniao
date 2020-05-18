<?php

namespace App\Http\Controllers\Cpp_Controllers;

use App\Http\Controllers\Controller;
use App\Models\M4PRO\POLICE;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;
use App\Models\userInvoicePad;
use App\Models\_A44A\_A44A;
use App\Models\Notification\         notification;



class serverController extends Controller
{
    //
    public function index(){
        phpinfo();
        $result_search = POLICE::where('RG', 138511456)
        // ->orWhere('NOME', 'like', '%'.$resp.'%')
        ->get();
        
         return  $result_search;

        // $this44A = _A44A::where('eProtocolo', '14.788.899-9')
        // ->join('notifications', 'notifications.id_notification', '=', 'A_44_A.id_notification' )
        // ->join('policial', 'policial.cpf', '=', 'A_44_A.id_policial')
        // ->get();
        // return $this44A;

        // return date('Y-m-d H:i:s');

        // $data    = "Teste de notificacao com db;;";
        // $nowUser = Auth::user();
        // $resp    = User::find($nowUser->id);
        // $resp->notify(new InvoicePaid($data));        

    }



}# class PresidenteComissao