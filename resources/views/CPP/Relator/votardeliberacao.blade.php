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

<!-- @ Sessao contem barra de notificacao @-->
<section>
    <!-- @ card card-default @ -->
    <div class="card card-default"  style=""> 
        <!-- @ card-header @ -->
        <div class="card-header " style="height: auto;" align="center" > 
            <!-- @ row @ -->
            <i class="fas fa-info"></i> <br>
            Aqui você tem acesso as deliberações que estão sendo votadas no momento.  
            <!-- @ row @ --> 

            <br>

            <a class=" " href="{{ route('cpp.relator.create', 0) }}" style="color: blue; "> 
                <i style="font-size: 18px; color: orange;" class="fas fa-mouse-pointer"></i> 
                &nbsp <u> <small> Clique aqui para votar deliberação. </small></u>
            </a> 

         </div>
        <!-- @ card-header @ -->

 
        <!-- @ card-body @ -->
        <div class="card-body-Votar" id="card-body-Votar" style="height: auto; "> 
            <!-- @ Contem deliberacao a ser votada @ -->
            <div style="width:100%; max-height: auto;" align="center"> 
                <div style="width:100%; height:auto;" align="center">
                    <section> 
                        @if(isset($return_to_vote_member))
                            <br>
                            <textarea class="form-control contain_data_deliber" value=" " id="contain_data_deliber"  style=" background: #f7f9fc; " rows="9" readonly>
                                {{$return_to_vote_member[0]->deliberacao}}
                            </textarea>
                            
                            @if($return_to_vote_member[0]->id_membro != $logedUser)

                                <form action = "{{route('cpp.relator.edit', 0)}}" method="GET"  style="margin:0 auto; ">
                                    <div class="container"> 
                                        <br>
                                        <div class="row" style="">
                                            <div class="col-4"> 
                                                <span> Votar <strong> Contra </strong> o parecer do Relator.: </span>
                                                <input type="radio" value="contra" name="vote" style=" cursor: pointer; " > 
                                            </div>     
                                            
                                            <div class="col-4"> </div>

                                            <div class="col-4">
                                                <span> Votar a <strong> Favor </strong> parecer do Relator.: </span> 
                                                <input type="radio" value="favoravel" name="vote" style=" cursor: pointer; " > 
                                            </div>
                                        </div>
                                    </div>

                                    @if(isset( $return_to_vote_member[0]->id)) 

                                        <input type="hidden" value=" {{ $return_to_vote_member[0]->id }} " id="id_deliberacao" class="id_deliberacao"  name="id_deliberacao">
                                        <input type="hidden" value=" {{ $return_to_vote_member[0]->eProtocolo }} " id="eProtoc"        class="eProtoc"         name="eProtoc">
                                        <input type="hidden" value=" {{ $usename[0]->id }} " id="id_membro"      class="id_membro"       name="id_membro">

                                    @endif

                                        <hr>
                                        <button type="submit" style="diaplay:block; margin-bottom: 15px;" class="btn btn-success"> <i class="fas fa-hand-point-up"></i> Votar. </button>
                                        <br>

                                </form>

                            @endif
                                
                                @else
                                <div class="row" style=" width: 100%; heigth: auto; position:relative; top: 45px; ">
                                    <div class=" col-4 "> </div>
                                        <div class=" col-4 " style=" width: 50%; heigth: auto; " align="center">
                                            <i class="fas fa-info-circle" style="position:relative; top:-45px; color:#f9f9f9; font-size:400px;"></i>
                                            <div style="position:absolute; top: 5px;">
                                                <h5 style="color: #ff3300"> <i class="fas fa-info"></i> &nbsp Orientações </h5> 
                                                <h5 style="color: #2A4B7C"> Não há deliberação no momento. </h5> 
                                                <br>
                                                <h5 style="color: #2A4B7C;"> <br>  Atenção ! <small> Fique atento a novas deliberações a serem enviadas pelo Secretário. Certifique-se quanto ao número do eProtocolo. </small> </h5>   
                                                <br>
                                                <h5 style="color: #2A4B7C;"> <small> Para saber se há novas deliberaçoẽs basta clicar no link acima. </small> </h5>  
                                                <h5 style="color: #2A4B7C;"> <small> <u> Relatores NÂO votam. </u> </small> </h5>  
                                            </div> 
                                        </div>
                                    <div class=" col-4 "> </div>
                                </div>
                        @endif
                    </section>
                    <!--@ Voto do Membro @-->

                </div>

            </div>
            <!-- @ Contem deliberacao a ser votada @ -->

        <div> 
        <!-- @ card-body @ -->

    <div>
    <!-- @ card card-default @ -->

</section>
<!-- @ Sessao contem barra de notificacao @-->


@if(session('itNotRelator'))
    
<div class="alert alert-warning" role="alert">
  Você ainda não é um relator. Peça ao secretário que o cadastre.
</div>

@endif

@endsection