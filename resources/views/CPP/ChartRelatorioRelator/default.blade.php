@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')

    <div class="alert alert-info" role="alert">
        <h4> 
            <i class="fas fa-ban"></i>  <small> &nbsp Nenhum arquivo encotrado. </small>
        </h4>
    </div>
     
@endsection