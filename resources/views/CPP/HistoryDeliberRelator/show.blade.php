@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 

    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  border: none;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  border: none;

}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
@yield('content')

@section('content')
  
    <div class="card">
        <h5 class="card-header">
            <i style="color: black; font-size: 30px;" class="far fa-user-circle"></i> &nbsp
            <b> Nome </b> &nbsp {{$registersDeliber[0]->nome}}
        </h5>
        <div class="card-body">

        <h4 style="color: #2A4B7C;" class="card-title"> <b> Pedido: </b> {{$registersDeliber[0]->pedido}}</h4>

        <hr>

        <table>
            
            <tr>
                <td><b> eProtocolo: </b> </td>
                <td>{{$registersDeliber[0]->eProtocolo}}</td>
            </tr>
            <tr>
                <td><b> Parecer do relator: </b></td>
                <td style="text-align:justify;">{{$registersDeliber[0]->parecer_relator}}</td>
            </tr>
            <tr>
                <td><b> Unidade: </b></td>
                <td>{{$registersDeliber[0]->unidade}}</td>
            </tr>
            <tr>
                <td><b> Graduação: </b></td>
                <td>{{$registersDeliber[0]->graduacao}}</td>
            </tr>
            <tr>
                <td><b> RG: </b></td>
                <td>{{$registersDeliber[0]->rg}}</td>
            </tr>
            <tr>
                <td><b> CPF: </b></td>
                <td>{{$registersDeliber[0]->cpf}}</td>
            </tr>
            <tr>
                <td><b> Data do registro: </b> </td>
                <td>{{$registersDeliber[0]->updated_at}}</td>
            </tr>
            <tr>
                <td><b> Quorum da comisão: </b></td>
                <td>{{$registersDeliber[0]->quorum}}</td>
            </tr>
            <tr>
                <td><b> Comissão deliberaou por: </b></td>
                <td>{{$registersDeliber[0]->deliberou_por}}</td>
            </tr>
            <tr>
                <td><b> Condição desta deliberação: </b></td>
                <td>{{$registersDeliber[0]->condicao_this_deliberacao}}</td>
            </tr>
            <tr>
                <td><b> Voto da comissão: </b></td>
                <td>{{$registersDeliber[0]->votacao_comissao}}</td>
            </tr>
            <tr>
                <td><b> Contúdo </b></td>
                <td style="text-align:justify;">{{$registersDeliber[0]->conteudo}}</td>
            </tr>
        </table>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
    </div>

    <br>

@endsection