@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')         

    <section style="position:relative;" > 
        <div class="card">
            <div class="card-header">
                <a href="#"> <u> <i class="fas fa-file-alt"></i> Visualizar Ata </u> </a>
                <a href="#" style="margin-left: 15px;"> <u> <i class="fas fa-users"></i> Relatores </u> </a>
                <a href="#" style="margin-left: 15px;"> <u> Etc </u> </a>
            </div>
        </div>
    </section>
    <!-- @ Sessao contem barra de notificacao @-->


    <section style="position:relative;" > 
        <div class="card">
            <div class="card-header">
                <a href="{{route('cpp.presidentecomissao.index')}}"> <u> Visualizar deliberção </u> </a>
            </div>
            <div class="card-body" style="min-height: auto;" >
                <h5 class="card-title"> Prévia do texto da deliberção. </h5>
                <textarea class="card-text" style="width: 100%;" rows="8">
                    @if(isset($decodeDeliber))
                        {{$decodeDeliber}}
                        @else
                            Não há deliberação.
                    @endif
                </textarea><br>
            </div>
        </div>
    </section>
    <!-- @ Sessao contem barra de notificacao @-->


    <section style="position:relative;" > 
        <div class="card">
            <div class="card-header">
                <a href="#" style=""> <u> Desempatar Votação </u> </a>
            </div>
            <div class="card-body">
                <label> Favorável </label>
                <input type="radio" class=" ">
                <label> Contra </label>
                <input type="radio" class=" "> <br>
                <a href="#" class="btn btn-primary"> Desempatar </a>
            </div>
        </div>
    </section>
    <!-- @ Sessao contem barra de notificacao @-->






    <!-- SCRPT'S -->
        <script> 
 
   


        </script>
    <!-- SCRPT'S -->
    
@endsection


