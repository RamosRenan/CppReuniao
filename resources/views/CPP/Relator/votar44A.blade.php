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
        <div class="card-footer text-muted" style="height: auto;" align="center" > 
            <!-- @ row @ -->
            <i class="fas fa-user-clock"> </i> 
            <span style="color: #343a40;"> Deliberações <b> 44A </b> que estão sendo votadas no momento. </span> 
            <!-- @ row @ --> 
        </div>
        <!-- @ card-header @ -->
 
        <!-- @ card-body @ -->
        <div class="card-body-Votar" id="card-body-Votar" style="height: auto; "> 

            <!-- @ Contem deliberacao a ser votada @ -->
            <div style="width:100%; max-height: auto;" align="center"> 

                <!-- div delimiter -->
                <div style="width:100%; height:auto;" align="center">

                    <!--@ Voto do Membro 44A @-->
                    <section> 
                        <!-- veirifica se emptyToVote44A existe e é true -->
                        @if(isset($emptyToVote44A) && $emptyToVote44A) 
                            <br>
                            <textarea class="form-control contain_data_deliber" value=" " id="contain_data_deliber"  style=" background: #f7f9fc; " rows="9" readonly>
                                {{$vote44AData}}
                            </textarea>
                            
                            @if($responseRelator != $userLoged)

                                <form action = "/cpp/registre_Vote44A" method="POST"  style="margin:0 auto; ">
                                    @csrf
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

                                    <!-- if(isset( return_to_vote_member[0]->id))  -->
                                    <!-- inputs hidden  -->
                                        <input type="hidden" value="{{ $id44A }}"           id=" "  class="id_deliberacao"  name="id44A">
                                        <input type="hidden" value="{{ $userLoged }}"       id=" "  class="eProtoc"         name="id_membro">
                                        <input type="hidden" value="{{ $ativeSecretario }}" id=" "  class="id_membro"       name="secretario_desta_deliberacao">
                                        <input type="hidden" value="{{ $ativePresident }}"  id=" "  class="id_membro"       name="presidente_desta_deliberacao">
                                    <!-- inputs hidden -->
                                    <!-- endif -->

                                        <hr>
                                        <button type="submit" style="diaplay:block; margin-bottom: 15px;" class="btn btn-success"> <i class="fas fa-hand-point-up"></i> Votar. </button>
                                        <br>

                                </form>

                            @endif
                                
                                @else
                                <div class="row" style=" width: 100%; heigth: auto; position:relative; top: 45px; ">
                                    <div class=" col-4 "> </div>
                                    <div class=" col-4 " style=" width: 50%; heigth: auto; " align="center">
                                        <i class="fas fa-info-circle" style="position:relative; top:-45px; color:#ced4da; font-size: 300px;"></i>
                                        <div style="position:absolute; top: 5px;">
                                            <h5 style="color: #339af0"> Não há deliberação <b> 44A </b> no momento. </h5> 
                                            <br>
                                            <h5 style="color: #339af0;"> <br>  <b> Atenção ! </b> <small> Fique atento a novas deliberações a serem enviadas pelo Secretário. <b> <u> Certifique-se </u> </b> quanto ao número do eProtocolo. </small> </h5>   
                                            <br>
                                        </div> 
                                    <div class=" col-4 "> </div>
                                </div>
                        @endif
                    </section>
                    <!--@ Voto do Membro @-->

                </div>
                <!-- div delimiter -->

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

@if(isset($Success) && $Success)
    <div class="alert alert-success" role="alert">
        Voto registrado com sucesso.
    </div>
@endif


@endsection