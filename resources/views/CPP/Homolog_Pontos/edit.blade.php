@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')

    
    <div class="card text-center"> 
        <div class="card card-header" style="background: white; height: 65px;;" align="center">
            <div class="container">
                <div class="row">
                    <div class="col-sm" style="background: transparent;">
                        <div class="form-group col-8" style="display: flex; float: left; position: relative;">
                            <input style="height: 30px;" type="text" class="form-control" id="inputPassword2" placeholder="RG | Nome | e-Protocolo">
                            &nbsp<button type="submit" class="btn btn-primary mb-2"><i style="font-size: 18px;" class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-sm" align="center">
                        <h5 style="width: 100%; height: auto; color: #009acd;"> <span> Últimos cadastrados. <br> <small>  Pontos positivos. <i class="fas fa-graduation-cap"></i> </small> </span> </h5>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <span style="position: relative; top: 10px; color: dark;"> Total: {{count($homologP)}} </span>
                    </div>
                </div>
            </div>
        </div>    

        <form action="/cpp/editPontos" method="post">
            @csrf
            <table class="table">
                <thead align="center">
                    <tr align="center">
                        <th scope="col">eProtocolo.     </th>
                        <th scope="col">Grupo.          </th>
                        <th scope="col">RG.             </th>
                        <th scope="col">Inciso.         </th>
                        <th scope="col">Data do cadastro.  </th>
                        <th scope="col"> Visualizar <i class="far fa-eye"></i>  </th>
                    </tr>
                </thead>
                
                <tbody align="center">
                    @foreach($homologP as $key => $value)
                        <tr align="center">
                            <td> 
                                <a href="/cpp/storedHomologP?eProtocolo={{$value->eProtocolo}}"> {{$value->eProtocolo}} </a> 
                            </td>
                            <td>{{$value->distincao}}   </td>
                            <td>{{$value->id_policial}} </td>
                            <td>{{$value->key_inciso}}  </td>
                            <td>{{$value->created_at}}  </td>
                            <td> 
                                <a href="/cpp/storedHomologP?eProtocolo={{$value->eProtocolo}}"> 
                                    <button type="button" class="btn btn-primary"> 
                                        <i class="far fa-eye"></i> 
                                    </button> 
                                </a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if(isset($value->eProtocolo))
                <input type="hidden" name="eProtocolo" value="{{$value->eProtocolo}}">
            @endif

        </form>
    </div>

    <br>
    
    <script>

    </script>
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection
