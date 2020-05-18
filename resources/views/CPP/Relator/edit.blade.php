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
    
     <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
     <section style=" position: relative;  width: 60%; " > 
        <span style="color:#444444; margin-left:25px; font-size:20px;">
            Deliberações Artg. 44-A.  
        </span>         
    </section> 


    <br>

    
    @if(isset($my44A) && !empty($my44A))
    <div class="" style="postion: relative; top: -40px; max-height: 650px; overflow-y:scroll; ">      
        @foreach($my44A as $key)
            <div class="card card-default" style=" "> 
            <div class="card-body" style=" margin-top:53px; "> 
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
                        <textarea class='form-control' readonly value=" {{ $key->descricao_pedido }} " rows="5"> 
                            {{$key->descricao_pedido}}
                        </textarea>
                    </div>                                         
                </div> <!--@ row @-->




                <form method="POST" action="update44A">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <hr>

                    <label class='awsome' style="color: gray;"> Resolvo opnar por.: </label>

                    <div class="row">                             
                        <div class="col-md-12">
                            <select class="custom-select" id="inputGroupSelect02" name="opnouPor">
                                <option > Deliberar Por.:                       </option>
                                <option vlaue="Indeferimento">  Indeferimento   </option>
                                <option value="deferimento">    deferimento     </option>                                
                                <option value="restituir">      restituir       </option>                                
                                <option value="postergar">      postergar       </option>
                            </select>                                
                        </div>                                          
                    </div>

                    <input type="hidden" name="eProtocolo_referer_44A" value="{{ $key->eProtocolo }}">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class='awesome' style="color: gray;"> Descrição do meu parecer. </label>
                            <textarea rows='2' class='form-control' placeholder="Sua descrição" name="myParecer"   style="" required></textarea>
                        </div>                   
                        
                    </div> <!--@ row @-->

                    <div class="row" >
                        <p> <button href="" class="btn btn-danger" type="submit"> <i class="fa fa-gavel" aria-hidden="true"></i> REGISTRAR MEU PARECER. </button> </p>                    
                    </div> <!--@ row @-->
                </form> <!-- Final Form --> 
            </div> <!--@ card-body @-->
            </div> <!--@ card-body @-->
        @endforeach
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



    <section> 
        @if(isset($updateSuccess) == 'true')
            <div class="alert alert-success" role="alert" style="margin-top: 22px;">
                Parecer registrado. Atualizado com Sucesso.
            </div>
        @endif
    </section>
                    

<!-- Script's -->


@endsection


