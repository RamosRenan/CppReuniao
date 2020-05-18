@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')
    
    <div class="card text-center">
        <div class="card-footer text-muted">
            Últimos cadastrados.<br>
            <small> Clique sobre o pedido para editá-lo </small>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: scroll;">
            @foreach($homologP as $key => $value)
            <form action="/cpp/editPontos" method="post">
                @csrf
                <input type="hidden" name="eProtocolo" value="{{$value->eProtocolo}}">
                <button type="submit" class="alert alert-dark" role="alert">
                    <span style="color:white;"> eProtocolo: {{$value->eProtocolo}} </span> &nbsp;  &nbsp;  &nbsp;
                    <span style="color:white;"> Distinção: {{$value->distincao}} </span> &nbsp;  &nbsp;  &nbsp;
                    <span style="color:white;"> Rg: {{$value->id_policial}} </span> &nbsp;  &nbsp;  &nbsp;
                    <span style="color:white;"> Inciso: {{$value->key_inciso}} </span> &nbsp;  &nbsp;  &nbsp;
                    <span style="color:white;"> Data de Cadastro {{$value->created_at}} </span> &nbsp;  &nbsp;  &nbsp;
                </button>
            </form>
            @endforeach
        </div>
        <div class="card-footer text-muted">
            Pontos positivos.
        </div>
    </div>
  
    <script>

    </script>
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection
