@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')

    <form method="post'" action="{{ route('cpp.HomologP.create') }}">
        @csrf
        <!-- @  @ -->
        <div style="width: 100%; height: auto; display: flex; position: relative; top: -50px;" align="center">
            <input name="search_cpf_police" style=" width: 30%; " type="text" class="form-control" placeholder=" NOME | RG | CPF" onkeyup="this.value = this.value.toUpperCase();">
            <button style="background: #4dabf7;" id="button_search_cpf_police" class="btn btn-primary" type="submit"> 
                <span style="color: white;"> Buscar </span> 
            </button>
        </div>
    </form>
    <!-- @ form @ -->


    <!-- formulario para cadastro de novos pontos positivos -->
    <form method="POST" action=" {{ route('cpp.HomologP.store', 0) }} ">
        <div class="card card-default" style="position: relative; top: -40px;">
            <div class="card-body" align="center" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div style="width: 100%; height:auto;  ">
                    <h5> <small style=" color: black;"> TRANSCRIÇÃO DA RESOLUÇÃO Nº 001 & 002, DE 15 DE MARÇO DE 2019. </small> </h5> 
                </div>
                <hr>

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



                <!-- @ row @ -->
                <div class="row">
                    <div class="col-md-3 form-group" align="center">
                        <label class='awesome'> * Nome. <small> Não são aceitos números.</small> </label>
                        <input id="GET_NOME" id="nome_do_policial" class='form-control' type="text"  name="Nome" style="" required>
                    </div>


                    <div class="col-md-2 form-group" align="center">
                        <label class='awesome'> * RG. <small> Não são aceitos letras.</small> </label>
                        <input id="GET_RG" id="nome_do_policial" class='form-control' type="text"  name="RG" style="" required>
                    </div>


                    <div class="col-md-2 form-group" align="center">
                        <label class='awesome'> * CPF. <small> Não são aceitos letras.</small> </label>
                        <input id="GET_CPF" maxlength="11" id="nome_do_policial" class='form-control' type="text"  name="CPF" style="" required>
                    </div>



                    <div class="col-md-2 form-group" align="center" >
                        <label class='awesome'> * Graduacao. </label>
                        <input id="GET_GRADUACAO"  class='form-control' type="text"  name="Graduacao"  style="" required>
                    </div>



                    <div class="col-md-1 form-group" align="center">
                        <label class='awesome'> *Pontos. </label>
                        <input class='form-control' max="12" name="qtd_pontos" type="number" required>
                    </div>



                    <div class="col-md-2 form-group" align="center">
                        <label class='awesome'> *  Sd/Cb/Sgt </label>
                        <select class="form-control" id="pedido" name="distincao" required>
                                <option>   	            </option>
                                <option>  Cbs e Sds     </option>
                                <option>  Sgts          </option>
                        </select>
                    </div>
                </div>
                <!-- @ row @ -->




                <!-- @ row @ -->
                <div class="row">

                    <div class="col-md-4" align="center">
                        <label class="awesome"> * Universidade. </label>
                        <input type="text" class="form-control" name="faculdade" required>
                    </div>


                    <div class="col-md-6" align="center">
                        <label class="awesome"> * Curso. </label>
                        <input type="text" class="form-control" name="curso" required>
                    </div>



                    <div class="col-md-2 form-group" align="center">
                        <label class='awesome'> * E-Protocolo. </label>
                        <input class='form-control' required   oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 11.111.111-1" name="sid" type="text">
                    </div>

                </div>
                <!-- @ row @ -->


                <!-- @ row @ -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class='awesome'> * Selecione o Inciso. </label>
                        <select onchange="keyped()" required  class="form-control" id="inciso" name="inciso">
                                <option value=" "   >  </option>
                                <option value="I"   > I. Em conformidade com o inciso VII do Art. 36 da LPP (Curso de Nível Universitário)       </option>
                                <option value="II"  > II. 03 (três) pontos positivos, com base na letra “a” do Inciso V do Art. 36 da LPP        </option>
                                <option value="III" > III. 02 (dois) pontos positivos, com base na letra “b” do Inciso V do Art. 36 da LPP       </option>
                                <option value="IV"  > IV. 01 (um) ponto positivo, com base na letra “c” do Inciso V do Art. 36 da LPP            </option>
                                <option value="V"   > V. 0.5 (meio) ponto positivo, com base na letra “d” do Inciso V do Art. 36 da LPP          </option>
                                <option value="VI"  > VI. Como Louvores, com base no inciso X do Art. 36 da LPP                                  </option>
                                <option value="VII"  > VII. Ferimento em serviço, com base no inciso IX do Art. 36 da LPP                        </option>
                        </select>
                    </div>

                    <input type="hidden" name="keypedido" id="keyp" value=" ">

                    <div class="col-md-2 form-group">
                        <label class='awesome'> * Data do eProtocolo. </label>
                        <input name="data_registro_eProtocolo" required type='date' class='form-control'>
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> * Inicio do Curso. </label>
                        <input name="inicio_curso" required type='date' class='form-control'>
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> * Término do Curso. </label>
                        <input name="termino_curso" required type='date' class='form-control'>
                    </div>
                </div>
                <!-- @ row @ -->


                <!-- @ row @ -->
                <div class="row"  >
                    <div class="col-md-12 form-group" style="display: none;" id="cursosEParticip" class="cursosEParticip">
                        <label class='awesome'> * Insira todos os Certificados de Cursos e Participações. <small style="color:red;"> Não esqueça de separar com ' ; ' </small> </label>
                        <textarea rows='2' class='form-control'placeholder="Ex.: Atendimento as mulheres em situação de violência; medição de conflitos 2; Prevenção de letalidade de crianças e adolescentes; ..."
                        name="cursosEParticipacoes" type="text" style="border: solid 1px red;" ></textarea>
                    </div>
                </div>
                <!--@ row @-->



                <!-- @ row @ -->
                <div class="row">
                    <div class="col-md-12 form-group" align="center">
                        <label class='awesome'> * Unidade. </label>
                        <input id="GET_UNIDADE" class='form-control' required  name="unidade" type="text">
                    </div>
                </div>
                <!--@ row @-->


                <!-- @ row @ -->
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label class='awesome'> * Descrição. </label>
                        <textarea rows='1' class='form-control' placeholder="Sua descrição" name="descricao" type="text" style="" required></textarea>
                    </div>
                </div>
                <!--@ row @-->


                <!--@ row @-->
                <div align="center">
                    <button href="" class="btn btn-success" type="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Cadastrar. </button>
                </div>
                <!--@ row @-->
            </div> <!-- <div class="card-body"> -->
        </div> <!-- card default -->
    </form> <!-- Final Form -->






    <!-- @ Contem todos os avisos e alertas @ -->
    <section>
        @if(session('missing_fields') == 'missing_fields')
            <div class="alert alert-danger" role="alert">
                Foi detectado alguma inconsistência nos dados informados. Naõ foi possível cadastrar. Verifique os dados informados.
            </div>
        @endif



        @if(session('isNotHasAtaOpen') == 'isNotHasAtaOpen')
            <div class="alert alert-danger" role="alert">
                Info: isNotHasAtaOpen. Não há ata aberta para inserção de homologação de pontos positivos.
            </div>
        @endif
    </section>
    <!-- @ Contem todos os avisos e alertas @ -->







    <!-- @ Contain todas as funcoes scripts @ -->
    <script type="text/javascript">


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


        function keyped(){
                //var run = document.getElementById("pedido").length;
                var val = document.getElementById("inciso").value;

                switch (val) {

                    //
                    case "I":
                        document.getElementById("keyp").value = "I";
                        var keypedido = document.getElementById("keyp").value;
                        alert(keypedido);
                        break;
                    //
                    case "II":
                        document.getElementById("keyp").value = "II";
                        var keypedido = document.getElementById("keyp").value;
                        alert(keypedido);
                        break;
                    //
                    case "III":
                        document.getElementById("keyp").value = "III";
                        var keypedido = document.getElementById("keyp").value;
                        alert(keypedido);
                        break;
                    //
                    case "IV":
                        document.getElementById("keyp").value = "IV";
                        var keypedido = document.getElementById("keyp").value;
                        alert(keypedido);
                        break;
                    //
                    case "V":
                        document.getElementById("keyp").value = "V";
                        var keypedido = document.getElementById("keyp").value;
                        alert(keypedido);
                        break;
                    //
                    case "VI":
                        document.getElementById("keyp").value = "VI";
                        var keypedido = document.getElementById("keyp").value;
                        var styles = {
                            display: "block",
                        };
                        $("#cursosEParticip").css(styles);
                        alert(keypedido);
                        break;
                    //
                    case "VII":
                        document.getElementById("keyp").value = "VII";
                        var keypedido = document.getElementById("keyp").value;
                        var styles = {
                            display: "block",
                        };
                        alert(keypedido);
                        break;
                    //

                    default:
                        alert("Não válido");
                        break;

                }//Final Switch Case:


            }//keyped();





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
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection
