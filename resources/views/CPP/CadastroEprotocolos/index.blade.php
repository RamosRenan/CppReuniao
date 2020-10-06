@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
    
    <!-- @ section @ -->
    <section> 
        <!-- form  Busca militar informado no campo - url(/cpp/cadastroE-protocolo) -->
        <form class="form-inline" method="GET" action="{{ route('cpp.cadastroE-protocolo.index') }}"> 
                
            <!-- card card-default -->
            <div class="card"  style="width: 100%; height: auto; ">

                <!-- card-header -->
                <div class="card-header" style="width: 100%; height: auto; ">
                    <!-- row -->
                    <div class="row" style="width: 100%;">
                        <!-- col-md-4 -->
                        <div class="col-md-4"> 

                        </div>
                        <!-- col-md-4 -->

                        <!-- col-md-4 -->
                        <div class="col-md-4" style=" " align="center">
                            <h4 style="color: #2A4B7C;"> 
                                <i class="fa fa-id-card" style="font-size:32px; " aria-hidden="true">  </i> 
                                &nbsp Registro de eProtocolo 
                            </h4>
                        </div> 
                        <!-- col-md-4 -->
                        
                        <div class="col-md-4" >  
                            <div class="form-group mx-sm-4 mb-2" style="float:right;">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" name="search_cpf_police" id="inputPassword2" placeholder="Insira o 'NOME' ou 'RG' do militar.">
                                <button type="submit" class="btn btn-primary mb-2 btn-sm" style=" position: relative; top: 3px;">
                                    <i class="fas fa-search" style=""></i> &nbsp  
                                </button>
                            </div>
                        </div>                   

                    </div>                
                    <!-- row -->
                     
                </div>
                <!-- card-header -->

            </div>
            <!-- card  -->

        </form> 
        <!-- form -->


        <!-- form - Cadastra realemnte um novo pedido -->
        <form method="POST" action=" {{ route('cpp.cadastroE-protocolo.store') }} " enctype="multipart/form-data"> 
            
            <!--  csrf_token() //Campo escodido que garante segunça no envio do form. Obs.: Ver Doc do Laravel 'csrf' -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">   

            <!-- card card-default - contem campos do formulário -->
            <div class="card card-default" style="margin-top: -10px;"> 

                <!-- card-body - corpo do form -->
                <div class="card-body"> 
                    
                    <!-- section - cortina escondida mostra o militar buscado no campo de busca acima -->
                    <section> 
                        <div class=" curtain_register " align="center" id="curtain_register"> <div> 
                    </section>
                    <!-- /section -->


                    <!-- section CORTINA DE CORFIRMAÇÃO DE DADOS  Dados retornados do meta4 para confirmação. -->
                    <section> 

                        <!-- contain_curtain -->
                        <div class="contain_curtain" id="contain_curtain_section" > 

                            <!-- sun_contain_curtain -->
                            <div class="sun_contain_curtain" align="center"> 

                                <h5 style="position: relative; top: 8px;"> 
                                    <i class="fas fa-user-circle"> Confirme os dados do Militar. </i>   
                                    <a  id="closecurtain" > 
                                        <i class="fas fa-times"style=" cursor:pointer; float:right; margin-right: 8px; margin-top: 2px; color: #c6c6c6; font-size: 19px;"></i> 
                                    </a> 
                                </h5>
                                
                                <hr> <br>

                                <!-- sintaxe blade(laravel) verifica se foi encontrado o militar informado -->
                                @if(isset($result_search))
                                    <form>                                        
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
                                <!-- final if -->

                            </div>
                            <!-- sun_contain_curtain -->

                        </div>
                        <!-- contain_curtain -->

                    </section> 
                    <!-- /section -->


                    <!-- row - Aqui separo o form em q cada row(linha) representa uma faixa com varios campos. Existem pelo menos 3 rwos -->
                    <div class="row">

                        <!-- col-md-3 form-group -->
                        <div class="col-md-3 form-group">
                            <label class='awesome'> * Numero do E-Protocolo. </label>
                            <input class='form-control' required minlength = "12" oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 	11.111.111-1" name="sid" type="text">
                        </div>
                        <!-- col-md-3 form-group -->

                        <!-- col-md-3 form-group -->
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

                            <!--
                                * Obs.:
                                * No final do código, scrpit responsável por pegar 'value' de 'option' 
                                * e inserir no '<input type="hidden" name="keypedido">'.
                                * Verificar o motivo no aquivo "App\Http\Controllers\Presidente\PresidenteController" 
                            -->  
                            <input type="hidden" name="keypedido" id="keyp" value=" ">

                        </div>
                        <!-- col-md-3 form-group -->

                        <!-- col-md-2 form-group -->
                        <div class="col-md-2 form-group">                
                            <label class='awesome'> * Data do eProtocolo. </label>
                            <input name="data_sid" required type='date' class='form-control'>

                        </div>
                        <!-- col-md-2 form-group -->

                        <!-- col-md-2 form-group -->
                        <div class="col-md-2 form-group">
                            <label class='awesome'> * Status. </label>
                            <input name="situacao" required type='text' class='form-control' readonly value='Cadastrado'>                            
                        </div>
                        <!-- col-md-2 form-group -->


                        <!-- col-md-2 form-group -->
                        <div class="col-md-2 form-group">
                            <label class='awesome'> * CPF </label>
                            <input id="GET_CPF" maxlength="11" class='form-control' type="text"  name="cpf"  style="" required>
                        </div>
                        <!-- col-md-2 form-group -->
                        
                    </div>
                    <!-- /row -->


                    <!-- row 2 -->
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

                    </div> 
                    <!-- row 2-->

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Anexar doc. eProtocolo do militar <small style="color: #364fc7;"> &nbsp ( Tamanho MAX. 100MB ) </small> </label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="FormControlFile1">
                    </div>

                    <!-- row 3 -->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class='awesome'> * Descrição. </label>
                            <textarea rows='4' class='form-control' placeholder=" 0h0h0h0h0h " name="descricao" type="text" style="" required>  
                                Exemplo.: Requerimento impetrado pelo Sd. QPM 1-0 Nome do Policial(Bombeiro) Militar, RG 0.000.000-0, pertencente ao UNIDADE, requer análise da sua condição “sub-judice” para medidas pertinentes. (Ref.: SID nº 00.000.000-0).
                            </textarea>
                        </div>                   
                        
                    </div> 
                    <!-- row 3-->


                    <!-- container -->
                    <div class="container">
                        <!-- row 4 -->
                        <div class="row" align="center" >
                            <div class="col-4"> </div>
                            <div class="col-4">
                                <button href="" class="btn btn-success" type="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Cadastrar. </button> 
                                <a href="{{ route('cpp.cadastroE-protocolo.show', 0) }}" class="btn btn-info" style="margin-left:25px;" > 
                                    <i class="fa fa-users" aria-hidden="true"></i> Últimos Cadastros 
                                </a>
                            </div>
                            <div class="col-4"> </div>
                        </div> 
                        <!-- row 4-->
                    </div> 
                    <!-- container -->
                </div> 
                <!-- <div class="card-body"> -->
            </div> 
            <!-- card default -->
        </form> 
        <!-- Final Form -->

    </section>
    <!-- @ section @ -->


    <!-- contém todos os avisos caso ocorram as excecoes -->
    <div style="width:100%; heigth: 50px; position:relative; top: -30px;">

        <!-- inside -->
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

            @if (\Session::has('errorAnexo'))
                <div class="alert alert-warning">
                    <ul>
                        <li>São aceitos apenas formatos: 'pdf'. Certifique-se de que anexou um aquivo. </li>
                    </ul>
                </div>
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
        <!-- inside -->

    </div>
    <!-- -->

    <br>                                                  

    <!-- Script's  -->
    <script>
        /*
        * select option chama esta função
        * Insere na tabela:'sid' coluna:'codigo pedido' uma string única para cada tipo de pedido
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


        //insere caracteres no campo eProtocolo;
        function mascara(i){

            var v = i.value;
            
            if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length-1);
                return;
            }
            
            i.setAttribute("maxlength", "12");

            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "-";

        } 
        //mascara(i)


        // insere auto no campos os valores encontrados da busca pelo policial
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
            document.getElementById("GET_GRADUACAO").value = keyGRADUACAO;

            $("#contain_curtain_section").slideUp();
            $("#curtain_register").delay(900).slideUp();
        }
        
    </script>


    <!-- Scripts -->
    <script>
    
        //jquery up cortina 
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

        //fecha modal cortina do polical encontrado, se clicado no x
        function closeModal(){
            $("#contain_curtain_section").slideUp();
            $("#curtain_register").delay(900).slideUp();
            alert( 'OK ! Dados Inconsistentes ={' )
        }
    
    </script>
    <!-- /Scripts -->

@endsection


