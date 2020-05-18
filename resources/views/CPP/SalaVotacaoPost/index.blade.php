@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')

@section('content')
    <section style="width: 100%; height: auto;"> 
        <div class="alert alert-dark" align="center" >
            <span style="color: white;  font-family: 'Montserrat', sans-serif;"> <strong> <u> Deliberações Postergadas </u> </strong> </span>    
        </div>   
    </section>


   <div class="scrool_grid_salavotacao" style="position:relative; top: 0px; max-height: 600px; ">
        @if(isset($allLastDeliberPostergados))
            @foreach($allLastDeliberPostergados as $key => $value)
                <div class="card card-default_sa" style=" ">
                    <div class="card-header">
                        <!-- @ SESSÃO QUAL RELATOR  @ -->
                        <div class="row"  style="height: 18px;">
                            <div class="col-sm-9" style=" position:relative; left: 20px; cursor: pointer;">
                                <i class="fas fa-bars _more_info "  id="_more_info{{$key}}" onclick="moreInfo(this.id, event)" >  </i> <span style="margin-left: 15px;"> <u>  Mais informações </u> </span>
                            </div>
                        </div>
                        <!-- @    @ -->
                    </div>

                    <div class="card-body" style="position: relative; top: -20px;">
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
                                    <textarea readonly name=contain_ddeliber class=form-control rows='4' value="{{$value->conteudo}}"  > {{$value->conteudo}} </textarea>
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

                            <br>

                            <div class="row" align="center">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-gavel"></i> Gerar Deliberação. </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- card body -->
                </div> <!-- card card-default -->

                <hr> 

                <!-- Cortina que contem mais informações -->
                <!-- <section id="courtain_more_info" class="_more_info{{$key}}" name="_more_info" style=" width: 100%; height:auto; position: absolute; top: 50px; display: none;">
                    <div style=" width: 100%; height: 100%; background: black; opacity: 0.9; " >  </div>

                    <div style=" width: 100%; height:auto; position: absolute; top: 0px; " >
                        <table class="table table-bordered table-dark" style="background: cian; ">
                            <thead>
                                <tr>
                                    <th scope="col" style="color: #367fa9;">  Relator.:  </th>

                                    <th scope="col">  -----. </th>

                                    <th scope="col" style="color: #367fa9;">  Optou por.: </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <th scope="row" style="color: #367fa9;"> Parecer do Relator.:  </th>
                                    <td style="text-align: justify;">
                                        ---.
                                    </td>

                                    <td >
                                        ----.
                                    </td>
                                <tr>

                                <tr>
                                    <th scope="row" style="color: #367fa9;"> ID_Membro.:  </th>

                                    <td>
                                        -----.
                                    </td>
                                <tr>
                            </tbody>
                        </table>


                        <table class="table table-bordered table-dark" style="background: cian; ">
                            <thead>
                                <tr>
                                    <th scope="col" style="color: #367fa9;">  Responsável pelo Cadastro.:  </th>

                                    <th scope="col">  fghrhrehre hrh rehrehrehre rhe reherhre reh. </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <th scope="row" style="color: #367fa9;"> ID.:  </th>
                                    <td style="text-align: justify;">
                                    -----.
                                    </td>
                                <tr>
                            </tbody>

                        </table>
                    </div>
                </section> -->
                <!-- Cortina que contem mais informações -->
            @endforeach
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