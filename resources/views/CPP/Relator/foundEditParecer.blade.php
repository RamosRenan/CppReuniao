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
            <div class="card-header" align="center">
                <i class="far fa-edit"></i> <br>
                <h4 style="color: #223A5E;"> Editar parecer. </h4>
                <span style="color: #495057;"> <small> Este pedido ainda não foi votado pela comissão, após a comissão votar, não é mais possível atera-lá. </small> </span>
            </div>

            <div class="card-body" style="max-height: 570px; " >
                @if(isset($foundEditParecer) || !empty($foundEditParecer))
                    <form action="\cpp\alterParecer" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput1" style="font-weight: lighter;">* e-Protocolo</label>
                                <input value="{{$foundEditParecer[0]->eProtocolo}}" readonly type="text" class="form-control" id="exampleFormControlInput1" name="eProtocolo" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="opnou"  style="font-weight: lighter; ">* Opnar</label>
                                <select class="form-control" id="opnou" name="opnou" required >
                                        <option selected> {{$foundEditParecer[0]->relator_opnou_por}}                       </option>
                                        <option vlaue="Indeferimento">  Indeferimento   </option>
                                        <option value="deferimento">    deferimento     </option>                                
                                        <option value="restituir">      restituir       </option>                                
                                        <option value="postergar">      postergar       </option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label style="font-weight: lighter; ">Relatou votou</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="Sim">
                                    @else
                                        <input readonly type="text" class="form-control" id="" value="Não">
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <label style="font-weight: lighter; ">Interessado</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->nome}}">
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <label style="font-weight: lighter; ">Unidade</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->unidade}}">
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label style="font-weight: lighter; ">Graduação</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->graduacao}}">
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <label style="font-weight: lighter; ">RG</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->rg}}">
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <label style="font-weight: lighter; ">CPF</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->cpf}}">
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label style="font-weight: lighter; ">Pedido</label>
                                @if($foundEditParecer[0]->relator_votou == "true")
                                    <input readonly type="text" class="form-control" id="" value="{{$foundEditParecer[0]->pedido}}">
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label  style="font-weight: lighter; float:left;" for="description">* Descrição</label>
                                <textarea  value="" class="form-control" id="description" name="description" rows="3">
                                    {{$foundEditParecer[0]->parecer_relator}}
                                </textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary mb-2"> <i class="far fa-edit"></i> Editar</button>
                    </form>
                @endif
            </div>
        </div>

        @if(session('successedit'))
        <div class="alert alert-primary" role="alert">
            Alterado com sucesso.
        </div>
        @endif
    </section>

    <br>
@endsection


