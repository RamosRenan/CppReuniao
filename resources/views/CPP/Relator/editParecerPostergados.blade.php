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
        <div class="card text-center">
            <div class="card-footer text-mutedr" style="background:  #FF5733 ; height: 40px;" >
                <span style="color: white;"> <i class="far fa-clock"></i> Este pedido está na condição de Postergado. </span>
            </div>

            <div class="card-body" style="max-height: auto; " align="center">
                @if(isset($Usorteados))
                <form action="/cpp/updateParecerPostergados" method="post" >
                    @csrf
                    <div style="width: 100%; height: auto; display: flex;">
                        <div style="width: calc(100%/3); " class="form-group">
                            <label for="exampleInputEmail1" style="font-weight: lighter; float: left;">eProtocolo</label>
                            <input type="text" class="form-control" name="eProtocolo" id=" " value="{{$Usorteados[0]->eProtocolo}}" aria-describedby=" " placeholder="" readonly>
                        </div>
                        <div style="width: calc(100%/3); " class="form-group">
                            <label for="exampleInputPassword1" style="font-weight: lighter; float: left;">Opnou por</label>
                            <input type="text" class="form-control" id="opnou" value="{{$Usorteados[0]->relator_opnou_por}}" name="opnou" placeholder=" " readonly>
                        </div>
                        <div style="width: calc(100%/3); " class="form-group">
                            <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">Data</label>
                            <input type="text" name="data" class="form-control"  value="{{$Usorteados[0]->created_at}}" id=" " readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-weight: lighter; float: left;">Alterar para</label>
                        <select name="voto_relator" class="custom-select" id="inputGroupSelect02">
                            <option > Deliberar Por.:                       </option>
                            <option vlaue="Indeferimento">  Indeferimento   </option>
                            <option value="deferimento">    deferimento     </option>                                
                            <option value="restituir">      restituir       </option>                                
                            <option value="postergar">      postergar       </option>
                        </select>  
                    </div>
                    
                    <div class="form-group">
                        <label class=""  for="exampleCheck1" style="font-weight: lighter; float: left;">Parecer</label>
                        <textarea type="text" name="parecer" class="form-control" value="" rows="3" id=" "> 
                            {{$Usorteados[0]->parecer_relator}}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </form>
                @endif
            </div>
            
            <div class="card-footer text-muted" style=" ">
                <small> Edição de parecer. </small>
            </div>
        </div>
    </section>

    @if(isset($updateok))
        <div class="alert alert-primary" role="alert">
            Alterado com sucesso.
        </div>
    @endif
@endsection


