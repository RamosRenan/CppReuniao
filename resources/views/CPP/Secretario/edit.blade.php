@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
@yield('content')

@section('content')

 
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto;" > 
      
        <strong>  <h5> <u> Deliebração Selecionada. </u> </h5> </strong>                  

    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->


    <section> 
        <div class="card" style="height: 330px;" align="center">
            <br>
            <textarea class='form-control' readonly style="margin:auto; max-width: 90%;" rows="9"> 
                {{$turn_back_vote[0]->deliberacao}}
            </textarea>
        </div>
    </section>
    <!-- Script's -->

@endsection


