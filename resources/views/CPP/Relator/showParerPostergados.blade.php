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
            <div class="card-header ">
                <i class="fas fa-user-clock" style="font-size: 28px; color: #ff3300;"></i><br>
                <h5 style="color: cian; margin-left: 15px;"> Seus pedidos postergados. <small> Total: {{count($postergados)}} </small> </h5>
            </div>

            <div class="card-body" style="max-height: 400px; overflow-y: scroll;">
                <h5 class=" " style="color:  #eb984e ;">
                    <i class="fas fa-info"></i> <br>
                    Não deixe seus pedidos acumularem. <br>
                    <small style="color: #577284;"> Aqui você tem acesso aos seus pedidos que foram postergados. </small>
                </h5>
                <hr>
                @if(isset($postergados))
                    @foreach($postergados as $key => $value)
                        <a href="/cpp/editParerPostergados?eProtocolo={{$value->eProtocolo}}" >
                        <div class="alert alert-danger" role="alert">
                            <i class="far fa-clock" style="color: blue; float: left; font-size: 28px;"> </i>
                            <span> <strong> e-Protocolo: </strong> {{$value->eProtocolo}} </span> &nbsp;  &nbsp;
                            <span> <strong> Data: </strong> {{$value->created_at}} </span> &nbsp;  &nbsp; &nbsp;
                            <span> <strong> Foi votado: </strong> @if($value->relator_votou == 'true') Sim @else Não @endif </span> &nbsp; &nbsp;  &nbsp;
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


