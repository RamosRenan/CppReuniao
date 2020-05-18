@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
@yield('content')

@section('content')
     
    <div class="scrool_grid" style="position: relative; top: -10px;" >
            @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
            @foreach($tot as $key)
            <div class="card card-default">
                <div class="card-footer text-muted" align="center">
                    <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
                    <section style="margin-top: 10px; display:flex; height: 30px;" >
                            <div class="col-lg-0 col-2" >
                                <div class=" " >
                                    <div class=" " style="max-height: auto;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[0]))
                                                <a style="color:cian;" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[0]->name}} </u>
                                                </a>
                                                @else <i class="fas fa-user-slash"></i> Não há relator 6.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-0 col-2" >
                                <div class=" " >
                                    <div class=" " style="max-height: 58px;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[1]))
                                                <a style="color:cian ;" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[1]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[1]->name}} </u>
                                                </a>
                                                @else <i class="fas fa-user-slash"></i> Não há relator 6.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-0 col-2" >
                                <div class=" " >
                                    <div class="" style="max-height: 58px;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[2]))
                                                <a style="color:cian;" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[2]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[2]->name}} </u>
                                                </a>

                                                @else  <i class="fas fa-user-slash"></i> Não há relator 6.

                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-0 col-2" >
                                <div class=" " >
                                    <div class=" " style="max-height: 58px;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[3]))
                                                <a style="color:cian;" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[3]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[3]->name}} </u>
                                                </a>
                                                @else <i class="fas fa-user-slash"></i> Não há relator 6.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-0 col-2" >
                                <div class="" >
                                    <div class=" " style="max-height: 58px; text-align:center;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[4]))
                                                <a style="color:cian;" href="{{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[4]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[4]->name}} </u>
                                                </a>
                                                @else <i class="fas fa-user-slash"></i> Não há relator 6. 
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-0 col-2" align="center" >
                                <div class=" " >
                                    <div class="" style="max-height: 58px; text-align:center;" align="center">
                                        <p style="margin-top: -10px; cursor: pointer;"  >
                                            @if(isset($searchall[5]))
                                                <a style="color:cian;" href=" {{ route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[5]->id, 'numero_sid'=>$key->eProtocolo]) }} ">
                                                    <i class="fas fa-user"></i> <u> {{$searchall[5]->name}} </u>
                                                </a>
                                                @else <i class="fas fa-user-slash"></i> Não há relator 6.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
                <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->





                <div class="card-body">
                    {{ Form::open() }}
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {{ Form::label('NOME', 'NOME', array('class' => 'awesome')) }}
                            {{ Form::text('NOME', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->nome, 'value'=>$key->nome)) }}

                        </div>
                        <div class="col-md-3 form-group">
                            {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome')) }}
                            {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->unidade, 'value'=>$key->unidade )) }}

                        </div>
                        <div class="col-md-2 form-group">
                            {{ Form::label('GRADUACAO', 'GRADUAÇÃO', array('class' => 'awesome')) }}
                            {{ Form::text('GRADUACAO', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->graduacao, 'value'=>$key->graduacao)) }}

                        </div>
                        <div class="col-md-2 form-group">
                            {{ Form::label('CPF', 'CPF', array('class' => 'awesome')) }}
                            {{ Form::text('CPF', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->cpf, 'value'=>$key->cpf )) }}

                        </div>
                        <div class="col-md-2 form-group">
                            {{ Form::label('RG', 'RG', array('class' => 'awesome')) }}
                            {{ Form::text('RG', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->rg, 'value'=>$key->rg )) }}

                        </div>

                    </div>




                    <div class="row">
                        <div class="col-md-12 form-group">
                            {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome')) }}
                            {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->unidade, 'value'=>$key->unidade )) }}
                        </div>

                    </div>





                    <div class="row">
                        <div class="col-md-2 form-group">
                        {{ Form::label('eProtocolo', 'eProtocolo', array('class' => 'awesome')) }}
                            {{ Form::text('eProtocolo', null, array('class'=>'form-control', 'readonly','placeholder'=>$key->eProtocolo, 'value'=>$key->eProtocolo )) }}

                        </div>
                        <div class="col-md-5 form-group">
                        {{ Form::label('PEDIDO', 'PEDIDO', array('class' => 'awesome')) }}
                            {{ Form::text('PEDIDO', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->pedido, 'value'=>$key->pedido )) }}

                        </div>
                        <div class="col-md-2 form-group">
                        {{ Form::label('STATUS', 'RG', array('class' => 'awesome')) }}
                            {{ Form::text('STATUS', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->status, 'value'=>$key->status )) }}

                        </div>
                        <div class="col-md-1 form-group">
                        {{ Form::label('DATA_ENTRADA', 'ENTRADA', array('class' => 'awesome')) }}
                            {{ Form::text('DATA_ENTRADA', null, array('class'=>'form-control', 'readonly','placeholder'=>$key->entry_system_data, 'value'=>$key->entry_system_data )) }}

                        </div>
                        <div class="col-md-2 form-group">
                        {{ Form::label('DATA_DO_EPROTOCOLO', 'DATA ePROTOCOLO', array('class' => 'awesome')) }}
                            {{ Form::text('DATA_DO_EPROTOCOLO', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->data_eProtocolo, 'value'=>$key->data_eProtocolo )) }}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                        {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome')) }}
                            {{ Form::textarea('CONTEUDO', null, array('class'=>'form-control', 'rows'=>'2','readonly', 'placeholder'=>$key->conteudo, 'value'=>$key->conteudo)) }}

                        </div>
                    </div>



                    <br>


                    {{ Form::close() }}

                </div>

            </div> <!-- card card-default -->

            @endforeach

                @else


                    @if( isset($succes))
                        @if($succes == "succes")
                            <div class="alert alert-success">
                                <strong>Info!</strong>   Success - SALVO COM SUCESSO.
                            </div>
                        @endif
                    @endif


                    <div style="width: 100%; height: auto;" align="center">
                        <h4 style="color:lightslategray;"> Aviso ! Não há pedidos a serem sorteados. <br> <small style="font-size: 14px;"> Talvez procurar por período, quantidade, ou pedido. </small> </h4>
                    </div>
            @endif

    </div>
    <!-- @ SESSÃO CONTEM scrool GRID @ -->


    <section style="position: relative; top:0px;">
        <form method="PUT" action="{{route('cpp.novosexpedientes.edit', 0)}}">

            @if(isset($tot))
                @for($i = 0; $i < count($tot); $i++)
                    <input type="hidden" name="object{{$i}}"  value="{{ $tot[$i]->eProtocolo }}">
                @endfor
            @endif


            @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
            <div class="row" align="center" >
                <div class="col-4 "> </div>

                <div class="col-2 form-group">
                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                        <i class="fa fa-address-card" aria-hidden="true"></i> Sortear Auto. 
                    </button>
                </div>

                <div class="col-2 form-group">
                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                        <i class="fa fa-address-card" aria-hidden="true"></i> Sortear para esta reunião. 
                    </button>
                </div>

                <div class="col-2 "> </div>

            </div>
            @endif

        </form>
    </section>


@endsection
