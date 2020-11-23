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
            <!-- card-header -->
            <div class="card-header" >
                <h5 class="card-title" style="color: cian; "> É possível alterar somente pedidos que não foram votados pela comissão.</h5>
                <p class="card-text" style="color: gray;">Listagem de todos os pareceres registrados que não foram votados. <b style="color:#2A4B7C;">TOTAL: {{count($relatados)}} </b> </p>
            </div>
            <!-- card-header -->

            <!-- Faz busca por protocolo -->
            <div class="input-group " style=" ">
                <input type="text" class="form-control" placeholder=" Faça uma busca com o número de protocolo" aria-label="Buscar parecer" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"> <i class="fas fa-search"></i> Buscar</button>
                </div>
            </div>  
            <!--  -->

            <!-- card-body -->
            <div class="card-body" style="max-height: 400px; overflow-y: scroll;" align="center">
                @if(isset($relatados) || !empty($relatados))
                    @foreach($relatados as $key => $value)
                    <a href="\cpp\editarParecer?eProtocolo={{$value->eProtocolo}}"  >
                        <div class="btn btn-outline-primary" role="alert" style="margin-top: 3px; cursor: pointer; width:100%; height: auto;">
                            <div class="container" align="center">
                                <div class="row" align="center">
                                    <div class="col-sm" align="left">
                                        <span style="color: #223A5E;"> <b> Protocolo:   </b> {{$value->eProtocolo}}         </span>
                                    </div>
                                    <div class="col-sm" align="left">
                                        <span style="color: #223A5E;"> <b> Opnou:       </b> {{$value->relator_opnou_por}}  </span>
                                    </div>
                                    <div class="col-sm" align="left">
                                        <span style="color: #223A5E;"> <b> Alterado em: </b> {{$value->updated_at}}         </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </a>
                    @endforeach
                    
                    @else
                        <hr> 
                        <h5 class="card-title">Nenhum registro encontrado.</h5>
                @endif
            </div>
            <!-- card-body -->
            
            <div class="card-footer text-muted">
                <small style="color: #223A5E;"> Edição de parecer. </small>
            </div>
        </div>
    </section>

    <br>
@endsection


