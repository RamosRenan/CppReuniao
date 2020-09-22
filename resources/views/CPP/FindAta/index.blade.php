@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
    <hr>
    <div class="row" align="center">
        <h5 style="padding-bottom: 12px; margin: auto;color: #2A4B7C;"> <i class="fas fa-briefcase"></i> <br>Atas arquivadas. </h5>
    </div>

    <table class="table" align="center" >
        <thead align="center" style=" ">
            <tr style="color: #2A4B7C; font-wweight: light">
                <th>PDF</th>
                <th scope="col">Nome do Arquivo.</th>
                <th scope="col">Data do envio.</th>
                <th scope="col">Tamanho. <small> (bytes) </small></th>
                <th scope="col">Responsável pelo envio.</th>
            </tr>
        </thead>

        <tbody align="center">
            @if($allAtas != null)
            @foreach($allAtas as $key)
            <tr>
                <td> <i class="far fa-file-pdf" style="font-size: 25px; color:red;"></i> </td>
                <td> <a href="/cpp/presentingAta?nameata={{$key->name}}"> <u> {{$key->name}} </u> </a> </td>
                <td>{{$key->created_at}}</td>
                <td>{{$key->size}} &nbsp bytes</td>
                <td>{{$key->responsavel}}</td>
             <tr>
             @endforeach
             @endif
        </tbody>
    </table>

    <div class="card card-default" align="center"> </div>

    <br>
     
@endsection