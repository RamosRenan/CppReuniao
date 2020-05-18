@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section style="text-align: center;">
        <h3> <i class="fas fa-file-word"></i> Atas encontradas. </h3>
        <h5 style="color: magenta;"> 
            @if(isset($allAtas) && count($allAtas) > 0)
                Total: {{count($allAtas)}}
            @endif
        </h5>
    </section>

    <br>

    <section style="" align="center">
        @if(isset($allAtas) && count($allAtas) > 0)
            @foreach($allAtas as $key => $value)
                <a href="{{route('cpp.findata.edit',$value->id)}}" style="font-size: 20px; margin-left: 12px;"> 
                    <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i> &nbsp;
                    <u> 
                        <strong> Nome do Arquivo: </strong> {{$value->name}}
                        <strong> Data de envio: </strong> {{$value->created_at}}
                        <strong> Tamanho: </strong> {{$value->size}}
                        <strong> Id reponsável por enviar: </strong> {{$value->responsavel}}
                    </u>
                </a>
                <br>
                <br>
            @endforeach
        @endif
    </section>

@endsection