@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')


@section('content')


    <section>
        <div class="row" style="position: relative ; top: -40px;"> 
            <i class="fas fa-university" style="font-size: 20px;" ></i>
            <h5 style="">    Conteúdo da Homologação.  </h5>
        </div>
    </section>

 

 
    <form method="GET" action=" {{ route('cpp.HomologP.edit', 0) }} "> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">       
        <div class="card card-default"> 
            <div class="card-body"  align="center" > 
                    <span style="font-size: 16px; color: red; float:left; " > <strong> Atenção ! </strong>  </span>
                    <br>
                    <span style="font-size: 14px; color: blue; float:left; " >   1 - Caso acrescente ao texto é <strong> NECESSÁRIO  </strong> clicar em <strong> EDITAR </strong> para salvar com a alteração feita.  </span>
                    <br>
                    <span style="font-size: 14px; color: GRAY; float:left; " >   2 - Se não for necessário alterar o texto apenas clique em <strong> CONFIRMAR. </strong> </span>
                    <br>
                    <!-- @ row @ -->
                    <div class="row" style=" " align="center" >                        
                        <div class="col-md-12 form-group" style=" " id="cursosEParticip" class="cursosEParticip">
                            <textarea rows='4' class='form-control' name="conteudoOficial" type="text" style=" text-align: center; " >
                                {{$conteudoOficial}}
                            </textarea>
                        </div>  
                    </div> 
                    <!--@ row @-->

                    <input type="hidden" value=" {{ $requestAll['qtd_pontos'] }} "      name="qtd_pontos"   >
                    <input type="hidden" value=" {{ $requestAll['Graduacao'] }} "       name="Graduacao"    >
                    <input type="hidden" value=" {{ $requestAll['Nome'] }} "            name="Nome"         >
                    <input type="hidden" value=" {{ $requestAll['RG'] }} "              name="RG"           >
                    <input type="hidden" value=" {{ $requestAll['CPF'] }} "             name="CPF"          >
                    <input type="hidden" value=" {{ $requestAll['faculdade'] }} "       name="faculdade"    >
                    <input type="hidden" value=" {{ $requestAll['curso'] }}"            name="curso"        >
                    <input type="hidden" value=" {{ $requestAll['sid'] }} "             name="sid"          >
                    <input type="hidden" value=" {{ $requestAll['unidade'] }} "         name="unidade"      >
                    <input type="hidden" value=" {{ $requestAll['distincao'] }} "       name="distincao"    >
                    <input type="hidden" value=" {{ $requestAll['inciso'] }} "          name="inciso"       >
                    <input type="hidden" value=" {{ $requestAll['keypedido'] }} "       name="keypedido"    >
                    <input type="hidden" value=" {{ $requestAll['data_registro_eProtocolo'] }}" name="data_registro_eProtocolo" >
                    <input type="hidden" value=" {{ $requestAll['inicio_curso'] }}  "           name="inicio_curso"             >
                    <input type="hidden" value=" {{ $requestAll['termino_curso'] }} "           name="termino_curso"            >
                    <input type="hidden" value=" {{ $requestAll['cursosEParticipacoes'] }} "    name="cursosEParticipacoes"     >
                    <input type="hidden" value=" {{ $requestAll['descricao'] }} "               name="descricao"                >
                    <input type="hidden" value=" {{ $numAta }} "                                name="pertence_ata"             >
                    <input type="hidden" value=" {{ $idAta }} "                                 name="identifier_in_ata"        >
 
                    <!-- <a class="btn btn-warning"  href="{{ route('cpp.HomologP.create', ['requestAll'=>$requestAll, 'conteudoOficial'=>$conteudoOficial, 'cpfPolicial'=>$cpfPolicial, 'numAta'=>$numAta, 'idAta'=>$idAta]) }}" style="color:aliceblue;">  
                        <i class="fas fa-edit"> </i> Editar 
                    </a>    -->
                    <button type="submit" class="btn btn-primary" style=" margin-left: 25px; color:aliceblue;"> <i class="fas fa-paper-plane"></i> Confirmar </button>

            </div> <!-- <div class="card-body"> -->
        </div> <!-- card default -->
                   
    </form> <!-- Final Form -->






    <!-- @ Contem todos os avisos e alertas @ -->
    <section> 

        @if( $createSuccess)
            <div class="alert alert-success" role="alert">
                Homologação criada com seucesso.
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

        

    </script>
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection