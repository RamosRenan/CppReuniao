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
     
    <section style="display: flex; position: relative;"> 
        <!-- @ card card-default @ -->
        <div class="card card-default"  style="background: lightgray; width: 100%; position:relative;top:-45px;"> 
            <div class="card-header" style="height:auto; background:whitesmoke;" align="center">  

                <a href="#" style="float:left; color:  #34495e; font-size: 17px; " > 
                    <i class="fas fa-external-link-alt"></i>
                    Links rápidos.    
                </a>  

                <a class="  " href="/cpp/__44A"  style=" color:  blue;  font-size: 13px; margin-left:55px; " > 
                    <i class="fas fa-external-link-alt"  style="color:  blue" ></i>  
                    <span style=" border-bottom: solid 1px   blue; " > Registrar parecer 44-A. </span>
                </a> 

                <a class="  " href="{{ route('cpp.relator.show', 0) }}"  style=" color:  blue;  font-size: 13px; margin-left:55px; " > 
                    <i class="fas fa-radiation-alt"  style="color:  blue" ></i>  
                    <span style=" border-bottom: solid 1px   blue; " > Alterar (corrigir) meu voto. </span>
                </a> 
                    
                <a class=" " href="\cpp\showParerPostergados" style="font-size: 13px; color:  blue; margin-left:55px;"> 
                    <i class="far fa-clock" style=" "></i> 
                    <span style=" border-bottom: solid 1px   blue; " > Postergados. </span> 
                </a>  
                
                <a class=" " href="#" style="font-size: 13px; color:  blue; margin-left:55px;"> 
                    <i class="fas fa-history"></i> 
                    <span style=" border-bottom: solid 1px   blue; " > Meu histórico. </span> 
                </a>  
                
                <a class=" " href="\cpp\editParecer" style="font-size: 13px; color:  blue; margin-left:55px;"> 
                    <i class="far fa-edit"></i> 
                    <span style=" border-bottom: solid 1px   blue; " > Alterar meu parecer. </span> 
                </a> 

                <a class=" " href="#" style="font-size: 13px; color:  blue; margin-left:55px;"> 
                    <i class="fab fa-autoprefixer"></i> 
                    <span style=" border-bottom: solid 1px   blue; " > Meus 44A. </span> 
                </a> 
                </div> 
            <!-- @ card-header @ -->
        </div> 
        <!-- @ card card-default @ -->
    </section>


    <!-- card-default -->
    <div class="card card-default" style=" position:relative; top:-50px; ">

        <!-- @ scrool_grid_relator @ -->
        <div class="scrool_grid_relator" style="max-height: 520px; "> 

            <!-- card-body -->
            <div class="card-body " style="max-height: auto;"> 
                @if(isset($Usorteados) )
                @if(count($Usorteados) > 0 )
                @foreach($Usorteados as $key)                    
                    <!--@ row @-->
                <div class="row">
                    <div class="col-2 form-group">
                        <label class='awesome'> Numero do E-Protocolo. </label>
                        <input class='form-control' readonly required minlength = "12"   value="{{ $key->eProtocolo }}" name="sid" type="text">
                        
                    </div>

                    <div class="col-4 form-group">
                        <label class='awesome'> Pedido. </label>
                        <input class='form-control' required minlength = "12" readonly value="{{ $key->pedido }}"  name="pedido" type="text">

                    </div>

                    <div class="col-2 form-group">                
                        <label class='awesome'> Data do eProtocolo. </label>
                        <input name="data_sid" readonly value="{{ $key->entry_system_data }}"  name="entry_system_data" type='text' class='form-control'>

                    </div>

                    <div class="col-2 form-group">
                        <label class='awesome'> Status. </label>
                        <input name="situacao" readonly value="{{ $key->status }}"  name="status" type='text' class='form-control' readonly value='Cadastrado'>
                    
                    </div>  
                    
                    <div class="col-2 form-group">
                        <label class='awesome'> RG </label>
                        <input  class='form-control' type="text"  name="rg"  style="" readonly value="{{ $key->rg }}" >
                    </div>
                </div>
                <!--@ row @-->



                <!-- @ Final Form @ -->
                <form action="{{ route('cpp.relator.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!--@ row @-->
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class='awesome'> Nome </label>
                        <input class='form-control' type="text"  name="Nome" style="" readonly value="{{ $key->nome }}"  >                        
                    </div>

                    <div class="col-md-3 form-group">
                        <label class='awesome'> Unidade </label>
                        <input class='form-control' type="text"  name="Unidade"  style="" readonly value="{{ $key->unidade }}" >                        
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> Graduacao </label>
                        <input  class='form-control' type="text"  name="Graduacao"  style="" readonly value="{{ $key->graduacao }}" >
                    </div>
                    
                    <div class="col-md-2 form-group">
                        <label class='awesome'> CPF </label>
                        <input  class='form-control' type="text"  name="cpf"  style="" readonly value="{{ $key->cpf }}" >
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awsome' style="color: gray;"> Resolvo opnar por.: </label>
                        <input type="hidden" value=" {{ $key->eProtocolo }} " name="num_sid">
                        <!--@ row @-->
                        <div class="">
                            <select name="voto_relator" class="custom-select" id="inputGroupSelect02">
                                <option > Deliberar Por.:                       </option>
                                <option vlaue="Indeferimento">  Indeferimento   </option>
                                <option value="deferimento">    deferimento     </option>                                
                                <option value="restituir">      restituir       </option>                                
                                <option value="postergar">      postergar       </option>
                            </select>                                
                        </div>                                          
                        <!--@ row @-->
                    </div>
                </div> 
                <!--@ row @-->



                <!--@ row @-->
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label class='awesome'> Descrição. </label>
                        <textarea  class='form-control'   name="descricao" type="text" style="" placeholder="{{ $key->conteudo }}" readonly value="{{ $key->conteudo }}"></textarea>
                    </div>                   
                </div> 
                <!--@ row @-->



                    <!--@ row @-->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class='awesome' style="color: gray;"> Descrição do meu parecer. </label>
                            <textarea rows='2' class='form-control' placeholder="Sua descrição" name="parecer" type="text" style="" required></textarea>
                        </div>                   
                        
                    </div> 
                    <!--@ row @--> 

                    
                    <!--@ row @-->
                    <div class="row" align="center">
                        <div class="col-12" align="center"> <button href="" class="btn btn-danger" type="submit"> <i class="fa fa-gavel" aria-hidden="true"></i> REGISTRAR MEU PARECER. </button> </div>                   
                    </div> 
                    <!--@ row @-->
                </form> 
                <!-- @ Final Form @ -->   

                <hr>  

                @endforeach

                    @else
                        <div style="width: 100%; height: auto; color:lightslategray;" align="center"> 
                            <span > Seus pedidos acabaram.  </span> <br>
                            <span> Aguarde novos sorteios de expedientes. </span>   
                        </div> 

                @endif
                @endif
                    
            </div> 
            <!--  card-body -->

        </div> 
        <!-- @ scrool_grid_relator @ -->

    </div> 
    <!-- @ card card-default @ -->


    <!-- @ Alerts @ -->
    <section> 
        @if(session('nothen_turnback_deliber'))
            <div class="alert alert-danger" role="alert">
                NÃO HÁ DELIBERARAÇÃO DISPONÍVEL PARA ALTERAÇÃO DE VOTO.  SOLICITE AO SECRETÁRIO LIBERAÇÃO.  
            </div>
        @endif
    </section>


    <section> 
        @if(session('emptyToVote44A'))
            <div class="alert alert-WARNING" role="alert">
                NÃO HÁ 44A DISPONÍVEL PARA VOTAÇÃO.  
            </div>
        @endif
    </section>


    <section> 
        @if(session('itNotRelator'))
            <div class="alert alert-WARNING" role="alert">
                NÃO FOI POSSÍVEL REGISTRAR O PARECER, POIS VOCÊ AINDA NÃO É TIDO COMO RELATOR NO SISTEMA. PEÇA AO SECRETÁRIO QUE O CADASTRE.  
            </div>
        @endif
    </section>
    <!-- @ Alerts @ -->


    <!-- Script's -->
    <script type="text/javascript">
        
    </script>

@endsection


