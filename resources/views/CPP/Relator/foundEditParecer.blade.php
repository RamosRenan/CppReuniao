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
            <div class="card-footer text-mutedr" align="center">
                    <span> Editar parecer. </span>
            </div>

            <div class="card-body" style="max-height: 570px; " >
                @if(isset($foundEditParecer) || !empty($foundEditParecer))
                    <form action="\cpp\alterParecer" method="post">
                        <div class="form-group">
                            @csrf
                            <label for="exampleFormControlInput1" style="font-weight: lighter; float:left;">* e-Protocolo</label>
                            <input value="{{$foundEditParecer[0]->eProtocolo}}" readonly type="text" class="form-control" id="exampleFormControlInput1" name="eProtocolo" required>
                            <br>
                            <label for="opnou"  style="font-weight: lighter; float:left;">* Opnar</label>
                            <select class="form-control" id="opnou" name="opnou" required >
                                    <option selected> {{$foundEditParecer[0]->relator_opnou_por}}                       </option>
                                    <option vlaue="Indeferimento">  Indeferimento   </option>
                                    <option value="deferimento">    deferimento     </option>                                
                                    <option value="restituir">      restituir       </option>                                
                                    <option value="postergar">      postergar       </option>
                            </select>
                            <br>
                            <label  style="font-weight: lighter; float:left;" for="description">* Descrição</label>
                            <textarea  value="" class="form-control" id="description" name="description" rows="4">
                                {{$foundEditParecer[0]->parecer_relator}}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Confirm</button>
                    </form>
                @endif
            </div>
            
            <div class="card-footer text-muted">
                <small> Edição de parecer. </small>
            </div>
        </div>

        @if(session('successedit'))
        <div class="alert alert-primary" role="alert">
            Alterado com sucesso.
        </div>
        @endif
    </section>
@endsection


