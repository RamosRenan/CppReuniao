@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')

@section('content')


<div class="card text-center">
    <div class="card-footer text-muted">
        <form action="/cpp/getPolice"  method="POST" >
        <input type="hidden" name="_token" value="{{csrf_token()}}">
            <!-- @  @ -->
            <div style="width: 100%; height: auto; display: flex; position: relative;" align="center">
                <input name="search_cpf_police" style=" max-width: 350px; " type="text" class="form-control" placeholder=" Insira o 'NOME' ou 'RG' ou 'CPF' do militar. " >
                <button style="background: #757575;" id="button_search_cpf_police" class="btn btn-outline-secondary" type="submit"> <span style="color: white;"> Buscar </span> </button>
            </div>
        </form>
        <!-- @ form @ -->
    </div>

     
    <form action="{{route('cpp.__44a.create')}}" method="get" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="card card-default" style=" "> 
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

                    <div class="col-md-3 form-group"  align="center">
                        <label class='awesome'> * N° eProtocolo. </label>
                            <input class='form-control' required minlength = "12" oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 11.111.111-1" name="eProtocolo" type="text">
                    </div>



                    <div class="col-md-5 form-group"  align="center">
                        <label class='awesome'> * Nome. </label>
                        <input id="GET_NOME" id="nome_do_policial" class='form-control' type="text"  name="Nome" style="" required>
                    </div>



                    <div class="col-md-4 form-group"  align="center">
                        <label class='awesome'> * Unidade. </label>
                        <input id="GET_UNIDADE"  class='form-control' type="text" name="Unidade"  style="text-transform: uppercase;" required>
                    </div>



                    <div class="col-md-2 form-group"  align="center">
                        <label class='awesome'> * RG. </label>
                        <input id="GET_RG" id="nome_do_policial" class='form-control' type="text"  name="RG" style="" required>
                    </div>




                    <div class="col-md-2 form-group"  align="center">
                        <label class='awesome'> * CPF. </label>
                        <input id="GET_CPF" maxlength="11" id="nome_do_policial" class='form-control' type="text"  name="CPF" style="" required>
                    </div>




                    <div class="col-md-2 form-group"  align="center">
                        <label class='awesome'> * Graduacao. </label>
                        <input id="GET_GRADUACAO"  class='form-control' type="text"  name="Graduacao"  style="" required>
                    </div>




                    <div class="col-md-6 form-group"  align="center">
                        <label class='awesome'> * Designar para Relator. </label>
                        <select id="" placeholder="Selecione o relator." id="nome_do_policial" class='form-control' type="text"  name="relator_designado" style="" required>
                            @foreach( $CountIsertMembers as $key )
                                <option value="{{$key->id}}">
                                    <span> ID.: {{$key->id}} - {{$key->name}} </span>
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-md-12 form-group"  align="center">
                        <label  class='awesome'> * Faça uma breve descrição do pedido do militar. <small style="color: red;"> * Preechimento obrigatório </small> </label>
                        <textarea rows="3" id="  " id="nome_do_policial" class='form-control' type="text"  name="descricao_pedido" style="box-shadow: 0px 0px 5px 1px #e2e2e2;" required> </textarea>
                    </div>

                </div>
                <!-- @ row @ -->

                <div class="row">

                    <div class="col-md-2 form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-paper-plane"></i> Cadastrar. </button>
                    </div>

                </div>

            </div> <!-- <div class="card-body"> -->
        </div> <!-- card default -->
    </form> <!-- Final Form -->
</div>


<section>
    @if( session('lackFields') == "false" )
        <div class="p-3 mb-2 bg-danger text-white"> Por gentileza, preencha todos os campos. </div>
    @endif
</section>


<section>
    @if( isset($successIsert44A) == 'success' )
        <div class="alert alert-success" role="alert"> 44A Cadastrado com Sucesso. </div>
    @endif
</section>

<section>
    @if( isset($ataVazia) )
        <div class="alert alert-danger" role="alert"> Não há ata aberta. </div>
    @endif
</section>

<section> 
    @if(session('alredy_existy_eProtocolo'))
        <div class="alert alert-warning" role="alert"> Já existe este protocolo. </div>
    @endif
<section>


<!-- Scripts -->
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
<!-- Scripts -->

@endsection
