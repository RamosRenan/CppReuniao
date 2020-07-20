@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section style="text-align: right;">
        <div class="card card-default" align="center">
            <span> <i class="fas fa-file-word"></i> Atas encontradas. </span>
            <small style="margin-left: 25px; color:blue;"> Para encontrar uma ata, informe o número da ata seguido de um espaço e depois o ano da ata. Ex.: 5 2020 (NESTE formato).  </small>
        </div>

        <form style="float:left;">
            <input class="form-group" type="text" name="findAta" required>
            <button class="btn btn-outline-primary" type="submit"> Encontrar. </button>
        </form>
        @if(isset($allAtas) && count($allAtas) > 0)
            <span style="color: blue;"> <b> <u> Total: {{count($allAtas)}} </br> </u> </span>
        @endif
    </section>

    <br>

    <table class="table" align="center" >
        <thead align="center">
            <tr>
                <th>#</th>
                <th scope="col">ID</th>
                <th scope="col">Nome do Arquivo.</th>
                <th scope="col">Data do envio.</th>
                <th scope="col">Tamanho.</th>
                <th scope="col">Responsável pelo envio.</th>
            </tr>
        </thead>

        <tbody align="center">
            @if($allAtas != null)
            @foreach($allAtas as $key)
            <tr>
                <td> <i class="far fa-file-pdf" style="font-size: 25px; color:red;"></i> </td>
                <td>{{$key->id}}</td>
                <td> <a href="/cpp/presentingAta?nameata={{$key->name}}"> <u> {{$key->name}} </u> </a> </td>
                <td>{{$key->created_at}}</td>
                <td>{{$key->size}}</td>
                <td>{{$key->responsavel}}</td>
             <tr>
             @endforeach
             @endif
        </tbody>
    </table>

    <div class="card card-default" align="center"> 
        
    </div>

     
@endsection