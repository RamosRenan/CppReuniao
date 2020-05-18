@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
@yield('content')

@section('content')
    <section style="width: 100%; height:auto;"> 
        <div class="card text-center">
            <div class="card-footer text-mutedr" >
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar meu parecer  |  Faça uma busca com o número de protocolo" aria-label="Buscar parecer" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button"> <i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>

            <div class="card-body" style="max-height: 570px; overflow-y: scroll;" align="center">
                <span class="card-title" style="color: magenta; font-size:16px;">Registros de parecer. É possível alterar somente pedidos que nãoforam votados pela comissão.</span>
                <p class="card-text" style="color: gray;">Listagem de todos os pareceres registrados que não foram votados.</p>
                @if(isset($relatados) || !empty($relatados))
                    @foreach($relatados as $key => $value)
                    <a href="\cpp\editarParecer?eProtocolo={{$value->eProtocolo}}">
                        <div class="alert alert-info" role="alert" style="cursor: pointer; width:80%; height: 40px;">
                            <span> <strong> Protocolo: </strong> {{$value->eProtocolo}} </span> &nbsp;  &nbsp;
                            <span> <strong> Opnou: </strong> {{$value->relator_opnou_por}} </span> &nbsp;  &nbsp;
                            <span> <strong> Alterado em: </strong> {{$value->updated_at}} </span> &nbsp;  &nbsp;
                        </div> 
                    </a>
                    @endforeach
                    
                    @else
                        <hr> 
                        <h5 class="card-title">Nenhum registro encontrado.</h5>
                @endif
            </div>
            
            <div class="card-footer text-muted">
                <small> Edição de parecer. </small>
            </div>
        </div>
    </section>
@endsection


