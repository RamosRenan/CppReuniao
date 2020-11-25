@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
    <section style="width: 100%; height:auto;" >
        <br> <br> <br>
        <div style="width:50%; height: auto; margin:auto; text-align: center;">
            <h2> Faça upload da Ata. </h2>
            <br> 
            <!-- O tipo de encoding de dados, enctype, DEVE ser especificado abaixo -->
            <form enctype="multipart/form-data" action="{{route('cpp.uploadFile.store')}}" method="POST" >
                @csrf
                <!-- MAX_FILE_SIZE deve preceder o campo input -->
                <input type="hidden" name="MAX_FILE_SIZE" value="90000" />
                <!-- O Nome do elemento input determina o nome da array $_FILES -->
                <br>
                <input style="border-bottom: solid 1px black;" name="userfile" type="file" />
                <br>
                <br>
                <input type="submit" value="Enviar arquivo" />
            </form>
        </div>

        <br>

        <div class="" style="width:100%; height:auto;" align="center">
            <!-- <a href="#"> <u> Buscar todas as Atas. </u> </a> -->
        </div>

        @if(isset($moveAta))
            @if($moveAta == 'ok')
                <div class="alert alert-success" role="alert">
                    Upload realizado com sucesso.
                </div>
            @endif
        @endif
        
        @if(isset($moveAta))
            @if($moveAta == 'false')
                <div class="alert alert-danger" role="alert">
                    Upload ñ realizado.
                </div>
            @endif
        @endif 
        
        @if(isset($moveAta))
            @if($moveAta == 'existAta')
                <div class="alert alert-warning" role="alert">
                    Upload ñ realizado. JA existe doc
                </div>
            @endif
        @endif


    </section>
@endsection