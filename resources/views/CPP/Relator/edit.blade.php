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

    <section> 
        @if(isset($updateSuccess) == 'true')
            <div class="alert alert-success" role="alert" style="margin-top: 22px;">
                Parecer registrado. Atualizado com Sucesso.
            </div>
        @endif
    </section>
    
    <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
    <div class="card card-header">
        <span style="color: #5e81ac;  font-size: 17px; "align="center">
            Deliberações 44A. Total: 
            <strong style="color: blue;">  
                @if(isset($my44A) && !empty($my44A)) {{count($my44A)}}   
                    @else <span> 0 </span>
                @endif
            </strong>
        </span>   
    </div>   
    <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
    
    @if(isset($my44A) && !empty($my44A))
        <div class="" style="margin-top: -15px; height: auto; " align="center"> 
            <!-- card card-default -->
            <div class="card card-default" style="max-height: 500px; overflow-y: scroll;">
                <!-- $my44A --> 
                @foreach($my44A as $key)
                <!-- card-body -->
                <div class="card-body" style="height: auto;">
                    <!-- row --> 
                    <div class="row" >
                        <div style=" " class="col-md-2 form-group" align="center">
                            <label class='awesome'> Numero do E-Protocolo. </label>
                            <input class='form-control'   readonly value="{{ $key->eProtocolo }}">                            
                        </div>
                        
                        <div class="col-md-3 form-group" align="center">
                            <label class='awesome'> Nome </label>
                            <input class='form-control' readonly name="Nome" value=" {{$key->nome}} " >                        
                        </div>

                        <div class="col-md-2 form-group" align="center">                
                            <label class='awesome'> Data. </label>
                            <input name="data_sid" readonly class='form-control'  value=" {{$key->created_at}} ">
                        </div>

                        <div class="col-md-2 form-group" align="center">
                            <label class='awesome'> Unidade </label>
                            <input class='form-control' readonly name="Unidade"   value=" {{$key->unidade}} ">                        
                        </div>

                        <div class="col-md-1 form-group" align="center">
                            <label class='awesome'> CPF </label>
                            <input  class='form-control' readonly name="cpf"   value=" {{$key->cpf}} ">
                        </div>

                        <div class="col-md-1 form-group" align="center">
                            <label class='awesome'> RG </label>
                            <input  class='form-control' readonly name="rg"    value=" {{$key->rg}} ">
                        </div>

                        <div class="col-md-1 form-group" align="center">
                            <label class='awesome'> Graduacao </label>
                            <input  class='form-control' readonly name="Graduacao"    value=" {{$key->graduacao}} ">
                        </div>
                    </div>
                    <!-- @ row @ -->

                    <div class="row"> </div> <!--@ row @-->

                    <div class="row">
                        <div class="col-md-12 form-group" align="center">
                            <label class='awesome'> Descrição do pedido. </label>
                            <textarea class='form-control' readonly value=" {{ $key->descricao_pedido }} " rows="3"> 
                                {{$key->descricao_pedido}}
                            </textarea>
                        </div>                                         
                    </div> <!--@ row @-->

                    <form method="POST" action="update44A" align="center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <hr>

                        <label class='awsome' style="color: gray;"> Resolvo opnar por.: </label>

                        <div class="row">                             
                            <div class="col-md-12">
                                <select class="custom-select" id="inputGroupSelect02" name="opnouPor" required>
                                    <option vlaue=" ">      </option>
                                    <option vlaue="Indeferimento">  Indeferimento   </option>
                                    <option value="deferimento">    deferimento     </option>                                
                                    <option value="restituir">      restituir       </option>                                
                                    <option value="postergar">      postergar       </option>
                                    <option value="postergar">      encaminhamento  </option>
                                </select>                                
                            </div>                                          
                        </div>

                        <input type="hidden" name="eProtocolo_referer_44A" value="{{ $key->eProtocolo }}">

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class='awesome' style="color: gray;"> Descrição do meu parecer. </label>
                                <textarea rows='1' class='form-control' placeholder="Sua descrição" name="myParecer"   style="" required></textarea>
                            </div>                   
                            
                        </div> 
                        <!--@ row @-->

                        <div class="row" align="center">
                            <button style="margin:0 auto;" class="btn btn-danger" type="submit"> <i class="fa fa-gavel" aria-hidden="true"></i> REGISTRAR MEU PARECER. </button>                  
                        </div> 
                        <!--@ row @-->

                    </form> 
                    <!-- Final Form --> 

                </div> 
                <!--@ card-body @-->
                @endforeach

            </div> 
            <!--@ card-body @-->

        </div> <!--@ card-default @-->
    @endif

    @if( isset($my44A) )
        @if(count($my44A) == 0) 
            <div class="card-body" style="margin-top: 22px;">
                <div class="container">
                    <div class="row" >
                        <div class="col-4"> </div>
                        <div class="col-4" align="center"> 
                            <i class="fas fa-box-open" style="font-size: 80px; color:white;"> </i>
                            <br>
                            <span style="position:relative; top: -45px; font-size: 20px; color:darkgray;"> Info. Não há 44-A para serem analisados. </span> 
                        </div>
                        <div class="col-4"> </div>
                    </div>
                </div>
            </div>
        @endif
    @endif



    
                    

<!-- Script's -->


@endsection


