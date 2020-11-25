@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
@yield('content')

<style> 
    .card-body:nth-of-type(even) {
    background: #f8f9fa;
    }
     
</style>

@section('content')
    <section> 
        @if(isset($updateSuccess) == 'true')
            <div class="alert alert-success" role="alert" style="margin-top: 22px;">
                Parecer registrado. Atualizado com Sucesso.
            </div>
        @endif

        @if(\Session::has('wrongClip'))
            <div class="alert alert-danger" role="alert" style="margin-top: 22px;">
                Algo de errado com o arquivo. Verifique o anexo.
            </div>
        @endif
    </section>
    
    <div class="card" >
        <!-- card-header -->
        <div class="card-header"  style="max-height: 60px;">
            <div class="row" align="center">
                <div class="col-sm">
                    <form class="form-inline">
                        <div class="input-group mb-3">
                            <input style=" " type="text" class="form-control"  placeholder="Procurar">
                            <div class="input-group-append">
                                <button style="position: relative;" type="submit" class="btn btn-outline-secondary"> 
                                    Buscar 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm">
                    <h5 style=" "> 
                        Pedidos 44A à serem análisados. <br>
                        <small style=" font-size: 12px;"> &nbsp; Todos os pedidos 44A listados nesta area ainda devem ser analisados. </small> 
                    </h5>
                </div>

                <div class="col-sm" align="right">
                    <h5 style=" "> 
                        Total: 
                            @if(isset($my44A))
                                {{count($my44A)}} 
                                @else
                                    0
                            @endif
                    </h5> 
                </div>
            </div>
        </div>
        <!-- card-header -->

        <!-- card-body -->
        @if(isset($my44A) && !empty($my44A))
            @foreach($my44A as $key)
            <div class="card-body" style="height: auto; overflow-y: scroll;">
            <form method="POST" action="update44A" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group row">
                    <div class="col-5" style=" ">
                        <i style="font-size: 30px; color: #00BFFF;" class="far fa-user-circle"></i>
                        &nbsp
                        <label> Nome: {{ $key->nome }} </label>
                    </div>

                    <div class="col-7  form-group" style=" " align="right">
                        <p>
                            <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="far fa-clipboard"></i> &nbsp;Clique aqui para registrar seu parecer
                            </a>
                        </p>

                        <div class="collapse" id="collapseExample" style="position: absolute; z-index:999; width: 95%; height:auto;">
                            <!--  -->
                            <div class="card card-body" style="">
                                <div class="form-group" style="width: 95%; height:100%; margin: auto;">
                                    <label> Meu parecer &nbsp; <small>(descrição)</small></label>
                                    <textarea  class="form-control" rows="3" class="form-control is-invalid" name="myParecer" style=""  required> </textarea>
                                </div>

                                <div class="form-group" style="width: 95%; height:auto; margin: auto;">
                                    <label> Selecione sua decisão &nbsp; </label>

                                    <select class="form-control" style="" id="inputGroupSelect02" name="opnouPor" required>
                                        <option vlaue="default">                              </option>
                                        <option vlaue="Indeferimento">  Indeferimento   </option>
                                        <option value="deferimento">    deferimento     </option>                                
                                        <option value="restituir">      restituir       </option>                                
                                        <option value="postergar">      postergar       </option>
                                        <option value="postergar">      encaminhamento  </option>
                                    </select> 
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>                        
                </div>


                <!-- primeira linha do form -->
                <div class="form-group row">
                    <div class="col-md-4 form-group" style=" " align="left">
                        <label  > <h5> <b>e-Protocolo:</b> </h5> </label>
                        &nbsp &nbsp
                        <input class="form-control"  style="" readonly name="eProtocolo" value="{{ $key->eProtocolo }}">                        
                    </div>

                    <div class="col-md-4 form-group" style=" " align="left">
                        <label  > <h5> <b>Data do registro:</b> </h5> </label>
                        &nbsp &nbsp
                        <input class="form-control"  readonly name="data_sid" value=" {{$key->created_at}} ">                        
                    </div>

                    <div class="col-md-4 form-group" style=" " align="left">
                        <label > <h5> <b>Unidade:</b> </h5> </label>
                        &nbsp &nbsp
                        <input class="form-control" readonly  name="Unidade" value=" {{$key->unidade}}">                        
                    </div>
                </div>

                <!-- segunda linha do form -->
                <div class="form-group row">
                    <div class="col-md-4 form-group" style=" " align="left">
                        <label class='awesome'> <h5> <b>CPF</b> </h5>  </label>
                        &nbsp &nbsp
                        <input class="form-control" readonly name="cpf"   value=" {{$key->cpf}} ">
                    </div>

                    <div class="col-md-4 form-group" style=" " align="left">
                        <label class=' '> <h5> <b>RG</b> </h5>  </label>
                        &nbsp &nbsp
                        <input class="form-control"  readonly name="rg"    value=" {{$key->rg}} ">
                    </div>

                    <div class="col-md-4 form-group" style=" " align="left">
                        <label class=' '> <h5> <b>Graduacão</b> </h5>  </label>
                        &nbsp &nbsp
                        <input class="form-control" readonly name="Graduacao"  value=" {{$key->graduacao}} ">
                    </div>
                </div>

                <!-- terceira linha do form -->
                <div class="form-group row" align="center">
                    <div class="col-md-12" style=" " align="center">
                        <h5> <i class="far fa-copy"></i> Descrição do pedido do militar. </h5>  
                        <br>
                        <textarea class="form-control" readonly value=" {{ $key->descricao_pedido }} " rows="5"> 
                            {{$key->descricao_pedido}}
                        </textarea>
                    </div>
                </div>
                <!-- terceira linha do form -->

                <br>

                <div class="form-group row"> 
                    <div class="col-md-8 form-group" >
                        <label for="fileRelatorRelatorio"> Insira seu relatório aqui </label> <span> (Tamanho max. <b>10MB</b>) &nbsp; (Type: &nbsp; <b>pdf</b>) </span>  
                        <input type="file" name="fileRelatRelat" class="form-control-file" id="fileRelatorRelatorio" required> 
                    </div>

                    <div class="col-md-4"  align="center">
                        <a style="border:none;" href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo]) }}" class="btn btn-outline-primary  btn-sm"> 
                            <i class="fas fa-paperclip"></i>  &nbsp Visualizar Anexo do pedido do militar.  
                        </a>  
                        <!-- <input style="background: transparent; box-shadow: none; border: none; border-bottom: solid 1px black;" type="file" class="form-control" id="formGroupExampleInput" placeholder="Example Anexo para doc"> -->
                    </div>
                </div>

                <br>

                <div class="form-group row" align="center"> 
                    <button style="margin:0 auto;" class="btn btn-success" type="submit"> 
                        <i class="fa fa-gavel" aria-hidden="true"></i>  &nbsp; Registrar parecer.
                    </button> 
                </div>


                <!-- terceira linha do form -->
                <div class="row" align="center" style="position: relative; ">
                    
                </div>
                <!-- terceira linha do form -->

                <!-- @ type="hidden" name="eProtocolo_referer_44A" @
                    --------------------------------------------
                    |    Não deve ser retirado. enviado com      |
                    |   form  para posterior uso. identifica     |
                    |   qual o 44a                              |
                    ---------------------------------------------
                -->
                <input type="hidden" name="eProtocolo_referer_44A" value="{{ $key->eProtocolo }}">
            </form>

            </div>
            <!-- card-body -->
            @endforeach
        @endif

        <!-- 
            Se não existe 44a a serem exibidos
            então apresento mensagem.
        -->
        @if( isset($my44A) )
            @if(count($my44A) == 0) 
                <div class="card-body" style="margin-top: 22px;">
                    <div class="container">
                        <div class="row" >
                            <div class="col-4"> </div>
                            <div class="col-4" align="center"> 
                                <i class="fas fa-box-open" style="font-size: 80px; color:white;"> </i>
                                <br>
                                <span style="position:relative; top: -45px; font-size: 20px; color:darkgray;"> Info. Não há 44-A para serem analisados. </span> 
                            </div>
                            <div class="col-4"> </div>
                        </div>
                    </div>
                </div>
        
            @endif
        @endif

        <div class="card-footer" align="center" style="color: #869c98;">
            Listagem 44a
        </div>
    </div>

    <br>

@endsection


