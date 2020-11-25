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

    <section style="width: 100%; height:auto;"> 
        <div class="card ">
            <div class="card-header " style=" " >
                <h4 style="color: black;"> 
                    <i style=" " class="far fa-clock"></i>
                    <small> Este pedido está na condição de <b>Postergado</b> </small>
                </h4>
            </div>

            <div class="card-body" style="max-height: auto; ">
                @if(isset($Usorteados))
                <form action="/cpp/updateParecerPostergados" method="post" >
                    @csrf
                    <div style="width: 100%; height: auto; display: flex;">
                        <div style="width: calc(100%/5); " class="form-group">
                            <label for="exampleInputEmail1" style="font-weight: lighter; float: left;">eProtocolo</label>
                            <input type="text" class="form-control" name="eProtocolo" id=" " value="{{$Usorteados[0]->eProtocolo}}" aria-describedby=" " placeholder="" readonly>
                        </div>
                        &nbsp
                        <div style="width: calc(100%/5); " class="form-group">
                            <label for="exampleInputPassword1" style="font-weight: lighter; float: left;">Opnou por</label>
                            <input type="text" class="form-control" id="opnou" value="{{$Usorteados[0]->relator_opnou_por}}" name="opnou" placeholder=" " readonly>
                        </div>
                        &nbsp
                        <div style="width: calc(100%/5); " class="form-group">
                            <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">Data</label>
                            <input type="text" name="data" class="form-control"  value="{{$Usorteados[0]->created_at}}" id=" " readonly>
                        </div>
                        &nbsp
                        <div style="width: calc(100%/5); " class="form-group">
                            <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">Nome</label>
                            <input type="text" name="nome" class="form-control"  value="{{$Usorteados[0]->nome}}" id=" " readonly>
                        </div>
                        &nbsp
                        <div style="width: calc(100%/5); " class="form-group">
                            <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">RG</label>
                            <input type="text" name="rg" class="form-control"  value="{{$Usorteados[0]->rg}}" id=" " readonly>
                        </div>
                        &nbsp
                        <div style="width: calc(100%/5); " class="form-group">
                            <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">CPF</label>
                            <input type="text" name="cpf" class="form-control"  value="{{$Usorteados[0]->cpf}}" id=" " readonly>
                        </div>
                    </div>

                    <!-- form-row -->
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="exampleInputPassword1" style="font-weight: lighter; float: left;">Alterar para</label>
                            <select name="voto_relator" class="custom-select" id="inputGroupSelect02">
                                <option vlaue="Indeferimento">  Indeferimento   </option>
                                <option value="deferimento">    deferimento     </option>                                
                                <option value="restituir">      restituir       </option>                                
                                <option value="postergar">      postergar       </option>
                            </select>  
                        </div>

                        <div class="form-group col-md-3">
                            <label  style="font-weight: lighter; float: left;" for="inputEmail4">Relator pnou por</label>
                            <input readonly type="text" class="form-control" id=" " value="{{$Usorteados[0]->relator_opnou_por}}">
                        </div>

                        <div class="form-group col-md-2">
                            <label  style="font-weight: lighter; float: left;" for=" ">Relator votou</label>
                            <input readonly type="text" class="form-control" id=" " value="Sim">
                        </div>

                        <div class="form-group col-md-2">
                            <label  style="font-weight: lighter; float: left;" for=" ">Data registro</label>
                            <input readonly type="text" class="form-control" id=" " value="{{$Usorteados[0]->created_at}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label  style="font-weight: lighter; float: left;" for=" ">Pedido</label>
                            <input readonly type="text" class="form-control" id=" " value="{{$Usorteados[0]->pedido}}">
                        </div>
                        
                    </div>
                    <!-- form-row -->

                    <button style="float:left; background:transparent; color:black; border:none;" type="button" class="btn btn-info"><i class="fas fa-paperclip"></i> &nbspArquivos anexados</button>

                    <br>
                    <br>
                                    
                    <div class="form-group">
                        <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">Parecer</label>
                        <textarea type="text" name="parecer" class="form-control" value="" rows="3" id=" "> 
                            {{$Usorteados[0]->parecer_relator}}
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"> <i class="far fa-edit"></i> &nbsp Alterar</button>
                    &nbsp&nbsp
                </form>
                @endif
            </div>
        </div>
    </section>

    <br>

    @if(isset($updateok))
        <div class="alert alert-primary" role="alert">
            Alterado com sucesso.
        </div>
    @endif
@endsection


