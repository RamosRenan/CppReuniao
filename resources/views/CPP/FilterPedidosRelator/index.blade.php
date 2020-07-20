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
         
    <div class="card card-default" style=" position:relative; top:-50px; ">
        <!-- @ card-header @ -->
        <div class="card-footer text-muted" style="height: 38px; " align="center"> 
            <!-- @ row @ -->
                <div class="col-4" > Selecione o pedido.  </div>
            <!-- @ row @ -->         
        </div>


        <!-- @ scrool_grid_relator @ -->
        <div class="scrool_grid_relator" style="max-height: 620px;"> 
            <div class="card-body " style="max-height: auto;"> 
                <form action="{{route('cpp.relatorFilterPedidos.create')}}" method="put">
                    @csrf
                    <div class="form-group" >
                        <input type="hidden" name="keypedido" id="keyp" >
                        <!-- @ No final do código, scrpit responsável por pegar 'value' de 'option' 
                                e inserir no '<input type="hidden" name="keypedido">'.
                                Verificar o motivo no aquivo " 
                                App\Http\Controllers\Presidente\PresidenteController " 
                        @--> 
                        <label for="exampleFormControlSelect2" style="font-weight: lighter;">Pedidos ordinários.</label>
                        <select class="form-control form-control-sm"  onchange="keyped()"  id="pedido" name="pedido" required>
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
                        <small id="emailHelp" class="form-text text-muted"> Busque apenas peidos específicos. </small>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div> 
            <!-- <div class="card-body"> -->
        </div> 
        <!-- @ scrool_grid_relator @ -->

        <div class="card-footer text-muted">
            
        </div>
    </div> 
    <!-- @ card card-default @ -->


    <script type="text/javascript"> 
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


