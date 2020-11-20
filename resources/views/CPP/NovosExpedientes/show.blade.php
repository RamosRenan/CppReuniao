@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">

@yield('content')

@section('content')
    <!-- card --> 
    <div class="card">
        <!-- card-header -->
        <div class="card-header"style=" ">
            <!-- row -->
            <div class="row">
                <div class="col-4"> 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nome | RG | eProtocolo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <button style="max-height: 20px; border:none;" type="button" class="btn btn-outline-secondary"> <span style="position:relative; top: -8px;"> Buscar </span></button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-4" align="center" >
                    <h5> 
                        Sorteio de novos expedietes 
                        <br>
                        <small style="font-size: 13px;"> 
                            Todos os eProtocolos a serem distribuídos estão listados aqui.
                        </small>
                    </h5>
                </div>
                
                <div class="col-4" align="center" >
                    <span style="float: right;"> Total encontrado: <br> 
                        @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
                            <small> <i class="fas fa-inbox"></i> &nbsp {{count($tot)}} </small>
                            @else 
                                0 
                        @endif
                    </span>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- card-header -->

        <!-- card-body -->
        <div class="card-body" style="min-height:230px; max-height: 500px; overflow-y: scroll;"> 
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <th scope="col">eProtocolo      </th>
                        <th scope="col">Nome            </th>
                        <th scope="col">RG              </th>
                        <th scope="col">Graduação       </th>
                        <th scope="col">Unidade         </th>
                        <th scope="col">Pedido          </th>
                        <th scope="col">Designar relator</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- se existe pedidos a serem listados  -->
                    @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
                        @foreach($tot as $key)
                            <tr align="center" style="font-size: 13px;">
                                <th scope="row"> 
                                    <form method="post" action="/cpp/newExpedienteProtocolSelected">
                                        @csrf
                                        <input type="hidden" name="nome"             value="{{$key->nome}}"              />
                                        <input type="hidden" name="unindade"         value="{{$key->unidade}}"           />
                                        <input type="hidden" name="eProtocolo"       value="{{$key->eProtocolo}}"        />
                                        <input type="hidden" name="graduacao"        value="{{$key->graduacao}}"         />
                                        <input type="hidden" name="pedido"           value="{{$key->pedido}}"            />
                                        <input type="hidden" name="cpf"              value="{{$key->cpf}}"               />
                                        <input type="hidden" name="rg"               value="{{$key->rg}}"                />
                                        <input type="hidden" name="dataEntrada"      value="{{$key->entry_system_data}}" />
                                        <input type="hidden" name="dataeProtocolo"   value="{{$key->data_eProtocolo}}"   />
                                        <input type="hidden" name="conteudo"         value="{{$key->conteudo}}"          />
                                        <input type="hidden" name="status"           value="{{$key->status}}"            />
                                        <button type="submit" style="border:none;" >
                                            <u>{{$key->eProtocolo}}</u>
                                        </button>
                                    </form>
                                </th>

                                <td> {{$key->nome}}         </td>
                                <td> {{$key->rg}}           </td>
                                <td> {{$key->graduacao}}    </td>
                                <td> {{$key->unidade}}      </td>
                                <td> {{$key->pedido}}       </td>

                                <!-- Listo todos os relatores que podem ser selecionados -->
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Relatores
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- relator 1 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[0]))
                                                    <a class="badge badge-secondary"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[0]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[0]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 1 -->

                                            <!-- relator 2 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[1]))
                                                    <a class="badge badge-dark"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[1]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[1]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 2 -->

                                            <!-- relator 3 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[2]))
                                                    <a class="badge badge-primary"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[2]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[2]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 3 -->

                                            <!-- relator 4 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[3]))
                                                    <a class="badge badge-success"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[3]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[3]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 4 -->

                                            <!-- relator 5 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[4]))
                                                    <a class="badge badge-info"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[4]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[4]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 5 -->

                                            <!-- relator 6 -->
                                            <button class="dropdown-item" type="button">
                                                @if(isset($searchall[5]))
                                                    <a class="badge badge-warning"  style="color:cian; font-size: 15px;"  href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[5]->id, 'numero_sid'=>$key->eProtocolo])}} ">
                                                        <i class="far fa-user-circle"></i> &nbsp {{$searchall[5]->name}}  
                                                    </a>
                                                    @else 
                                                        <i class="fas fa-user-slash"></i> 
                                                        &nbsp Não há relator 1.
                                                @endif
                                            </button>
                                            <!-- relator 6 -->
                                        </div>
                                    </div>
                                </td>
                                <!-- Listo todos os relatores que podem ser selecionados -->
                            </tr>
                        @endforeach
                        
                        @else
                            <div class="width:100%; height: auto;" align="center"> 
                                <h5> Não há pedidos a serem sorteados </h5> 
                            </div>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- card-body -->

        <form method="PUT" action="{{route('cpp.novosexpedientes.edit', 0)}}">
            @if(isset($tot))
                @for($i = 0; $i < count($tot); $i++)
                    <input type="hidden" name="object{{$i}}"  value="{{ $tot[$i]->eProtocolo }}"> 
                @endfor
            @endif

            <!-- card-footer -->
            <div class="card-footer"> 
                <div class="row" align="center">
                    @if(isset($tot) && !empty($tot) && !count($tot) <= 0)
                        <div class="col-4 " >
                            <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                                <i class="fa fa-address-card" aria-hidden="true"></i> Sortear Auto. 
                            </button>
                        </div>

                        <div class="col-4 " >
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                                <i class="fa fa-address-card" aria-hidden="true"></i> Esta reunião. 
                            </button>
                        </div>

                        <div class="col-4 " >
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""> 
                                <i class="fa fa-address-card" aria-hidden="true"></i> <i class="far fa-chart-bar"></i> &nbsp Relatório. 
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <!-- card-footer -->
        </form>
    </div>
    <!-- card --> 
    <br>
@endsection
