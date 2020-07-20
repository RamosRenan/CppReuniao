@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')

@section('content')

   <div class="scrool_grid_salavotacao" style=" max-height: 500px; ">
        @if(isset($allLastDeliberPostergados) && count($allLastDeliberPostergados) > 0)
            @foreach($allLastDeliberPostergados as $key => $value)
                <div class="card card-default_sa" style=" ">
                    <div class="card-header">
                        <!-- @ SESSÃO QUAL RELATOR  @ -->
                        <div class="row"  style="height: 18px; text-align:center;">
                            <div class="col-sm-11" style=" position:relative; left: 20px; cursor: pointer;">
                                <!-- <i class="fas fa-bars _more_info "  id="_more_info{{$key}}" onclick="moreInfo(this.id, event)" >  </i>  -->
                                <span style="color: cian;  font-family: 'Montserrat', sans-serif; ">  <u> Deliberações Postergadas </u>  </span>    
                            </div>
                        </div>
                        <!-- @ SESSÃO QUAL RELATOR  @ -->
                    </div>

                    <!-- @ card-body  @ -->
                    <div class="card-body" style="position: relative; top: -20px; height:auto;" align="center">
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

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBox" data-url="">
                                        <i class="fa fa-search"></i> Mais info. 
                                    </button>   
                                </div>
                            </div>

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

@endsection