@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    
@yield('content')

@section('content')
   
        
    <section style=" position: relative; top: -40px;" > 
        <div style="display:flex;" >
            <i class="fas fa-project-diagram" style="font-size: 18px;" > </i> 
            <h5 style="margin-left:15px;"> Sorteio de Pedidos. </h5> 
        </div> 
    </section>

 
    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
    <!-- Sessão header View(cadastro_eProtocolo.index) -->            
    <form method="PUT" action="{{route('cpp.novosexpedientes.index')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <div class="card card-default"> 
            <div class="card-header" style=" height: 72px; " align="center">
                <h3> <i class="fas fa-filter"></i> Opções de filtros para sorteio dos pedidos. </h3>
                <h5 style="color: #b2b2b2;"> <small> Selecione a forma como deseja sortear. </small> </h5>
            </div>

            <!-- @ card-body  @ -->
            <div class="card-body">
                <div class="container">
                    <div class="row" >

                        <div class="col-md-2"> </div>

                        <div class="col-md-8">  
                            <label> Designar sorteio por pedido. </label>                                  
                            <select name="sorteio_tipo" required  class="form-control" onchange="keyped()"  id="pedido" name="pedido">
                                <option> Selecione 	</option>

                                <option value="Promoção à graduação  de Sub.Tenente QPM 1-0">Promoção à graduação  de Sub.Tenente QPM 1-0</option>

                                <option value="Promoção à graduação  de 1º Sgt. QPM 1-0">Promoção à graduação  de 1º Sgt. QPM 1-0</option>

                                <option value="Promoção à graduação  de 2º Sgt. QPM 1-0">Promoção à graduação  de 2º Sgt. QPM 1-0</option>

                                <option value="Promoção à graduação  de 3º Sgt. QPM 1-0" >Promoção à graduação  de 3º Sgt. QPM 1-0</option>

                                <option value="Promoção à graduação  de Cb. QPM 1-0">Promoção à graduação  de Cb. QPM 1-0</option>									

                                <option value="Ressarcimento de Preterição">Ressarcimento de Preterição </option>

                                <option value="Reclassificação do Quadro" >Reclassificação do Quadro</option>

                                <option value="Retificação de publicação">Retificação de publicação</option>

                                <option value="Reconsideração de Ato">Reconsideração de Ato</option>

                                <option value="Pontos positivos">Pontos positivos</option>

                                <option value="Ato de Bravura" >Ato de Bravura</option>

                                <option value="Sub-Judice">Sub-Judice</option>
                            </select>                                    
                        </div>

                        <div class="col-md-2"> <input type="hidden" name="keypedido" id="keyp" value=" "> </div>

                    </div>
                    <!-- @ row @ -->

                    <br>


                    <div class="row" >
                        <div class="col-md-2"> </div>

                        <div class="col-md-4">
                        <label> Data Inicial </label>
                            <input name='sorteio_datai' style=" " type="date" class="form-control" placeholder=" Critério de sorteio por 'DATA'." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>


                        <div class="col-md-4">
                        <label>   Data Final </label>
                            <input name='sorteio_dataf' style=" " type="date" class="form-control" placeholder=" Critério de sorteio por tipo de pedido." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>

                        <div class="col-md-2"> </div>
                    </div>
                    <!-- @ row @ -->

                    <br>

                    <div class="row" > 
                        <div class="col-md-5"> </div>

                        <div class="col-md-2" align="center">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> PESQUISAR</button>                                    
                        </div>
                        
                        <div class="col-md-3"> </div>
                    </div>

                </div>
            <!-- @ @ -->
            </div>
            
        </div>
    </form> <!-- @ form @ -->


            
    <div style="width: 100%; height: auto;" align="center"> 
        <span style="color: #9e9e9e;"> <h4> Aviso ! Não há pedidos a serem sorteados. <br> <small style="font-size: 14px;"> Talvez procurar por período, quantidade, ou pedido. </small> </h4>  </span> 
    </div>

                   
 


                
 

    <!-- Script's  -->
    <script>
        /*
        @select option chama esta função
        @Insere na tabela:'eProtocolo' coluna:'codigo_pedido' uma string única para cada tipo de pedido
        */
        function keyped(){
            //var run = document.getElementById("pedido").length;
            var val = document.getElementById("pedido").value;

            switch (val) {
                
                //
                case "Promoção à graduação  de Sub.Tenente QPM 1-0":
                    document.getElementById("keyp").value = "PROM00SUB";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Promoção à graduação  de 1º Sgt. QPM 1-0":
                    document.getElementById("keyp").value = "PROM1ºSGT";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Promoção à graduação  de 2º Sgt. QPM 1-0":
                    document.getElementById("keyp").value = "PROM2ºSGT";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Promoção à graduação  de 3º Sgt. QPM 1-0":
                    document.getElementById("keyp").value = "PROM3ºSGT";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Promoção à graduação  de Cb. QPM 1-0":
                    document.getElementById("keyp").value = "PROM00CB";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Ressarcimento de Preterição":
                    document.getElementById("keyp").value = "RESS00P";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Reclassificação do Quadro":
                    document.getElementById("keyp").value = "RECLA00Q";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Retificação de publicação":
                    document.getElementById("keyp").value = "RET00P";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Reconsideração de Ato":
                    document.getElementById("keyp").value = "RECON00A";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Pontos positivos":
                    document.getElementById("keyp").value = "PON00P";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Ato de Bravura":
                    document.getElementById("keyp").value = "ATO00B";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                case "Sub-Judice":
                    document.getElementById("keyp").value = "SUB00J";
                    var keypedido = document.getElementById("keyp").value;
                    alert(keypedido);
                    break;
                //
                default:
                    alert("Não válido");					
                    break;
            
            }//Final Switch Case:

            
        }//keyped();
    </script>


@endsection


