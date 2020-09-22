@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
 
    <div class="card">
        <!-- card footer -->
        <div class="card-header" align="center">
            <div class="container">
                <div class="row">
                    <div class="col-sm" align="left">
                        <form class="form-inline">
                            <div style=" ">
                                <input style="height: 30px;" type="text" class="form-control" id="inputPassword2" placeholder="Ex.: 1.111.111-1">
                                <button style=" position: relative; top: 4px;" type="submit" class="btn btn-primary mb-2"> 
                                    <i style="font-size: 15px;" class="fas fa-search"></i>  
                                </button>
                                <br>
                                <span> <small> <i class="fas fa-info-circle"></i> &nbsp Procure por um protocolo. </small> </span>
                            </div>
                        </form>                     
                    </div>
                    <div class="col-sm">
                        <h5 style="color: #2A4B7C"> 
                            <i class="far fa-clock"></i> <br> Histórico de deliberações <br>
                        </h5>
                    </div>
                    <div class="col-sm" align="right">
                        <h5> Total: {{count($registersDeliber)}} </h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- card footer -->
        

        <div class="card-body" style="max-height: 450px; overflow-y: scroll;">
            @if(isset($registersDeliber) && count($registersDeliber) > 0)
            @foreach($registersDeliber as $key)
            <h4 style="color: #2A4B7C;" class=" "> <i class="far fa-address-card"></i> &nbsp Deliberação</h4>
            <div style="width 100%; height: auto;" align="center">
                <table class="table table-sm">
                    <thead>
                        <tr align="center">
                            <th scope="col">Nome do interessado</th>
                            <th scope="col">eProtocolo</th>
                            <th scope="col">Data da Deliberação</th>
                            <th scope="col">Voto do relator</th>
                            <th scope="col">Nº Ata</th>
                            <th scope="col">Ver | Anexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td>{{$key->nome}}</td>
                            <td>{{$key->eProtocolo}}</td>
                            <td>{{$key->created_at}}</td>
                            <td>{{$key->relator_opnou_por}}</td>
                            <td>{{$key->numero_ata}}</td>
                            <td>
                                <a href="{{route('cpp.historyDeliberRelator.show', ['show', 'eProtocolo'=>$key->eProtocolo, 'id'=>$key->id_membro])}}" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-warning">
                                    <i class="fas fa-paperclip"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            @endforeach
            @endif

            <!-- @  
                Laço responsavel por percorrer deliberações
                que ainda não foram votadas pela comissão
                mas que foi registrado o parecer do relator.
            @ -->
             
        </div>
        <div class="card-footer" align="center"> Histórico </div>

    </div>

@endsection