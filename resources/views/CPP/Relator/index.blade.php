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
            <div class="card card-default"  style=" width: 100%; position:relative;top:-45px;"> 
                <div class="card-header" style="height:auto; " align="center">                        
                    <a href="/cpp/__44A" style=" position:relative;  color:  #34495e; font-size: 16px; " > 
                        <i class="fas fa-vote-yea" style="color:  #34495e"></i>
                        <span style=" border-bottom: solid 1px   #34495e; " >  Registrar Art. 44-A. </span>    
                    </a>

                    <a class="  " href="{{ route('cpp.relator.show', 0) }}"  style=" color:   #34495e;  font-size: 16px; margin-left:25px; " > 
                        <i class="fas fa-radiation-alt"  style="color:  #34495e" ></i>  
                        <span style=" border-bottom: solid 1px   #34495e; " > Alterar (corrigir) meu voto. </span>
                    </a> 
                    
                    <a class=" " href="{{ route('cpp.relator.create', 0) }}" style="font-size: 16px; color:  #34495e; margin-left:25px;"> 
                        <i class="fas fa-user-clock"> </i> <span style=" border-bottom: solid 1px   #34495e; " > Votar deliberação. </span>
                    </a> 

                    <a class=" " href="\cpp\showParerPostergados" style="font-size: 16px; color:  #34495e; margin-left:25px;"> 
                        <i class="far fa-clock" style=" "></i> 
                        <span style=" border-bottom: solid 1px   #34495e; " > Postergados. </span> 
                    </a>  
                    
                    <a class=" " href="#" style="font-size: 16px; color:  #34495e; margin-left:25px;"> 
                        <i class="fas fa-history"></i> 
                        <span style=" border-bottom: solid 1px   #34495e; " > Meu histórico. </span> 
                    </a>  
                    
                    <a class=" " href="\cpp\editParecer" style="font-size: 16px; color:  #34495e; margin-left:25px;"> 
                        <i class="far fa-edit"></i> 
                        <span style=" border-bottom: solid 1px   #34495e; " > Alterar meu parecer. </span> 
                    </a> 

                    <a class=" " href="#" style="font-size: 16px; color:  #34495e; margin-left:25px;"> 
                        <i class="fab fa-autoprefixer"></i> 
                        <span style=" border-bottom: solid 1px   #34495e; " > Meus 44A. </span> 
                    </a> 
                 </div> 
                <!-- @ card-header @ -->
            </div> 
            <!-- @ card card-default @ -->
        </section>



        <!-- @ Sessao contem barra de notificacao @-->
        <section>
            <!-- @ card card-default @ -->
            <div class="card card-default"  style="position:relative;top:-50px;"> 
                <!-- @ card-header @ -->
                <div class="card-footer text-muted" style="height: 38px;" align="center" > 
                    <!-- @ row @ -->
                    <i class="fas fa-user-clock"> </i> Votar deliberação.  
                    <!-- @ row @ --> 
                    <i style="float:right; cursor:pointer; " class="fas fa-arrow-circle-down" id="fa-arrow-3"></i>
                </div>
                <!-- @ card-header @ -->

                <!-- @ card-body @ -->
                <div class="card-body-Votar" id="card-body-Votar" style="height: auto; display:none;"> 
                    <!-- @ Contem deliberacao a ser votada @ -->
                    <div style="width:100%; max-height: auto;" > 
                       <div style="width:100%; height:auto;">                           
                            <section> 
                                    @if(isset($return_to_vote_member))
                                    <textarea class="form-control contain_data_deliber" value=" " id="contain_data_deliber"  style=" background: #f7f9fc; " rows="9" readonly>
                                        {{$return_to_vote_member[0]->deliberacao}}
                                    </textarea>
                                    
                                    @if($return_to_vote_member[0]->id_membro != $logedUser)
                                        <form action = "{{route('cpp.relator.edit', 0)}}" method="GET"  style="margin:0 auto; ">
                                            <div class="container"> 
                                                <div class="row">
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
                                                <button type="submit" style="diaplay:block;" class="btn btn-success"> <i class="fas fa-hand-point-up"></i> Votar. </button>
                                        </form>
                                        @endif
                                        
                                        @else
                                            <div class="row" style=" width: 100%; heigth: auto; position:relative; top: 45px; ">
                                                <div class=" col-4 "> </div>
                                                <div class=" col-4 " style=" width: 50%; heigth: auto; " align="center">
                                                    <i class="fas fa-info-circle" style="position:relative; top:-45px; color:#f9f9f9; font-size:400px;"></i>
                                                    <div style="position:absolute; top: 5px;">
                                                    <h5 style="color: #a0a0a0"> Não há deliberação no momento. </h5> 
                                                    <br>
                                                    <h5 style="color: #a0a0a0;"> <br>  Atenção ! <small> Fique atento a novas deliberações a serem enviadas pelo Secretário. Certifique-se quanto ao número do eProtocolo. </small> </h5>   
                                                    <br>
                                                    <h5 style="color: #a0a0a0;"> <small> Para saber se há novas deliberaçoẽs clique basta clicar em " Visualizar Deliberação. ". </small> </h5>  
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




         
        <div class="card card-default" style=" position:relative; top:-50px; ">
            <!-- @ card-header @ -->
            <div class="card-footer text-muted" style="height: 38px; " align="center"> 
                <!-- @ row @ -->
                    <div class="col-4" > <i class="fas fa-bars"> </i> Seus pedidos.  </div>
                <!-- @ row @ -->         
            </div>


            <!-- @ scrool_grid_relator @ -->
            <div class="scrool_grid_relator" style="max-height: 520px; border-top: solid 1px #ffbf00; "> 
                <!-- @ card-body @ -->
                <!-- <div class="container"  > 
                <div class="row"  > 
                    <div class="col-4" align="center" style="  "> </div>
                    <div class="col-4" align="center" style="  " align="center"> 
                        <form> 
                             <div style="display:flex; margin:auto; ">
                                <input placeholder="Informe o eProtocolo" class="form-control" style="border:solid 1px #75b7ff; box-shadow:0px 0px 4px 2px #d1d1d1;">  </form>
                                <button class="btn btn-primary" style="margin-left:3px; "> Procurar </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4" align="center" style="  "> </div>
                </div>
                </div> -->

                <!-- <div style="width:100%; height:1px; background:#ffbf00; margin-top:17px;"> </div> -->

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
                <!-- <div class="card-body"> -->
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
            
            $("#fa-arrow-3").on("click", function(){                    
                var oo =  $("#fa-arrow-3" ).attr('class');

                if(oo == "fas fa-arrow-circle-down"){
                    $("#card-body-Votar").slideDown();
                    $("#fa-arrow-3" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                }else{
                    $("#card-body-Votar").slideUp();
                    $("#fa-arrow-3" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                }

            });
 
        </script>
        <!-- Script's -->






        <script type="text/javascript">
            
            var ctx = document.getElementById('pieChart0');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });




            var ctx = document.getElementById('pieChart1');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });




            var ctx = document.getElementById('pieChart2');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });





            var ctx = document.getElementById('pieChart3');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });




            var ctx = document.getElementById('pieChart4');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });




            var ctx = document.getElementById('pieChart5');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                              
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }
                
            });

            
        </script>

@endsection


