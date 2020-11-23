@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')

    <div class="card"> 
        <div class="card-header" style=" "> 
            <div class="row">
                <div class="col-sm">
                    <h5> 
                        &nbsp; Protocolos com este relator <br/>
                        <small> &nbsp; Relator: {{ $relator }} </small>
                    </h5>
                </div>

                <div class="col-sm"> </div>

                <div class="col-sm" align="right">
                    <h5> 
                        @if(isset($Usorteados) && count($Usorteados)>0)
                            Total: {{count($Usorteados)}} 
                            @else 
                                Total:0
                        @endif
                    </h5>
                </div>
            </div>
        </div>

        <div class="card-body"> 
            @if(isset($Usorteados) && count($Usorteados)>0)
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <th scope="col">eProtocolo          </th>
                        <th scope="col">Nome                </th>
                        <th scope="col">RG                  </th>
                        <th scope="col">Cpf                  </th>
                        <th scope="col">Unidade             </th>
                        <th scope="col">Pedido              </th>
                        <th scope="col">Condição            </th>
                        <th scope="col"> <i class="fas fa-paperclip"></i>&nbsp Anexo     </th>
                        <!-- <th scope="col"> <i class="fas fa-paste"></i> &nbsp Relatório    </th> -->
                    </tr>
                </thead>

                <tbody>
                    @foreach($Usorteados as $key)      
                    <tr align="center">
                        <td scope="row"> <a href="#"> {{$key->eProtocolo}} </a> </td>
                        <td>{{$key->nome}}      </td>
                        <td>{{$key->rg}}        </td>
                        <td>{{$key->cpf}}        </td>
                        <td>{{$key->unidade}}   </td>
                        <td>{{$key->pedido}}    </td>
                        <td> 
                            <span style="color: green">Sorteado</span> 
                        </td>
                        <td> 
                            <button type="button" class="btn btn-outline-dark"> 
                                <a href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo, 'cpf'=>$key->cpf]) }}"> <i class="fas fa-paperclip"></i> </a>    
                            </button>   
                        </td>
                        <!-- <td> 
                            <button type="button" class="btn btn-outline-info"> 
                                <a href="#"> <i class="fas fa-paste"></i> </a>    
                            </button>   
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>  
                <!-- tbody -->
            </table>

                @else
                    <h5> <i class="fas fa-ban"></i> &nbsp Nada encontrado para este relator </h5>

            @endif
        </div>
        <!-- card-body -->

        <div class="card-footer"> </div>

    </div>
     
@endsection