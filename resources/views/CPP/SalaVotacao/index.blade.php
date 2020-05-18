@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')

@section('content')
    @if(isset($allLastDeliberPostergados))
        <section style="margin-top: -50px; margin-bottom: 20px;"> 
            <i class="far fa-clock" style="font-size: 22px; color:orangered; "> </i>
            <span style="font-family: 'Montserrat', sans-serif;"> {{$allLastDeliberPostergados}} pedidos *Postergados*. </span>
        </section>
    @endif

    @if(isset($relatados) && count($relatados) > 0)
        <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
        <section style=" display:flex; background: white; border-radius: 3px; box-shadow: 0px 0px 4px 2px #c4c4c4; " >
            <div class=" " style="margin-left: 15px; width:calc(100%/6); max-height:auto;">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[0]))
                        <a style="color: cian; font-size: 12px;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[0]->id ])}} ">
                            {{$searchall[0]->name}}
                        </a>
                        @else   "NÃO HÁ RELATOR
                    @endif
                </span>
            </div>


            <div class=" " style="width:calc(100%/6); max-height: 58px;">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[1]))
                        <a style="color: cian; font-size: 12px;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[1]->id ])}} ">
                            {{$searchall[1]->name}}
                        </a>
                        @else   "NÃO HÁ RELATOR"
                    @endif
                </span>

            </div>



            <div class=" " style="width:calc(100%/6); max-height: 58px;">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[2]))
                        <a style="color:cian; font-size: 12px;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[2]->id ])}} ">
                            {{$searchall[2]->name}}
                        </a>

                        @else   "NÃO HÁ RELATOR"

                    @endif
                </span>
            </div>
 

            <div class=" " style="width:calc(100%/6); max-height: 58px; ">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[3]))
                        <a style="color: cian; font-size: 12px;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[3]->id ])}} ">
                            {{$searchall[3]->name}}
                        </a>
                        @else   "NÃO HÁ RELATOR"
                    @endif
                </span>
            </div>



            <div class=" " style="width:calc(100%/6); max-height: 58px;">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[4]))
                        <a style="color:cian; font-size: 12px;" href="{{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[4]->id ])}} ">
                            {{$searchall[4]->name}}
                        </a>
                        @else   "NÃO HÁ RELATOR"
                    @endif
                </span>
            </div>
 

            <div class=" " style="width:calc(100%/6); max-height: 58px;">
                <i class="far fa-user-circle"></i>
                <span style="margin-top: -10px; cursor: pointer;"  >
                    @if(isset($searchall[5]))
                        <a style="color:cian; font-size: 12px;" href=" {{ route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[5]->id ]) }} ">
                            {{$searchall[5]->name}}
                        </a>
                        @else   "NÃO HÁ RELATOR"
                    @endif
                </span>
            </div>
        </section>

        <!-- @ @ -->
        @else
            <div class="row" align="center" style="height: 18px;">
                <div class="col-sm-12">  <i style=" font-size: 50px; color: #eaeaea;" class="fas fa-history"></i>   </div>
                <div class="col-sm-12">  <i style=" font-size: 250px; color: #eaeaea;" class="fas fa-couch"></i>   </div>
                <div class="col-sm-12">  <strong> <small style="color: #c4c4c4;"> <h5> Não há deliberações para serem votadas no momento ! </h5> </small> </strong>   </div>
            </div>
    @endif

    
    <section style="width: 100%; height: auto; margin-top: 10px;">
        <div class="card text-center" style="height: auto;">
            <div class="card-footer text-muted">
                <form action="{{route('cpp.salavotacao.store')}}" method="post">
                    @csrf 
                    <div class="form-group" style="display: flex; position: relative;">
                        <input type="text" class="form-control" name="numeProtocolo" id="numeProtocolo" placeholder="eProtocolo" required>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>



    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
        <div class="scrool_grid_salavotacao" style="position:relative; top: 0px; max-height: 600px; ">
            @if(isset($relatados))
                @foreach($relatados as $key => $value)
                    <div class="card card-default_sa" style=" ">
                        <div class="card-header">
                            <!-- @ SESSÃO QUAL RELATOR  @ -->
                            <div class="row"  style="height: 18px;">
                                <div class="col-sm-9" style=" position:relative;  cursor: pointer;">
                                    <a href="#" style=" " id="{{$value->eProtocolo}}" onclick="moreInfo(this.id)" > <u>  Mais informações </u> </a>
                                    <a href="{{route('cpp.salavotacao.index')}}" style="margin-left: 35px;"> <u> Todos </u> </a>
                                    <a href="#" style="margin-left: 35px;"> <u style="color: magenta;"> Total: {{count($relatados)}} </u> </a>
                                </div>
                            </div>
                            <!-- @ @ -->
                        </div>

                        <div class="card-body" style="position: relative; top: -20px;">
                            <form action=" {{route('cpp.salavotacao.create')}} " method="put" >
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
                                    <div class="col-md-4 form-group">
                                        {{ Form::label('PEDIDO', 'PEDIDO', array('class' => 'awesome')) }}
                                        {{ Form::text('eProtocolo', null, array('class'=>'form-control', 'placeholder'=>$value->pedido, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('STATUS', 'RG', array('class' => 'awesome')) }}
                                        {{ Form::text('STATUS', null, array('class'=>'form-control', 'placeholder'=>$value->status, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
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

                                <br>

                                <div class="row" align="center">
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-gavel"></i> Gerar Deliberação. </button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- card body -->

                         <!-- Cortina que contem mais informações -->
                        <section id="" class="{{$value->eProtocolo}}" value="false" name="" style=" width: 100%; height:auto; position: absolute; top: 40px; display: none;">
                            <div style=" width: 100%; height: 370px; background-color: whitesmoke; position: absolute; top: 0px; text-align: center; " >
                                <h5 style="color: cadetblue;"> Relator: </h5> {{$value->name}}
                                <h5 style="color: cadetblue;"> Parecer do relator: </h5> 
                                <textarea style="width: 100%; border: none;" rows="4" readonly> {{$value->parecer_relator}} </textarea>
                                <h5 style="color: cadetblue;"> ID responsável pelo cadastro: </h5> {{$value->id_responsavel_cadastro}}
                            </div>
                        </section> 
                        <!-- Cortina que contem mais informações -->

                    </div> <!-- card card-default -->

                    <hr>  

                @endforeach
            @endif
        </div>
    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->

    <section>
        @if(session('excedeu'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-info-circle"></i>
                Info ! Exced ATA.: Não há ATA aberta no momento. Nenhuma ATA aberta pelo Presidente ainda ! <br>
                Sem ATA aberta não é possível prosseguir com a Deliberação !
            </div>
        @endif


        @if(session('is_not_has_president_or_secretary') == 'exxced')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-info-circle"></i>
                Info ! Is_Not_Has_President_or_Sercretary.: Não foi possível gerar deliberção, pois não há secretário ou presidente ativos.
            </div>
        @endif

        @if(isset($emptyrelatados))
            @if($emptyrelatados == false)
                <div class="alert alert-danger" role="alert">
                    Nada encontrado para este relator.
                </div>
            @endif
        @endif

    </section>



    <!-- @ Script's @  -->
    <script>
        function moreInfo(e){
            var cn = document.getElementsByClassName(e); 
            if(cn[0].getAttribute('value') == 'false'){
                var r = $(cn).slideDown();
                cn[0].setAttribute('value', true);
            }else{
                var r = $(cn).slideUp();
                cn[0].setAttribute('value', false);
            }
            console.log(cn);
            console.log(r);
        }//moreInfo()
    </script>
    <!-- @ Script's @  -->

@endsection
