@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')         
 
    <section style="position:relative; top:-20px;"> 
        <div class="card" align="center">
            <div class="card-header">
                <h4 class="card-title" style="color: #1971c2;"> Prévia do texto da deliberção. </h4>
                <h5 class="card-title" style="color: #1971c2;"> <small> Reunião deliberativa. </small> </h5>
            </div>
            <div class="card-body" style="min-height: auto;" >
                <h5 class="card-title" style="color: black;"> <small> Deliberação. </small> </h5>
                <textarea class="card-text" style="width: 100%;" rows="5" readonly>
                    @if(isset($decodeDeliber))
                        {{$decodeDeliber}}
                        @else
                            Não há deliberação no momento. Aqui você tem acesso ao texto da deliberação.
                    @endif
                </textarea>
                <br>
            </div>

            <div>
                <form action="/cpp/registry_vote_presidente" method="get" >
                    @csrf
                    @if(isset($return_to_vote_member[0]))
                    <input type="hidden" name="eProtocolo" value="{{$return_to_vote_member[0]->eProtocolo}}" class="custom-control-input" id=" ">
                    @endif

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

                     
                        <!-- <input  type="radio" name="Favoravel" id="exampleRadios1" value="option1" >
                        <label  for="exampleRadios1" style="color:red;">
                            <h5> Contra </h5>
                        </label>

                        <br><br>

                        <input type="radio" name="Contra" id="exampleRadios2" value="option2">
                        <label for="exampleRadios2" style="color:blue;">
                            <h5> Favoravel </h5>
                        </label> -->

                    <br>

                    @if(isset($decodeDeliber))
                            <button type="submit"  class="btn btn-primary"> Desempatar </button>
                        @else
                            <button type="button"  class="btn btn-dark" disabled> Desempatar  <small> (desativado) </small> </button>
                            <h5 style="color: dark; font-size: 12px;"> <i class="fas fa-info-circle"></i> Obs.: Botão é ativado quando existir uma deliberação para ser analisada </h5>
                        @endif

                    <a href="#" style="color:red;"> <u> <i class="fas fa-radiation-alt"></i> Corrigir meu Voto. </u> </a>

                    <hr>

                </div>
            </div>
        </div>
    </section>
    <!-- @ Sessao contem barra de notificacao @-->


    <!-- SCRPT'S -->
        <script> 
 


        </script>
    <!-- SCRPT'S -->
    
@endsection


