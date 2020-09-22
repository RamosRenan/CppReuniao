@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')

@section('content')
    
   <div class="scrool_grid_salavotacao" style="height: auto;">
        @if(isset($allLastDeliberPostergados) && count($allLastDeliberPostergados) > 0)
            @foreach($allLastDeliberPostergados as $key => $value)
                <div class="card card-default_sa" style=" ">
                    <div class="card-header">
                        <!-- @ SESSÃO QUAL RELATOR  @ -->
                        <div class="row"  style="text-align:center;">
                            <div class="col-sm-11" style=" position:relative; left: 20px; cursor: pointer;">
                                <!-- <i class="fas fa-bars _more_info "  id="_more_info{{$key}}" onclick="moreInfo(this.id, event)" >  </i>  -->
                                <h5 style="color: cian;  font-family: 'Montserrat', sans-serif; "> 
                                    <i style="color: orange;" class="fas fa-hourglass-start"></i> Deliberações Postergadas 
                                    <br>
                                    <small style="font-size: 13px;"> Lista de todos os protocolos pendentes, postergados, de reuniões(atas), anteriores. </small>
                                </h5>    
                            </div>
                        </div>
                        <!-- @ SESSÃO QUAL RELATOR  @ -->
                    </div>

                    <!-- @ card-body  @ -->
                    <div class="card-body" style="height:auto;" align="">
                        <div class="row"  style="height: 18px;">
                            <div class="col-sm-3" style=" position:relative;  cursor: pointer;">
                                <a href="#" style="" id="{{$value->eProtocolo}}" onclick="moreInfo(this.id)" > 
                                    <u> <h5> <i class="fas fa-mouse-pointer"></i>  &nbsp <small> Mais informações clique aqui </small> </h5> </u> 
                                </a>
                            </div>

                            <div class="col-sm-4" style=" position:relative;  cursor: pointer;">
                                 
                            </div>

                            <div class="col-sm-5" style=" " align="right">
                                <form class="form-inline" style="float: right;">
                                    <div class="form-group mx-sm-3 mb-2" style="">
                                        <input placeholder="Ex.: 10.000.000-0" type="email" class="form-control" id="inputEmail4">
                                        <button type="submit" class="btn btn-primary">Procurar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br> <br>
                        <form action=" {{route('cpp.pedidosPostergados.create')}} " method="put" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    {{ Form::label('NOME', 'NOME', array('class' => 'awesome')) }}
                                    {{ Form::text('NOME', null, array('class'=>'form-control', 'placeholder'=>$value->nome,'value'=>$value->nome,'readonly')) }}

                                </div>
                                <div class="col-md-3 form-group">
                                    {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome')) }}
                                    {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'placeholder'=>$value->unidade,'value'=>$value->unidade, 'readonly')) }}

                                </div>
                                <div class="col-md-2 form-group">
                                    {{ Form::label('GRADUACAO', 'GRADUAÇÃO', array('class' => 'awesome')) }}
                                    {{ Form::text('GRADUACAO', null, array('class'=>'form-control', 'placeholder'=>$value->graduacao, 'readonly')) }}

                                </div>
                                <div class="col-md-2 form-group">
                                    {{ Form::label('CPF', 'CPF', array('class' => 'awesome')) }}
                                    {{ Form::text('CPF', null, array('class'=>'form-control', 'placeholder'=>$value->cpf, 'readonly')) }}

                                </div>
                                <div class="col-md-2 form-group">
                                    {{ Form::label('RG', 'RG', array('class' => 'awesome')) }}
                                    {{ Form::text('RG', null, array('class'=>'form-control', 'placeholder'=>$value->rg, 'readonly')) }}

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-2 form-group">
                                    {{ Form::label('eProtocolo', 'eProtocolo', array('class' => 'awesome')) }}
                                    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>$value->eProtocolo, 'readonly')) }}

                                </div>
                                <div class="col-md-5 form-group">
                                    {{ Form::label('PEDIDO', 'PEDIDO', array('class' => 'awesome')) }}
                                    {{ Form::text('eProtocolo', null, array('class'=>'form-control', 'placeholder'=>$value->pedido, 'readonly')) }}

                                </div>
                                <div class="col-md-2 form-group">
                                    {{ Form::label('STATUS', 'RG', array('class' => 'awesome')) }}
                                    {{ Form::text('STATUS', null, array('class'=>'form-control', 'placeholder'=>$value->status, 'readonly')) }}

                                </div>
                                <div class="col-md-1 form-group">
                                    {{ Form::label('DATA_ENTRADA', 'ENTRADA', array('class' => 'awesome')) }}
                                    {{ Form::text('DATA_ENTRADA', null, array('class'=>'form-control', 'placeholder'=>$value->entry_system_data, 'readonly')) }}

                                </div>
                                <div class="col-md-2 form-group">
                                    {{ Form::label('DATA_DO_EPROTOCOLO', 'DATA ePROTOCOLO', array('class' => 'awesome')) }}
                                    {{ Form::text('DATA_DO_EPROTOCOLO', null, array('class'=>'form-control', 'placeholder'=>$value->data_eProtocolo, 'readonly')) }}

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome')) }}
                                    <textarea readonly name=contain_ddeliber class=form-control rows='2' value="{{$value->conteudo}}"  > {{$value->conteudo}} </textarea>
                                </div>
                            </div>


                            <!-- dropdown -->
                            <div class="dropdown">
                                <button style="border:none; background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: blue;"> 
                                        Selecione um relator para filtrar eProtocolos, respectivos ao relator. &nbsp 
                                        <i class="fas fa-caret-down"></i> 
                                    </span>
                                </button>

                                <!-- dropdown-menu -->
                                <div style="width: 50%;" class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                    <div class="card">
                                        <div class="card-header" align="center">
                                            <h5> <i class="far fa-id-card"></i> &nbsp Selecione o relator. </h5>
                                        </div>
                                    </div>
                                
                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[0]))
                                            <a style="color: cian; " href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[0]->id ])}} ">
                                                <h5 class=" ">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp 
                                                    {{$searchall[0]->name}} 
                                                </h5>
                                            </a>
                                            @else   
                                                <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->
                                    
                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[1]))
                                            <a style="color: cian;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[1]->id ])}} ">
                                                <h5 class=" ">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp
                                                    {{$searchall[1]->name}} 
                                                </h5>
                                            </a>
                                            @else   
                                                <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->

                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[2]))
                                            <a style="color:cian; " href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[2]->id ])}} ">
                                                <h5 class="">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp
                                                    {{$searchall[2]->name}}
                                                </h5>
                                            </a>
                                            @else   
                                                <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->

                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[3]))
                                            <a style="color: cian; font-size: 13.56px" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[3]->id ])}} ">
                                                <h5 class="">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp
                                                    {{$searchall[3]->name}}
                                                </h5>
                                            </a>
                                            @else   <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->

                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[4]))
                                            <a style="color:cian; " href="{{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[4]->id ])}} ">
                                                <h5 class=" ">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp
                                                    {{$searchall[4]->name}}
                                                </h5>
                                            </a>
                                            @else   
                                                <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->

                                    <!-- dropdown-item linha -->
                                    <span class="dropdown-item">
                                        @if(isset($searchall[5]))
                                            <a style="color:cian;  " href=" {{ route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[5]->id ]) }} ">
                                                <h5 class=" ">
                                                    <i class="far fa-user-circle"></i>
                                                    &nbsp &nbsp &nbsp{{$searchall[5]->name}}
                                                </h5>
                                            </a>
                                            @else   
                                                <span class=" "> "NÃO HÁ RELATOR" </span>
                                        @endif
                                    </span>
                                    <!-- dropdown-item linha -->
                                </div>
                                <!-- dropdown-menu -->
                            </div>
                            <!-- dropdown -->

                            <br>

                            <div class="row">
                                <div class="col-md-3">
                                    <span> <strong> Comissão opnou por.: </strong> </span>
                                    <select name="ComissaoOpnou" class="custom-select" id="inputGroupSelect02" required>
                                        <option value="aprovar">   aprovar      </option>
                                        <option value="desaprovar"> desaprovar  </option>
                                        <option value="discordar"> discordar    </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <span> <strong> Comissão decidiu por.: </strong> </span>
                                    <select name="decisao_da_comissao"  class="custom-select" id="inputGroupSelect02" required>
                                        <option value="Indeferimento">    Indeferimento  </option>
                                        <option value="deferimento">     deferimento    </option>
                                        <option value="restituir">      restituir        </option>
                                        <option value="postergar">     postergar        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <span> <strong> Corum da Comissão.: </strong> </span>
                                    <select name="ComissaoCorum" class="custom-select" id="inputGroupSelect02" required>
                                        <option value="unanimidade">   unanimidade </option>
                                        <option value="maioria"> maioria </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <span> <strong> Condição desta Deliberação.: </strong>  </span>
                                    <select name="Condicao" class="custom-select" id="inputGroupSelect02" required>
                                        <option value="Apreciado">    Apreciado   </option>
                                        <option value="Relatado">     Relatado    </option>
                                        <option value="Postergado">   Postergado  </option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="eProtocolo" value=" {{ $value->eProtocolo }} ">


                            <div class="row" align="center" style="position:relative; top: 15px;">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url="">
                                        <i class="fa fa-gavel"></i> Gerar Deliberação. 
                                    </button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                    <!-- card body -->
                </div> 
                <!-- card card-default -->
            @endforeach

            @else   
                <small style="color:gray;"> <i class="far fa-times-circle"></i> Não há pedidos postergados. </small>
        @endif
    </div> <!-- scrool_grid_salavotacao -->
    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
 
     <!-- @ Script's @  -->
     <script>
        var state = false;
        var different = null;
        function moreInfo(i, e){
            var cn = document.getElementsByClassName(i);
            if(state && cn != different){
                $(cn).slideUp("slow");
                cn = false;
                different = false;
            }
            if(state == false || cn != different){
                $(cn).slideDown("slow");
                state = true;
                different = cn;
            }else{
                $(cn).slideUp("slow");
                state = false;
                different = cn;
            }
            // if(){
            // }
            // $(this).slideDown("slow");
        }//moreInfo()
    </script>
    <!-- @ Script's @  -->

    <br>

@endsection