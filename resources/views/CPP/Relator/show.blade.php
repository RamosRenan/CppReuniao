@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
@yield('content')

@section('content')

 
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto;" > 
      
        <strong>  <h5>   <i class="fa fa-user-circle" style="font-size: 30px;" aria-hidden="true"></i>   Pagina do Relator. Alteração de Voto. </h5> </strong>                  

    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->


    <section> 

        <div class="card" style="height: auto" align="center">
            <form action="{{ route('cpp.relator.edit', 1) }}" method="GET"> 
                <br>
                <h3 style="color: #dc3545"> <u> Deliberação: Alteração de voto.  </u> </h3>
                <h5 style="color: #dc3545"> <u> <i class="fas fa-skull-crossbones"></i> <i class="fas fa-info-circle"></i> Atenção.: Você pode estar causando conflitos no banco. Aferir muitos votos errados poderá causar pejuízos na integridade dos dados.  </u> </h5>
                <textarea class='form-control' readonly style="margin:auto; max-width: 90%;" rows="7"> 
                    {{$turn_back_vote[0]->deliberacao}}
                </textarea>
                   

                <span> Votar Contra. </span> 

                <span style=" position:relative; left: 15px;"> Votar Favorável. </span> <br>

                <input type="radio" style="width: 25px; height: 25px; cursor:pointer; position:relative; left: -45px;" name="vote" value="contra"> <!-- contra -->

                <input type="radio" style="width: 25px; height: 25px; cursor:pointer; position:relative; left: 35px;" name="vote" value="favoravel"> <!-- favoravel -->

                <input type="hidden" style="" name="id_deliberacao" value="{{$turn_back_vote[0]->id_deliberacao}}"> <!-- informcaoes da deliberaco -->
                <input type="hidden" style="" name="eProtoc" value="{{$turn_back_vote[0]->eProtocolo}}"> <!-- informcaoes da deliberaco -->
                <input type="hidden" style="" name="id_membro" value="{{$turn_back_vote[0]->id_membro}}"> <!-- informcaoes da deliberaco -->
                
                <br>
                <br>

                <button type="submit" class="btn btn-success">  <i class="far fa-edit"></i> Corrigir Voto. </button>

            </form>
        </div>
    </section>

    @if( session('vote_white'))
    <div class="alert alert-danger" role="alert">
       NÃO VOTE EM BRANCO !!!
    </div>
    @endif

<!-- Script's -->

@endsection


