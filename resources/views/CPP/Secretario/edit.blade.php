@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
@yield('content')

@section('content')

 
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto;" align="center"> 
    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->


    <section> 
        <div class="card" style="height: auto;" align="center">
            <br>
            <span> <u> Deliebração Selecionada. </u> </span>              
            <textarea readonly style="margin: auto; width: 98%; margin-bottom: 15px;" rows="9"> 
                {{$turn_back_vote[0]->deliberacao}}
            </textarea>
            <br>
        </div>
    </section>
    <!-- Script's -->

@endsection


