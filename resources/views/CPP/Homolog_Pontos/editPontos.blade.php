@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')
    
    <div class="card text-center">
        <div class="card-footer text-muted">
            Alterar Pontos positivos.
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: scroll;">
            @if(isset($getHomolog))
            <form action="/cpp/efetiveAlterPontos" method="post">
                @csrf
                <input type="hidden" name="eProtocolo" value="{{$getHomolog[0]->eProtocolo}}"> 
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" style="font-weight: lighter; float: left;" > Texto. ooo </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="newTexto" rows="3">
                        {{$getHomolog[0]->contain_oficial_homolocao}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-warning">Alterar.</button>
            </form>
            @endif
        </div>
        <div class="card-footer text-muted">
            Alterar Pontos positivos.
        </div>
    </div>

    @if(isset($success))
    <div class="alert alert-success" role="alert">
        Alterado com sucesso;
    </div>
    @endif
  
    <script>

    </script>
    <!-- @ Contain todas as funcoes scripts @ -->

@endsection
