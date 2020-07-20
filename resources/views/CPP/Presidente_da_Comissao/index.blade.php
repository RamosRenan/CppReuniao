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
            </div>
            <div class="card-body" style="min-height: auto;" >
                <br>
                <textarea class="card-text" style="width: 100%;" rows="5" readonly>
                    @if(isset($decodeDeliber))
                        {{$decodeDeliber}}
                        @else
                            Não há deliberação.
                    @endif
                </textarea>
                <br>
            </div>

            <div>
                <form action="/cpp/registry_vote_presidente" method="get">
                    @csrf
                    @if(isset($return_to_vote_member[0]))
                    <input type="hidden" name="eProtocolo" value="{{$return_to_vote_member[0]->eProtocolo}}" class="custom-control-input" id=" ">
                    @endif

                    <div style="width:100%; height: auto; display: flex;" align="center">
                        <div class="form-check" style=" margin-left: 35px;">
                            <input class="form-check-input" type="radio" name="Favoravel" id="exampleRadios1" value="option1">
                            <label class="form-check-label" for="exampleRadios1" style="color:red;">
                                Contra
                            </label>
                        </div>

                        <div class="form-check" style=" margin-left: 35px;">
                            <input class="form-check-input" type="radio" name="Contra" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2" style="color:blue;">
                                Favoravel
                            </label>
                        </div>
                    </div>

                    <hr>

                    @if(isset($decodeDeliber))
                            <button type="submit"  class="btn btn-primary"> Desempatar </button>
                        @else
                            <button type="submit"  class="btn btn-primary" disabled> Desempatar </button>
                    @endif


                    <br> <br>

                    <a href="#"> <u> <i class="fas fa-radiation-alt"></i> Corrigir meu Voto. </u> </a>

                    <hr>

                    <small> <i class="fas fa-info-circle"></i> OBS.: Botão só ativado quando existir uma deliberação para ser analisada </small>
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


