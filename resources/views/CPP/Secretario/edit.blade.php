@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
@yield('content')

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

@section('content')

 
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto;" align="center"> 
    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->


    <section> 
        <div class="card" style="height: auto;" align="center">
            <div class="card-header"> 
                <h5> <i class="fas fa-info" style="color: 00BFFF;"></i> &nbsp Mais Informações.  </h5>
            </div>
            <div class="card-body">
            <table>
                <tr>
                    <td>Perternce à Ata</td>
                    <td>{{$turn_back_vote[0]->numero_ata}}</td>
                </tr>
                <tr>
                    <td>Protocolo</td>
                    <td>{{$turn_back_vote[0]->eProtocolo}}</td>
                </tr>
                <tr>
                    <td>Condição</td>
                    <td>{{$turn_back_vote[0]->condicao_this_deliberacao}}</td>
                </tr>
                <tr>
                    <td>Data do registro</td>
                    <td>{{ $turn_back_vote[0]->created_at }}</td>
                </tr>
            </table>
            </div>
            <div class="card-footer" align="center"> </div>
        </div>

        <div class="card" style="height: auto;" align="center">
            <div class="card-header"> 
                <h5> <i class="far fa-file-alt" style="color: 00BFFF;"></i> &nbsp Deliebração Selecionada.  </h5>
            </div>
            <div class="card-body">
            <textarea readonly style="margin: auto; width: 98%; border:none; text-align:justify;" rows="9"> 
                {{$turn_back_vote[0]->deliberacao}}
            </textarea>
            </div>
            <div class="card-footer" align="center"> 
                <span>  </span>
            </div>
        </div>
    </section>
    <!-- Script's -->

    <br>

@endsection


