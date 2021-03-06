@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')

    <div class="card"> 
        <!-- header -->
        <div class="card-header" style=" "> 
            <div class="row">
                <div class="col-sm">
                    <h5> <i class="fas fa-chart-pie"></i> &nbsp; Gestão e controle. <small> Distribuição de eProtocolos por relator. </small> </h5>
                </div>

                <div class="col-sm"> </div>

                <div class="col-sm" align="right">
                    <form class="form-inline" style="float:right;">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="inputPassword2" placeholder="Nome | RG">
                            <div class="input-group-append mb-2">
                                <button type="submit" class="btn btn-outline-secondary mb-2">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- header -->
        
        <!-- row -->
        <div class="row">
            @if(isset($CountIsertMembers) && count($CountIsertMembers)>0)
                <!-- col-sm-6 -->
                @foreach($CountIsertMembers as $key)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class=" ">
                                <i class="far fa-user-circle"></i> &nbsp Relator &nbsp; {{$key->name}} <small> Id:  {{$key->model_id}} </small> &nbsp;
                                <small style="font-size: 18px;"> <b>Status: </b> &nbsp; <span style="color:green;"> Ativo    </span> </small> 
                                <br>
                                <small style="font-size: 18px;"> <b>Usuário:</b> &nbsp; <span style=" "> {{$key->username}}  </span> </small> 
                                &nbsp;&nbsp;
                                <small style="font-size: 18px;"> <b>eMail:  </b> &nbsp; <span style=" "> {{$key->email}}     </span> </small> 
                                &nbsp;&nbsp;
                            </h4>

                            <a href="{{ route('cpp.gestaocontrole.show', ['kot'=>$key->remember_token, 'id'=>$key->model_id, 'relator'=>$key->name]) }}" class="btn btn-info"> 
                                <i class="fas fa-list-ul"></i> &nbsp Ver pedidos para este relator. 
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- col-sm-6 -->
                @else
                    <h5> Não econtrado relatores. </h5>
            @endif
        </div>
        <!-- row -->

        <div class="card-footer"> </div>
    </div>
    <!-- body -->
 
@endsection