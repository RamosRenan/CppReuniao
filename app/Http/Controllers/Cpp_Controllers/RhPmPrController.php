<?php

namespace App\Http\Controllers\CPP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\M4PRO\V_M4CBR_VW_EXT_PM_CADAST_PESS;
use Illuminate\Support\Facades\DB;

class RhPmPrController extends Controller
{
    //
    public function index(){        

        $resp  = V_M4CBR_VW_EXT_PM_CADAST_PESS::where('CPF', '=', '40848163885')->get();
        
        return $resp;

       
    }
}//RhPmPrController
