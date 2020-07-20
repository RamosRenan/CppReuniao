@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
@yield('content')

@section('content')
 
     
    <section style=" width:100%; height:auto;"> 
        <div class="card text-center">
            <div class="card-footer text-muted">
                <i class="fas fa-user-clock" style="font-size: 28px; color: cian;"></i>
                <span style="color: cian; margin-left: 15px;"> Seus pedidos postergados. </span>
                <span> Total: {{count($postergados)}} </span>
            </div>
            <div class="card-body" style="max-height: 385px; overflow-y: scroll;">
                <h4 class=" " style="color:  #eb984e ; font-family: 'Tajawal', sans-serif;">Não deixe seus pedidos acumularem.</h4>
                <p class="card-text" style="color: gray;">Aqui você tem acesso aos seus pedidos que foram postergados.</p>
                <hr>
                @if(isset($postergados))
                    @foreach($postergados as $key => $value)
                        <a href="/cpp/editParerPostergados?eProtocolo={{$value->eProtocolo}}" >
                        <div class="alert alert-danger" role="alert">
                            <i class="far fa-clock" style="float: left; font-size: 28px;"> </i>
                            <span> <strong> e-Protocolo: </strong> {{$value->eProtocolo}} </span> &nbsp;  &nbsp;
                            <span> <strong> Data: </strong> {{$value->created_at}} </span> &nbsp;  &nbsp; &nbsp;
                            <span> <strong> votado ? </strong> @if($value->relator_votou == 'true') Sim @else Não @endif </span> &nbsp; &nbsp;  &nbsp;
                            <span> <strong> Opnou:  </strong> {{ $value->relator_opnou_por }} </span>
                        </div>
                        </a>
                    @endforeach

                    @else  
                        <i class="far fa-smile-wink" style="color: green;"></i>
                        <br>
                        <h3 style="color: green; font-family: 'Tajawal', sans-serif;"> Não há pedidos postergados.  </h3>
                @endif
            </div>
            <div class="card-footer text-muted">
                Postergados.
            </div>
        </div>
    </section>
        


    <!-- Script's -->
    <script type="text/javascript">

    </script>

@endsection


