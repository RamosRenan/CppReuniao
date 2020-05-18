<?php

    use App\Http\Controllers\Cpp_Controllers\RelatorController;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class Superajax 
    {
        public function ajaxreturn(){
            return "false";
        }
    }
    

    $call = new RelatorController;

    $call->ajaxRquest();

?>