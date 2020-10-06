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
    <!-- card -->
    <div class="card">
        <div class="card-header" align="center"> 
             <h5> <i class="far fa-list-alt" style="font-size: 26px; color: #00BFFF;"></i> &nbsp Selecione o pedido(ePrtocolo) para acessá-lo  </h5>
        </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead align="left">
                        <tr>
                            <th scope="col">eProtocolo</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Pedido</th>
                            <th scope="col">Data do cadastro</th>
                        </tr>
                    </thead>
                    <tbody align="left">
                        @if(isset($Usorteados) && count($Usorteados)>0)
                            @foreach($Usorteados as $key)
                            <tr>
                                <td><a href="\cpp\showPedidoSelectedToRelator?eProtoclo={{$key->eProtocolo}}"><u>{{$key->eProtocolo}}</u></a></td>
                                <td>{{$key->nome}}</td>
                                <td>{{$key->pedido}}</td>
                                <td>{{$key->created_at}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer" align="center"> 
                <span> Listagem de pedidos <p style="color: #00BFFF;"> Total {{count($Usorteados)}}</p> </span>
            </div>
        </div>
    </div>
    <!-- card -->

@endsection


