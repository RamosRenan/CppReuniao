@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
    
    <!-- @ section @ -->
    <section>       

        <form method="GET" action="{{ route('cpp.cadastroE-protocolo.index') }}">    
            <div class="card card-default" style="position: relative; bottom:-14.3px;"> 
                <div class="card-header" style=" height: 63px; ">
                    <!-- @  @ -->                
                    <div class="row">

                        <div class="col-md-4"> 
                            <i class="fa fa-id-card" style="font-size:32px; margin-right: 18px;" aria-hidden="true"></i>
                        </div>

                        <div class="col-md-4" style="display:flex;">
                            <input name="search_cpf_police" style=" max-width: 350px; " type="text" class="form-control" placeholder=" Insira o 'NOME' ou 'RG' do militar. " >
                            <button style="background: #757575;" id="button_search_cpf_police" class="btn btn-outline-secondary" type="submit"> 
                                <i class="fas fa-search" style="color: white;"></i>
                            </button>
                        </div>

                        <div class="col-md-4">  </div>                   

                    </div>                
                    <!-- @  @ -->
                </div>
            </div>
        </form> <!-- @ form @ -->





        <form method="POST" action=" {{ route('cpp.cadastroE-protocolo.store') }} "> 
            <input type="hidden" name="_token" value="{{ csrf_token() }}">       
            <div class="card card-default"> 
                <div class="card-body"> 
                    
                    <section> 
                        <div class=" curtain_register " align="center" id="curtain_register"> <div> 
                    </section> 

                    <!-- @ SESSÃO CORTINA DE CORFIRMAÇÃO DE DADOS        @ -->
                    <!-- @ Daddos retornados do meta4 para confirmação.  @ -->
                    <section> 
                        <div class="contain_curtain" id="contain_curtain_section" > 
                            <div class="sun_contain_curtain" align="center"> 
                                <h5 style="position: relative; top: 8px;"> 
                                    <i class="fas fa-user-circle"></i> 
                                    Confirme os dados do Militar. 
                                    <a  id="closecurtain" > 
                                        <i class="fas fa-times"style=" cursor:pointer; float:right; margin-right: 8px; margin-top: 2px; color: #c6c6c6; font-size: 19px;"></i> 
                                    </a> 
                                </h5>
                                
                                <hr> <br>

                                @if(isset($result_search))
                                <form >                                        
                                        <input type="hidden" id="policeman"  value="{{$result_search[0]->NOME}}">
                                        <label > <h5> NOME: </h5> </label> 
                                        <input id="keyNOME" type="text" style=" color:#7c7c7c; border:none; font-size: 15px;  min-width: 350px;" value="{{$result_search[0]->NOME}}">
    
                                    <div style="display: block;"> 
                                        <label > <h5>  UNIDADE:  </h5> </label> 
                                        <input id="keyUNIDADE"  type="text" style=" color:#7c7c7c;  border:none; border:none; font-size: 15px;  min-width: 350px;" value=" {{ $result_search[0]->OPM_DESCRICAO }} ">
                                    </div>

                                    <div style="display: block;"> 
                                        <label >  <h5> GRADUAÇÃO: </h5>  </label> 
                                        <input id="keyGRADUACAO"  type="text" style="  color:#7c7c7c; border:none; border:none; font-size: 15px; min-width: 350px ;" value=" {{$result_search[0]->CARGO}} - {{$result_search[0]->QUADRO}} ">
                                    </div> 

                                    <div> 
                                        <label > <h5>  CPF:  </h5> </label> 
                                        <input id="keyCPF"  type="text" style="  color:#7c7c7c; border:none; border:none; font-size: 15px; min-width: 350px ;" value=" {{$result_search[0]->CPF}} ">
                                    </div> 
                                        
                                    <div style="display: block;"> 
                                        <label > <h5>  RG:  </h5> </label> 
                                        <input id="keyRG" type="text" style=" color:#7c7c7c;  border:none; border:none; font-size: 15px; min-width: 350px ;" value=" {{$result_search[0]->RG}} ">
                                    </div> 
                                    <br>
                                        <button type="button" onclick="data_police()" class="btn btn-primary"> <i class="fas fa-thumbs-up"></i> Confirmar.</button> 
                                        <button type="button" onclick="closeModal()" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Inconsistente.</button>

                                </form>
                                    @else
                                        <h3 style="color: #c9c9c9;"> Info ! <small> Dados do policial não encontrado. </small> </h3>
                                        <i style="color: #c9c9c9; font-size: 30px;" class="fas fa-frown-open"></i>
                                @endif
                            </div>
                        </div>
                    </section> 
                    <!-- @ SESSÃO CORTINA DE CORFIRMAÇÃO DE DADOS  @ -->



                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class='awesome'> * Numero do E-Protocolo. </label>
                                <input class='form-control' required minlength = "12" oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 	11.111.111-1" name="sid" type="text">
                            </div>

                            <div class="col-md-3 form-group">
                                <label class='awesome'> * Pedido. </label>
                                <select   class="form-control" onchange="keyped()"  id="pedido" name="pedido" required>
                                    <option value="">  </option>

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
                                <input type="hidden" name="keypedido" id="keyp" value=" ">
                                <!-- @ No final do código, scrpit responsável por pegar 'value' de 'option' 
                                        e inserir no '<input type="hidden" name="keypedido">'.
                                        Verificar o motivo no aquivo " 
                                        App\Http\Controllers\Presidente\PresidenteController " 
                                @-->                    
                            </div>

                            <div class="col-md-2 form-group">                
                                <label class='awesome'> * Data do eProtocolo. </label>
                                <input name="data_sid" required type='date' class='form-control'>

                            </div>

                            <div class="col-md-2 form-group">
                                <label class='awesome'> * Status. </label>
                                <input name="situacao" required type='text' class='form-control' readonly value='Cadastrado'>                            
                            </div>



                            <div class="col-md-2 form-group">
                                <label class='awesome'> * CPF </label>
                                <input id="GET_CPF" maxlength="11" class='form-control' type="text"  name="cpf"  style="" required>
                            </div>
                            
                        </div>




                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class='awesome'> * Nome </label>
                                <input id="GET_NOME" id="nome_do_policial" class='form-control' type="text"  name="Nome" style="" required>                        
                            </div>

                         

                            <div class="col-md-3 form-group">
                                <label class='awesome'> * Graduacao </label>
                                <input id="GET_GRADUACAO"  class='form-control' type="text"  name="Graduacao"  style="" required>
                            </div>

                            <div class="col-md-2 form-group">
                                <label class='awesome'> * RG </label>
                                <input id="GET_RG"  class='form-control' type="text"  name="rg"  style="" required>
                            </div>

                          
                            <div class="col-md-4 form-group">
                                <label class='awesome'> * Unidade </label>
                                <input id="GET_UNIDADE" class='form-control' type="text"  name="Unidade"  style="" required>                        
                            </div>

                        </div> <!--@ row @-->




                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class='awesome'> * Descrição. </label>
                                <textarea rows='6' class='form-control' placeholder=" 0h0h0h0h0h " name="descricao" type="text" style="" required>  
                                    Exemplo.: Requerimento impetrado pelo Sd. QPM 1-0 Nome do Policial(Bombeiro) Militar, RG 0.000.000-0, pertencente ao UNIDADE, requer análise da sua condição “sub-judice” para medidas pertinentes. (Ref.: SID nº 00.000.000-0).
                                </textarea>
                            </div>                   
                            
                        </div> <!--@ row @-->



                        <div class="container" >
                            <div class="row" align="center" >
                                <div class="col-4"> </div>
                                <div class="col-4">
                                    <button href="" class="btn btn-success" type="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Cadastrar. </button> 
                                    <a href="{{ route('cpp.cadastroE-protocolo.show', 0) }}" class="btn btn-info" style="margin-left:25px;" > 
                                        <i class="fa fa-users" aria-hidden="true"></i> Últimos Cadastros 
                                    </a>
                                </div>
                                <div class="col-4"> </div>
                            </div> <!--@ row @-->
                        </div> <!--@ container @-->

                </div> <!-- <div class="card-body"> -->
            </div> <!-- card default -->
                    
        </form> <!-- Final Form -->
    </section>
    <!-- @ section @ -->





    <div style="width:100%; heigth: 50px; position:relative; top: -30px;">
        <div style="width:100%; heigth: 30px; background-color:green;">
            
            @if( isset($qtdDBeProtocolo))
                @if(isset($qtdDBeProtocolo) > 0)
                    <div class="alert alert-info">
                        <strong> Info! </strong> Não foi possivel cadastrar, número do S.I.D já existente.
                    </div>
                @endif				 

            @endif
            
            @if( isset($succes))
                @if($succes == "succes")
                    <div class="alert alert-success">
                        <h5> <strong>Info!</strong>  Success - Salvo com sucesso no sistema.   </h5>    
                    </div>							 
                @endif	
            @endif	


            @if( isset($permitionchar))
                @if($permitionchar == "false")
                    <div class="alert alert-warning">
                        <strong>Info!</strong> Não são aceitos caracteres especiais no S.I.D.
                    </div>
                @endif				 

            @endif
            
            
            @if( isset($messageError))
                @if($messageError == 'error')
                    <div class="alert alert-warning">
                        <strong> Info! </strong> Não foi possível encontrar o policial informado.  <small> Preencha os dados manualmente. </small>
                    </div>
                @endif				 

            @endif
            
        </div>
    </div>

                                                                

    <!-- Script's  -->
    <script>
        /*
        @select option chama esta função
        @Insere na tabela:'sid' coluna:'codigo pedido' uma string única para cada tipo de pedido
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




        function mascara(i){

            var v = i.value;
            
            if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length-1);
                return;
            }
            
            i.setAttribute("maxlength", "12");

            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "-";

        } //mascara(i)





        function data_police(){
            var keyNOME      = document.getElementById("keyNOME"     ).value;
            var keyCPF       = document.getElementById("keyCPF"      ).value;
            var keyRG        = document.getElementById("keyRG"       ).value;
            var keyUNIDADE   = document.getElementById("keyUNIDADE"  ).value;
            var keyGRADUACAO = document.getElementById("keyGRADUACAO").value;

            document.getElementById("GET_NOME"     ).value = keyNOME;
            document.getElementById("GET_CPF"      ).value = keyCPF;
            document.getElementById("GET_RG"       ).value = keyRG ;
            document.getElementById("GET_UNIDADE"  ).value = keyUNIDADE;
            document.getElementById("GET_GRADUACAO" ).value = keyGRADUACAO;

            $("#contain_curtain_section").slideUp();
            $("#curtain_register").delay(900).slideUp();
        }


        
    </script>



    <script>
    
        $("#closecurtain").click(function(){
            // alert('olaaaa');
            $("#contain_curtain_section").slideUp();
            $("#curtain_register").delay(900).slideUp();
        });


        $(document).ready(function(){

            var getpolic = document.getElementById('policeman').value;


            if (!getpolic){
                alert("não existe mesmo");
            }else{
                $("#contain_curtain_section").css("display", "block");
                $("#curtain_register").css("display", "block");
            }

        });


        function closeModal(){
            $("#contain_curtain_section").slideUp();
            $("#curtain_register").delay(900).slideUp();
            alert( 'OK ! Dados Inconsistentes ={' )
        }

    
    </script>


<!-- Script's -->


@endsection

