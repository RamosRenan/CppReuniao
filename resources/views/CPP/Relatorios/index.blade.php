@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
    </style>
    

    <h4> Relatórios. </h4>

    <div style="display: none;"> {{$numata =  $legendrelatorio[0]->numero_ata}} </div>
    @foreach($legendrelatorio as $key => $value)

        @if($numata !=  $value->numero_ata)
            <div class="alert alert-secondary" style="max-height: 45px;" role="alert" align="center">
                <span style="color: white; position: relative; top: -10px;"> 
                    Próxima Ata.<br>
                    <i class="fas fa-sort-down" style="font-size: 28px; position: relative; top: -10px;"></i> 
                </span>
            </div>
            <div style="display: none;">{{$numata =  $value->numero_ata}} </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr align="center" style="background-color: white;">
                    <th colspan="5"> Ata N° {{ $value->numero_ata}} </th>
                </tr>
                
                <tr>
                    <th> Condição </th>
                    <th> Data I </th>
                    <th> TOTAL </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>  {{$value->condicao_this_deliberacao}} </td>
                    <td>  {{$value->created_at}} </td>
                    <td>  {{$value->tot}} </td>
                </tr>
            </tbody>
        </table>
        
    @endforeach

@endsection