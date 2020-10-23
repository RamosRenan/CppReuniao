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
    <div class="card">
        <div class="card-header">
            <div class="row" align="center">
                <div class="col-sm"> </div>
                <div class="col-sm">
                    <h5> <i class="far fa-file-alt"></i> &nbsp; Deliberação em votação no momento. </h5>
                </div>
                <div class="col-sm">
                    @if(isset($Usorteados))
                        <h5>
                        <a href="{{route('cpp.viewRelatorio.create', ['', 'eProtocolo'=>$return_to_vote_member[0]->eProtocolo])}}" style="float: right; "> 
                            <i style=" " class="fas fa-paste"></i> &nbsp; Visualizar Relatório do relator
                        </a> 
                        </h5> 
                    @endif
                </div>
            </div>
        </div>
        <!-- card-header -->

        <div class="card-body">
            <div style=" " class="row">
                <h5 style="margin: auto;" class="card-title">Texto da Deliberação.</h5>
            </div>
            <hr>
            @if(isset($return_to_vote_member))
                <textarea class="form-control contain_data_deliber" id="contain_data_deliber"  style="background: transparent; border:none; text-align:justify;" rows="9" readonly>
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
                            <button type="submit" style="diaplay:block; margin-bottom: 15px;" class="btn btn-success"> 
                                <i class="fas fa-hand-point-up"></i> &nbsp; Registrar voto
                            </button>
                            <br>
                    </form>
                @endif

                @else
                    <div class="row" style=" width: 100%; heigth: auto; position:relative; top: 45px; " >
                        <div class="col-8" >
                            <div style="position:absolute; top: 5px;">
                                <h3 style=" "> Orientações: </h3> 
                                <h5 style=""> 
                                    <small>
                                    1.1&nbsp; 
                                    Fique atento a novas deliberações a serem enviadas pelo secretário. 
                                    Certifique-se quanto ao número do eProtocolo. 
                                    </small>
                                </h5>   
                                <h5 style="">
                                    <small>  
                                        1.2 &nbsp; Para saber se há novas deliberaçoẽs clique no link: &nbsp;
                                        <a href="{{ route('cpp.relator.create', 0) }}">  <u> <i style=" " class="fas fa-spinner"> </i> Verifique aqui se há nova deliberação.</u> </a>  
                                    </small> 
                                </h5>  
                                <h5 style=""> <small> 1.3 &nbsp; Relatores não votam suas deliberações, qualquer dúvida entre em contato com o secretário. </small></h5>  
                            </div> 
                        </div>
                    </div>
            @endif
        </div>

        <div class="card-footer"> </div>

    </div>
    <!-- card -->
    @if(session('itNotRelator'))
        <div class="alert alert-warning" role="alert">
            Você ainda não é um relator. Peça ao secretário que o cadastre.
        </div>
    @endif

    <br>

@endsection