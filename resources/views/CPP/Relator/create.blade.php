@extends('layouts.app')

@yield('content_header')

@yield('content')

@section('content')


    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto; position: relative; top:-50px;" > 
        
       <h5> <strong>  <u> 44-A. </u>  </strong> </h5>                  

    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->



        <div class="card card-default" style=" position: relative; top:-40px; ">
            <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
            <div class="card-body"> 
                <div class="row" align="center">
                    <div class="col-2"> </div>

                    <div class="col-8"> 
                        <h5 style="position:relative; top: 8px; color:lightslategray;"> 
                            Esta deliberação foi enviada pelo secretario. <br>
                            Se verificado algum erro, ou entente que o texto deve ser alterado, 'NÃO' vote. <BR>
                            Mas peça ao Secretário que altere o texto e o reenvie. 
                        </h5>
                    </div>

                    <div class="col-2"> </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-12 form-group" align="center">
                        <textarea readonly rows='8' class='form-control' name="descricao" type="text" style="" required>
                            @if( empty($vote44AData) )
                                Info. Não há deliberacao 44A para ser votado.                                    
                                @else
                                    {{ $vote44AData }} 
                            @endif
                        </textarea>
                    </div>  
                </div> 
                <!--@ row @-->

 
                @if( isset($responseRelator) )
                    @if( !($responseRelator ==  $userLoged) )
                        <form method="POST" action="registre_Vote44A"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input value="{{ $userLoged }}" type="hidden" name="id_membro">
                            <input value="{{ $ativeSecretario }}" type="hidden" name="secretario_desta_deliberacao">
                            <input value="{{ $ativePresident }}" type="hidden" name="presidente_desta_deliberacao">                                 
                            <input value="{{ $id44A }}" type="hidden" name="id44A">                                 
                            <input value="{{ $id44ANotification }}" type="hidden" name="id44ANotification">                                 
                             
                            <!-- @ container @ -->                
                            <div class="container"> 
                                <div class="row" align="center">
                                    <div class="col-4"> 
                                        <span> Votar <strong> Contra </strong> o parecer do Relator.: </span>
                                        <input type="radio" value="contra" name="vote" style=" cursor: pointer; width:25px; height: 25px; position:relative; top:8px; " > 
                                    </div>     
                                    
                                    <div class="col-4"> </div>

                                    <div class="col-4">
                                        <span> Votar a <strong> Favor </strong> parecer do Relator.: </span> 
                                        <input type="radio" value="favoravel" name="vote" style=" cursor: pointer; width:25px; height: 25px; position:relative; top:8px; " > 
                                    </div>
                                </div> 
                                
                                <br>

                                <div class="row" align="center"> 
                                    <div class="col-4"> </div>     
                                    <div class="col-4"> <button type="submit" style="diaplay:block;" class="btn btn-success"> <i class="fas fa-hand-point-up"></i> Votar. </button> </div>
                                    <div class="col-4"> </div>
                                </div>
                                <!-- @ row @ -->
                                
                            </div>
                            <!-- @ container @ --> 
                        </form>
                    @endif
                @endif

            </div> 
            <!-- @ card-body @ -->
        </div> 
        <!-- card-default -->     
        
        <section> 
            @if(session('Success'))
                <div class="alert alert-success" role="alert">
                    Info. Seu Voto foi Salvo com Sucesso.
                </div>
            @endif
        </section>
   
@endsection


