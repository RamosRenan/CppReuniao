@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')  
    <!-- nav nav-tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#" style=" ">
                <i class="fas fa-radiation-alt"></i> Corrigir meu Voto. </u> 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
    <!-- nav nav-tabs -->


    <section style="position:relative;"> 
        <!-- card -->
        <div class="card" align="center">
            <!-- card-header -->
            <div class="card-header">
                <h4 class="card-title" style="color: black;"> Prévia do texto da deliberação. <br> <small style="color: #1971c2;"> Texto em votação no momento. </small> </h4>
            </div>
            <!-- card-header -->

            <!-- card-body -->
            <div class="card-body" style="min-height: auto;" >
                <h4  style="color: black;">  Deliberação.  </h4>
                <textarea class="card-text" style="width: 100%; border:none; text-align:justify;" rows="6" readonly>
                    @if(isset($containDeliberOrdinaria) || isset($containDeliber44a))
                        @if(isset($containDeliberOrdinaria) && $containDeliberOrdinaria!=null)
                            {{$containDeliberOrdinaria}}
                            @elseif(isset($containDeliber44a) && $containDeliber44a!=null)
                                {{$containDeliber44a}}
                        @endif

                        @else
                            Não há deliberação no momento. Aqui você tem acesso ao texto da deliberação.
                    @endif
                </textarea>

                <br>

                <!-- se todos os relatores já votaram verificxa se houve empate -->
                @if(isset($empateVotacaoOrdinaria) || isset($empateVotacao44a))
                    <form action="/cpp/registry_vote_presidente" method="get" >
                        @csrf

                        @if(isset($eProtocoloOrdinaria))
                            <input type="hidden" name="eProtocolo" value="{{$eProtocoloOrdinaria}}" class="custom-control-input" id=" ">
                            @else
                                <input type="hidden" name="eProtocolo" value="{{$eProtocolo44a}}" class="custom-control-input" id=" ">
                        @endif
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <input type="radio" id="exampleRadios1" name="gender" value="Contra">
                                    &nbsp<label for="exampleRadios1"><h5>Contra <i class="far fa-thumbs-down"></i></h5></label>
                                </div>
                                <div class="col-sm">
                                
                                </div>
                                <div class="col-sm">
                                    <input type="radio" id="exampleRadios2" name="gender" value="Favoravel">
                                    &nbsp<label for="exampleRadios2"><h5> Favorável <i style="color:blue;" class="far fa-thumbs-up"></i> </h5></label>
                                </div>
                            </div>
                        </div>

                        <br>

                        <button type="submit"  class="btn btn-primary"> Desempatar </button>
                        <br> <br>
                        <span style="color: dark;"> 
                            <i class="fas fa-info-circle"></i> Obs.: Botão é ativado quando existir uma deliberação para ser analisada. 
                        </span>
                    </form>
                @endif
                <!-- end elseif() -->

                @if(isset($falta_Voto_Relatores_desta_deliber) || isset($falta_Voto_Relatores_44a))
                    <br>
                    <div class="alert alert-info" role="alert">
                        <a class="">                         
                            <i class="fas fa-info-circle"></i> 
                            &nbsp &nbsp &nbsp 
                            Todos os relatores ainda não votaram.
                        </a>
                    </div>
                @endif
                
            </div>
            <!-- card-body -->

            <div class="card-footer" align="center"> Presidente da comissão de promoção de praças. </div>
        </div>
        <!-- card -->
    </section>
    <!-- @ Sessao contem barra de notificacao @-->

    <br>

    <!-- SCRPT'S -->
        <script> 
 


        </script>
    <!-- SCRPT'S -->
    
@endsection


