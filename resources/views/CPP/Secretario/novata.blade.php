@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

<div  style=" width: 100%; height:auto; margin-top: -25px;" align="center">
    <div class="card" style="height: 62.3px; background: #495057;  max-width: 65.5rem;">
        <div class="card-footer"  style="height: 62.3px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm" align="left">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i> Nova Ata
                        </button>
                    </div>

                    <div class="col-sm">
                        <div>
                            <h5 style="color: white;"> <i class="far fa-file-alt"></i> Nova Ata. <br> <small> Cria nova ata, e gerência de atas abertas. </small> </h5> 
                        </div>
                    </div>

                    <div class="col-sm">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('DangerAtaFinalized'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ops, algo deu errado !</strong> Verificamos que já existe uma ata aberta.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            Feche aqui.
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-file-alt"></i> &nbsp Registro de Ata .</h5>
                <!-- //button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="GET" action="{{route('cpp.presidentecomissao.show', 0)}}">                                     
                <div class="modal-body">
                    <!-- row -->
                    <div class="row">
                        <div class="col">
                            <input name="novAta" type="number" class="form-control" placeholder="Número da ATA">
                        </div>
                        <div class="col">
                            <input name="dataInAta" type="date" class="form-control" placeholder="Last name">
                        </div>
                        <div class="col">
                            <input name="dataOutAta" type="date" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> &nbsp Criar ata</button>
                </div>
            </form> 

        </div>
    </div>
</div>

<!-- container -->
<div class="container">
    <!-- row -->
    <div class="row" align="center">
        <!-- col-sm -->
        @if( isset($lastAta ))
            @foreach( $lastAta as $key )
        <div class="col-sm">
            <div class="card" style="width: 18rem;">
                <div class="card-body" style="text-align: justify;">
                    <div class="card-footer">
                        <h4 style="color: #1A4876;"> <b> Ata Nº <u>{{$key->numero_ata}}</u> </b>  
                            @if(empty($key->data_termino))
                                <a href="{{ route('cpp.deliberacao.index') }}">
                                    <button style="float: right;" type="button" class="btn btn-outline-primary"> 
                                        <i class="far fa-eye"></i>                                
                                    </button>
                                </a>
                                @else   
                                    <a href="/cpp/findata">
                                        <button style="float: right;" type="button" class="btn btn-info"> 
                                            <i class="far fa-eye"></i>                                 
                                        </button>
                                    </a>
                            @endif

                        </h4>
                    </div>
                    <p class="card-text">
                        <b>ID:</b> {{$key->id}}
                        &nbsp &nbsp &nbsp
                        <b>Finalizada por:</b> 
                        @if(empty($key->data_termino))
                            <i style="color: blue;" class="far fa-folder-open"> <small> Aberta </small></i> <br>
                            @else
                            {{$key->response_finalized_ata}} <br>
                        @endif
                        
                          
                        <b>Data do Registro:</b> {{$key->created_at}} <br>
                          
                        <b>Atualização:</b> {{$key->updated_at}} <br>

                    </p>
                </div>
            </div>
        </div>
            @endforeach
        @endif
        <!-- col-sm -->
    </div>
    <!-- row -->
</div>
<!-- container -->


            
<!-- @ SCRPT'S @ -->
<script type="text/javascript"> 

</script>
<!-- @ SCRPT'S @ -->


@endsection