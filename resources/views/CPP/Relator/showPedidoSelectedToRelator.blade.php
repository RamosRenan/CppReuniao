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
    
     <!-- card-default -->
    <div class="card card-default" style=" position:relative; ">
        <!-- @ scrool_grid_relator @ -->
        <div class="scrool_grid_relator" style="height: auto; "> 
            <div class="card-header" align="center"> 
                <h5> <i style="font-size: 26px; color: #004B8D;" class="far fa-user-circle"></i> &nbsp Pedido do Militar Selecionado </h5>
            </div>
            <!-- card-body -->
            <div class="card-body " style="max-height: auto;"> 
                @if(isset($Usorteados) )
                @if(count($Usorteados) > 0 )
                @foreach($Usorteados as $key)  
                                  
                <!--@ row @-->
                <div class="row">
                    <div class="col-2 form-group">
                        <label class='awesome'> Nº eProtocolo. </label>
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' readonly required minlength = "12"   value="{{ $key->eProtocolo }}" name="sid" type="text">
                        
                    </div>

                    <div class="col-4 form-group">
                        <label class='awesome'> Pedido. </label>
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' required minlength = "12" readonly value="{{ $key->pedido }}"  name="pedido" type="text">

                    </div>

                    <div class="col-2 form-group">                
                        <label class='awesome'> Data do eProtocolo. </label>
                        <input style="background: transparent; border:none; box-shadow: none; " name="data_sid" readonly value="{{ $key->entry_system_data }}"  name="entry_system_data" type='text' class='form-control'>

                    </div>

                    <div class="col-2 form-group">
                        <label class='awesome'> Status. </label>
                        <input style="background: transparent; border:none; box-shadow: none; " name="situacao" readonly value="{{ $key->status }}"  name="status" type='text' class='form-control' readonly value='Cadastrado'>
                    
                    </div>  
                    
                    <div class="col-2 form-group">
                        <label class='awesome'> RG </label>
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' type="text"  name="rg"  style="" readonly value="{{ $key->rg }}" >
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
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' type="text"  name="Nome" style="" readonly value="{{ $key->nome }}"  >                        
                    </div>

                    <div class="col-md-3 form-group">
                        <label class='awesome'> Unidade </label>
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' type="text"  name="Unidade"  style="" readonly value="{{ $key->unidade }}" >                        
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> Graduacao </label>
                        <input style="background: transparent; border:none; box-shadow: none; "  class='form-control' type="text"  name="Graduacao"  style="" readonly value="{{ $key->graduacao }}" >
                    </div>
                    
                    <div class="col-md-2 form-group">
                        <label class='awesome'> CPF </label>
                        <input style="background: transparent; border:none; box-shadow: none; " class='form-control' type="text"  name="cpf"  style="" readonly value="{{ $key->cpf }}" >
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
                        <textarea style="background: transparent; border:none; box-shadow: none; " class='form-control'   name="descricao" type="text" style="" placeholder="{{ $key->conteudo }}" readonly value="{{ $key->conteudo }}"></textarea>
                    </div>                   
                </div> 
                <!--@ row @-->


                <!--@ row @-->
                <div class="row">
                    <div class="col-md-12 form-group">
                        <a href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo]) }}" style="border:none;" class="btn btn-outline-primary" > 
                            <i class="fas fa-paperclip"></i> &nbsp <u> Visualizar anexo. </u> 
                        </a>
                    </div>                   
                </div> 
                <!--@ row @-->


                <br>

                    <!--@ row @-->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class='awesome' style="color: #009acd;"> Descrição do meu parecer. </label>
                            <textarea rows='2' class='form-control' placeholder="Sua descrição" name="parecer" type="text" style="" required></textarea>
                        </div>                   
                        
                    </div> 
                    <!--@ row @--> 

                    <br>

                    <!--@ row @-->
                    <div class="row" align="center">
                        <div class="col-12" align="center"> 
                            <button href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo]) }}" class="btn btn-danger" type="submit"> 
                                <i class="fa fa-gavel" aria-hidden="true"></i> Registrar meu parecer. 
                            </button> 
                        </div>                   
                    </div> 
                    <!--@ row @-->
                </form> 
                <!-- @ Final Form @ -->   

                <hr>  

                @endforeach

                    @else
                        <div style="width: 100%; height: auto; color: #4c566a;" align="center"> 
                            <i class="fas fa-hourglass-end"></i> <br>
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

    <br>


    <!-- Script's -->
    <script type="text/javascript">
        
    </script>

@endsection


