@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')
    
    <div class="card text-center">
        <div class="card-footer text-muted">
            Últimos cadastrados.<br>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: scroll;">
            <form action="/cpp/editPontos" method="post">
                @csrf

                <table class="table">
                    <thead align="center">
                        <tralign="center">
                            <th scope="col">eProtocolo.     </th>
                            <th scope="col">Grupo.          </th>
                            <th scope="col">Rg.             </th>
                            <th scope="col">Inciso.         </th>
                            <th scope="col">Data cadastro.  </th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach($homologP as $key => $value)
                            <tr align="center">
                                <td> <a href="#"> {{$value->eProtocolo}} </a> </td>
                                <td>{{$value->distincao}}   </td>
                                <td>{{$value->id_policial}} </td>
                                <td>{{$value->key_inciso}}  </td>
                                <td>{{$value->created_at}}  </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(isset($value->eProtocolo))
                <input type="hidden" name="eProtocolo" value="{{$value->eProtocolo}}">
                @endif
            </form>
        </div>
        <div class="card-footer text-muted">
            Pontos positivos.
        </div>
    </div>
  
    <script>

    </script>
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection
