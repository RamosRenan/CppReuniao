@extends('layouts.app')

@yield('content_header')
    <script src="https://code.jquery.com/jquery-3.4.1.js"> </script> 
@yield('content')

@section('content')    
        <!-- card -->
        <div class="card">
            <form method="PUT" action="route('cpp.cadastroE-protocolo.show', 0)"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- card-header -->
                <div class="card-header">
                    <div class="row" style=" ">
                        <div class="col-4" style="">
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" NAME="search_pedido" placeholder="'  RG | CPF | NOME | N° eProtocolo  ' " style=" background: white; max-width: 430px; ">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-4" align="center"> 
                            <h4> <i class="far fa-address-card"></i> &nbsp Protocolos Cadastrados </h4>
                        </div>

                        <div class="col-4" align="center">
                            <h5 style="float: right; color: #364fc7;"> <small> Total cadastrados. <br>  <i class="fas fa-inbox"> {{count($Police_Together_eProtocolo)}} </i> </small> </h5>
                        </div>
                    </div>       
                </div>
                <!-- card-header -->

                <!-- card-body -->
                <div class="card-body" style="max-height: 460px; overflow-y: scroll; background-color:white;">
                    <table class="table">
                        <thead style="">
                            <tr style=" color:black;">
                                <th scope="col" style="">
                                    nome 
                                </th>

                                <th scope="col" style=""> 
                                    rg 
                                </th>

                                <th scope="col" style="">
                                    cpf                     
                                </th>

                                <th scope="col" style="">
                                    eProtocolo                     
                                </th>

                                <th scope="col" style="">
                                    unidade                     
                                </th>

                                <th scope="col" style="">
                                    graduação                     
                                </th>

                                <th scope="col" style="">
                                    pedido                     
                                </th>

                                <th scope="col" style="">
                                    status                         
                                </th>

                                <th scope="col" style="" >
                                    cadastro                         
                                </th>

                                <th scope="col" style="">
                                    descricao.                       
                                </th>
                                <th scope="col" style="">
                                    editar.                         
                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($Police_Together_eProtocolo as $key => $value)
                                @if(isset($Police_Together_eProtocolo))
                                    <tr>
                                        <td> {{ $value->nome }}                </td>
                                        <td> {{ $value->rg }}                  </td>
                                        <td> {{ $value->cpf }}                 </td>
                                        <td> {{ $value->eProtocolo }}          </td>
                                        <td> {{ $value->unidade }}             </td>
                                        <td> {{ $value->graduacao }}           </td>
                                        <td> {{ $value->pedido }}              </td>
                                        <td> {{ $value->status }}              </td>
                                        <td align="center"> {{ $value->entry_system_data }}  </td>    
                                        <td align="center"> 
                                            <i style="cursor:pointer;" onclick="slideDescription(this)" id="{{$key}}" class="far fa-list-alt"></i> 
                                        </td>
                                        <td align="center"> 
                                            <a style="  "  href="{{ route('cpp.cadastroE-protocolo.edit', $value->cpf ) }}"> 
                                                <i class="fas fa-edit" style="color: #36a2eb; cursor: pointer; font-size: 19px; "></i>             
                                            </a> 
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="11" type="hidden" id="description{{$key}}" class="description{{$key}}" style="border: solid 1px #38afff; box-shadow: 0px 0px 4px 2px #a8a8a8; display:none;">
                                            {{  $value->conteudo }}
                                        </td>
                                    </tr>   
                                @endif
                            @endforeach
                        </tbody>  
                    </table>
                </div>
                <!-- card-body -->
            </form> 
        </div>
        <!-- card -->


        <script type="text/javascript"> 
            let element;
            var ControllerUpDown = false;   
            function slideDescription(element){
                var description = document.getElementById("description"+element.id);
                if(ControllerUpDown == false){
                    $(description).slideDown();
                    ControllerUpDown = true;
                    console.log("é false");
                }else{                                      
                    if(ControllerUpDown){
                        $(description).slideUp();
                        ControllerUpDown = false;
                        console.log("é true");
                    }
                }
            }
        </script>

@endsection


