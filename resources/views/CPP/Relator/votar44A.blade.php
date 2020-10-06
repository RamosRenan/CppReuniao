@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
@yield('content')

@section('content')
  
<div class="card" style=" ">
    <div class="card-body">
        <h3 class=" ">Votação 44a</h3>
        <h6 class="card-subtitle mb-2 text-muted">Aqui você tem acesso a deliberação 44a em votação no momento.</h6>
        <h6 class="card-subtitle mb-2 text-muted" >
            <i class="fas fa-info-circle"></i> 
            <span style="color: blue;">
                &nbsp Se não é disponibilizado o botão para que você registre seu voto, 
                certifique-se que de não seja o relator.
            </span>
        </h6>
        <br>
        <h4 class="" style="color: #00BFFF;"><u>Texto da deliberação</u></h4>

        <!-- conteudo da deliberacao -->
        <p class="card-text" style="text-align: justify;">
            @if(isset($emptyToVote44A) && $emptyToVote44A)
                {{$vote44AData}}
                @else
                    <h6 class="card-subtitle mb-2 text-muted">
                        Não há deliberação no momento.
                    </h6>
            @endif
        </p>
        <!-- conteudo da deliberacao -->

        <!-- Confirma relator que votou e concorda com texto-->
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1">
        <label style="color: #00539C;" class="custom-control-label" for="customCheck1">Eu, concordo com o texto desta deliberção. </label>
        </div>

        <!-- se não é relator, então mostra o form  -->
        @if(isset($emptyToVote44A) && $emptyToVote44A)
        @if($responseRelator != $userLoged)
            <form action = "/cpp/registre_Vote44A" method="POST"  style="margin:0 auto; ">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-key"></i> &nbsp Insira suas credenciais para prosseguir com o voto.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-key"></i> &nbsp Pass</span>
                        </div>
                        <input type="password" name="lokToVote" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Votar</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal -->


                <!-- if(isset( return_to_vote_member[0]->id))  -->
                <!-- inputs hidden  -->
                <input type="hidden" value="{{ $id44A }}"           id=" "  class="id_deliberacao"  name="id44A">
                <input type="hidden" value="{{ $userLoged }}"       id=" "  class="eProtoc"         name="id_membro">
                <input type="hidden" value="{{ $ativeSecretario }}" id=" "  class="id_membro"       name="secretario_desta_deliberacao">
                <input type="hidden" value="{{ $ativePresident }}"  id=" "  class="id_membro"       name="presidente_desta_deliberacao">
                <!-- inputs hidden -->
                <!-- endif -->
                <hr>
                <a href="#" class="card-link">
                    <input type="radio" value="favoravel" name="vote" style=" cursor: pointer; " > 
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#staticBackdrop" style="margin-left: 50px; border:none;">Favorável &nbsp; <i class="far fa-thumbs-up"></i></button>
                </a>
                <a style="float:right;" href="#" class="card-link">
                    <input type="radio" value="contra" name="vote" style=" cursor: pointer; " > 
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#staticBackdrop" style="margin-left: 50px; border:none;">Contra &nbsp; <i class="far fa-thumbs-down"></i></button>
                </a>
            </form>

            @else
                <br>
                <div class="alert alert-info" role="alert">
                    <h6 class="" >
                        <i class="fas fa-info-circle"></i> 
                        <span style=" ">
                            &nbsp Não é possível registrar voto. Você é o relator.
                        </span>
                    </h6>
                </div>
        @endif
        @endif
    </div>
</div>


<!-- contem todos os alertas -->
@if(session('itNotRelator'))
    <div class="alert alert-warning" role="alert">
        Você ainda não é um relator. Peça ao secretário que o cadastre.
    </div>
@endif

@if(isset($Success) && $Success)
    <div class="alert alert-success" role="alert">
        Voto registrado com sucesso.
    </div>
@endif


@endsection