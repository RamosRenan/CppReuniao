<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;


class userInvoicePad extends User
{
    //
    public function __construct()
    {
        //
        $resp = Auth::user();
       return $resp;
    }



}# class PresidenteComissao