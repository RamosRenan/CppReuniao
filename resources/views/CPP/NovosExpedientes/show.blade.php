@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">

@yield('content')

@section('content')
    @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
     <!-- card-header --> 
     <div class="card">
        <div class="card-header" align="center" style="height: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                         
                    </div>
                    <div class="col-sm">
                        <h5> 
                            <i class="fas fa-project-diagram"></i>  
                            &nbsp Sorteio para novos expedietes <br>
                            <small style="font-size: 13px;"> Todos os eProtocolos a serem distribuídos estão listados aqui. </small>
                        </h5>
                    </div>
                    <div class="col-sm" align="right">
                        Total encontrado: {{count($tot)}}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- card-header --> 
    @endif

    <div class="scrool_grid" style="position: relative; top: -10px; height: 400px; overflow-y: scroll;" >
            @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
                @foreach($tot as $key)
                <div class="card card-default" style="">
                    <!-- barra contem os relatores -->                     
                        <div class="card-body">
                            {{ Form::open() }}
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        {{ Form::label('Nome', 'Nome', array('class' => 'awesome', 'id'=>'piu' )) }}
                                        {{ Form::text('NOME', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->nome, 'value'=>$key->nome)) }}

                                    </div>
                                    <div class="col-md-3 form-group">
                                        {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->unidade, 'value'=>$key->unidade )) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('GRADUACAO', 'GRADUAÇÃO', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('GRADUACAO', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->graduacao, 'value'=>$key->graduacao)) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('CPF', 'CPF', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('CPF', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->cpf, 'value'=>$key->cpf )) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('RG', 'RG', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('RG', null, array('class'=>'form-control', 'readonly', 'placeholder'=>$key->rg, 'value'=>$key->rg )) }}

                                    </div>
                                </div>

                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'readonly',  'placeholder'=>$key->unidade, 'value'=>$key->unidade )) }}
                                    </div>

                                    <div class="form-group col-md-6" align="center">
                                        <ul class="navbar-nav justify-content-center" style="width: 100%;">
                                            <li class="nav-item dropdown">
                                                <br>
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Escolha o relator à designar esta deliberação.
                                                </a>
                                                <!-- dropdown-menu" -->
                                                <div style="width: 100%; height: auto; text-align: center;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a style="background: #495057;" class="dropdown-item card" href="#" align="center">             
                                                        <h5 class=" "  style="color: white; "  >
                                                            <i style="font-size: 28px;" class="far fa-user-circle"></i> &nbsp &nbsp
                                                            Selecione o relator para designar esta deliberação. 
                                                        </h5>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                
                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[0]))
                                                            <a class="badge badge-secondary"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[0]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 1.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[1]))
                                                            <a class="badge badge-primary"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[1]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 2.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[2]))
                                                            <a class="badge badge-success"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[2]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 3.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[3]))
                                                            <a class="badge badge-warning"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[3]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 4.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[4]))
                                                            <a class="badge badge-danger"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[4]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 5.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-item" href="#" align="center">             
                                                        @if(isset($searchall[5]))
                                                            <a class="badge badge-dark"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                                <i class="fas fa-user"></i> &nbsp {{$searchall[5]->name}}  
                                                            </a>
                                                            @else 
                                                                <i class="fas fa-user-slash"></i> 
                                                                &nbsp Não há relator 6.
                                                        @endif
                                                    </span>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                                <!-- dropdown-menu" -->
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- drop menu -->
                                </div>
                                <!-- row -->


                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('eProtocolo', 'eProtocolo', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('eProtocolo', null, array('class'=>'form-control', 'readonly','placeholder'=>$key->eProtocolo, 'value'=>$key->eProtocolo )) }}

                                    </div>
                                    <div class="col-md-4 form-group">
                                        {{ Form::label('PEDIDO', 'PEDIDO', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('PEDIDO', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->pedido, 'value'=>$key->pedido )) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('STATUS', 'Status', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('STATUS', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->status, 'value'=>$key->status )) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('DATA_ENTRADA', 'ENTRADA', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('DATA_ENTRADA', null, array('class'=>'form-control', 'readonly','placeholder'=>$key->entry_system_data, 'value'=>$key->entry_system_data )) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('DATA_DO_EPROTOCOLO', 'DATA ePROTOCOLO', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::text('DATA_DO_EPROTOCOLO', null, array('class'=>'form-control','readonly', 'placeholder'=>$key->data_eProtocolo, 'value'=>$key->data_eProtocolo )) }}

                                    </div>
                                </div>
                                <!-- row -->

                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome', 'id'=>'piu')) }}
                                        {{ Form::textarea('CONTEUDO', null, array('class'=>'form-control', 'rows'=>'2','readonly', 'placeholder'=>$key->conteudo, 'value'=>$key->conteudo)) }}
                                    </div>
                                </div>
                                <!-- row -->
                            {{ Form::close() }}
                        </div>
                        <!-- card-body --> 
                    </div> 
                    <!-- card card-header -->
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
                        <h4 style="color:lightslategray;">  
                            <i class="fas fa-hourglass-half"></i> <br> <br>
                            Aviso ! <br> Não há pedidos a serem sorteados. <br> 
                            <small style="font-size: 14px;"> Talvez procurar por período, quantidade, ou pedido. </small> <br> <br>
                            <div class="col-sm-2 form-group" align="center">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                                    <i class="fa fa-address-card" aria-hidden="true"></i> <i class="far fa-chart-bar"></i> &nbsp Visualizar eProtocolos distribuídos, <b> Relatório </b>. 
                                </button>
                            </div><br>
                            <span> <small> <i class="fas fa-info-circle"></i> &nbsp Relatório estará disponínel na seguinte condição. Se Ata estiver aberta. </small> </span>
                        </h4>
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


            <div class="row" align="center">
                @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
                <div class="col-sm-1 form-group" align="center">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                        <i class="fa fa-address-card" aria-hidden="true"></i> Sortear Auto. 
                    </button>
                </div>
                

                <div class="col-sm-1 form-group" align="center">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                        <i class="fa fa-address-card" aria-hidden="true"></i> Para esta reunião. 
                    </button>
                </div>

                <div class="col-sm-1 form-group" align="center">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                        <i class="fa fa-address-card" aria-hidden="true"></i> <i class="far fa-chart-bar"></i> &nbsp Relatório. 
                    </button>
                </div>

                <div class="col-sm-4 " style=" "> </div>
                @endif

            </div>
            

        </form>
    </section>


@endsection
