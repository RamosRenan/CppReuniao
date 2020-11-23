@extends('layouts.app')


@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@yield('content')


@section('content')
    <div class="card">
        <div class="card-footer" align="center">
            <h5 style="">  
                <small style=""> Homologção de Pontos Positivos. </small> <br>
                <small >  Protocolo: <a href="#"> {{$selectedHom[0]->eProtocolo}} </a> </small> <br>
            </h5>
        </div>
        <div class="card-body" align="center">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Nome</label>
                        <input type="email" class="form-control" id="inputEmail4" value="{{$selectedHom[0]->nome}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Unidade</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->unidade}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Graduação</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->graduacao}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Cpf</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->cpf}}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Universidade</label>
                        <input type="email" class="form-control" id="inputEmail4" value="{{$selectedHom[0]->universidade}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Curso</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->curso}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Distinção</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->distincao}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Qtd Pontos</label>
                        <input type="number" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->qtd_pontos}}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Ata</label>
                        <input type="email" class="form-control" id="inputEmail4" value="{{$selectedHom[0]->pertence_ata}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Data do registro</label>
                        <input readonly type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->data_do_registro_eProtocolo}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Inciso</label>
                        <input type="text" class="form-control" id="inputPassword4" value="{{$selectedHom[0]->key_inciso}}">
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="inputAddress2">Texto oficial</label>
                    <textarea rows="4" type="text" class="form-control" id="inputAddress2" > 
                        {{$selectedHom[0]->contain_oficial_homolocao}}
                    </textarea>
                </div>
 
                <button type="submit" class="btn btn-primary"> <i class="far fa-edit"></i> Editar</button>
                &nbsp &nbsp &nbsp
                <button type="submit" class="btn btn-danger"> <i class="far fa-trash-alt"></i> Excluir</button>

            </form>
        </div>
        <div class="card-footer" align="center">
            <span style="color: gray;"> H.P.P <i class="fas fa-history"></i> </span>
        </div>
    </div>
   
    <br> <br>
@endsection
