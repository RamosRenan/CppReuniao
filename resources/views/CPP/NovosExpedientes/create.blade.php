@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('content')

@section('content')
    <!-- card -->
    <div class="card text-center">
        <div class="card-header">
            <h4 class=" "><i class="far fa-address-card"></i> &nbsp Pedido selecionado </h4>
        </div>
    
        <!-- card-body -->
        <div class="card-body" align="center">
            <!-- row -->
            <div class="row" align="center">
                <div class="col-sm-12">
                    <h5 class="card-title" style="color: #364fc7;">
                        Nome: &nbsp
                        {{$showSelected['nome']}}
                    </h5>

                    <br>

                    <!-- form -->
                    <form>
                        <!-- form-row -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">eProtocolo</label>
                                <input readonly value="{{$showSelected['eProtocolo']}}" type="text" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Pedido</label>
                                <input readonly value="{{$showSelected['pedido']}}" type="text" class="form-control" id="inputPassword4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Status</label>
                                <input readonly value="{{$showSelected['status']}}" type="text" class="form-control" id="inputPassword4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Token</label>
                                <input readonly value="{{$showSelected['_token']}}" type="text" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                         <!-- form-row -->

                        <!-- form-row -->
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Entrada</label>
                                <input readonly value="{{$showSelected['dataEntrada']}}" type=" " class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Data eProtocolo</label>
                                <input readonly value="{{$showSelected['dataeProtocolo']}}"  type=" " class="form-control" id="inputPassword4">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Nome</label>
                                <input  readonly value="{{$showSelected['nome']}}" type=" " class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <!-- form-row -->

                        <!-- form-row -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Unidade</label>
                                <input readonly value="{{$showSelected['unindade']}}" type="email" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Graduacao</label>
                                <input readonly value="{{$showSelected['graduacao']}}" type="" class="form-control" id="input4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="input4">CPF</label>
                                <input readonly value="{{$showSelected['cpf']}}" type="" class="form-control" id="input4">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="input4">RG</label>
                                <input readonly value="{{$showSelected['rg']}}" type="" class="form-control" id="input4">
                            </div>
                        </div>
                        <!-- form-row -->

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> Conteúdo </label>
                            <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3">
                                {{$showSelected['conteudo']}}
                            </textarea>
                        </div>
                    </form>
                </div>
            </div>
            <!-- row -->

            <a href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$showSelected['eProtocolo']]) }}"> 
                <span style="float: left;"> &nbsp <i class="fas fa-paperclip"></i> &nbsp; Visualizar anexo &nbsp </span>
            </a>
            <hr>

        </div>
        <!-- card-body -->

        <div class="card-footer text-muted">
            
        </div>
    </div>
    <!-- card -->

    <br>

    <script>    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
       
@endsection
