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

    <section> 
        @if(isset($updateSuccess) == 'true')
            <div class="alert alert-success" role="alert" style="margin-top: 22px;">
                Parecer registrado. Atualizado com Sucesso.
            </div>
        @endif
    </section>
    
    <div class="card" >
        <div class="card-header"  style="max-height: 60px;">
            <div class="row" align="center">
                <div class="col-sm">
                    <form class="form-inline" >
                        <input style="height: 33px; " type="text" class="form-control"  placeholder="Procurar">
                        <button style="position: relative;  top: 5px;" type="submit" class="btn btn-primary mb-2"> 
                            <i style="font-size: 18px;" class="fas fa-search"> </i> 
                        </button>
                    </form>
                </div>
                <div class="col-sm">
                    <h5 style="color: #223A5E;"> 
                        Pedidos 44A à serem análisados. <br>
                        <small style="color: #495057; font-size: 12px;"> <i class="fas fa-info"></i> &nbspTodos os pedidos 44A listados nesta area ainda devem ser analisados. </small> 
                    </h5>
                </div>
                <div class="col-sm" align="right">
                    <h5 style="color: #009ACD;"> 
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
        <!-- card-body -->
        <div class="card-body" style="height: auto; overflow-y: scroll;">
            @if(isset($my44A) && !empty($my44A))
                @foreach($my44A as $key)
                <br> <br>
                <form method="POST" action="update44A" align="center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <div class="col-sm-4" style=" ">
                            <i style="font-size: 45px; color: #00BFFF;" class="far fa-user-circle"></i>
                            &nbsp
                            <input style=" margin-top: -35px; font-weight: bold; background: transparent; border: none;" name="Nome"  type="text" readonly  value="{{$key->nome}}">
                        </div>

                        <div class="col-sm-4" style="width: 100%; height:100%;">
                            <textarea placeholder="Sua descrição do parecer" name="myParecer" style="background: transparent; border: none; border-bottom: solid 1px black; width: 100%; heihgt:100%;" rows="1" required>
                                Sua descrição do parecer
                            </textarea>
                        </div>

                        <div class="col-sm-3" style=" ">
                            <select style="background: transparent; box-shadow: none; border: none; border-bottom: solid 1px black;" class="custom-select" id="inputGroupSelect02" name="opnouPor" required>
                                <option vlaue="Indeferimento">  Indeferimento   </option>
                                <option value="deferimento">    deferimento     </option>                                
                                <option value="restituir">      restituir       </option>                                
                                <option value="postergar">      postergar       </option>
                                <option value="postergar">      encaminhamento  </option>
                            </select> 
                        </div>

                        <div class="col-sm-1" style="" align="right">
                            <button style="margin:0 auto;" class="btn btn-danger" type="submit"> 
                                <i class="fa fa-gavel" aria-hidden="true"></i>  
                            </button>                  
                        </div>
                    </div>

                    <br>
                    <!-- primeira linha do form -->
                    <div class="form-group row">
                        <div class="col-md-4" style=" " align="left">
                            <label class=' '> <h5> e-Protocolo: </h5> </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none;" class=' ' readonly name="Nome" value="{{ $key->eProtocolo }}">                        
                        </div>

                        <div class="col-md-4" style=" " align="left">
                            <label class=' '> <h5> Data do registro: </h5> </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none;" class=' ' readonly name="data_sid" value=" {{$key->created_at}} ">                        
                        </div>

                        <div class="col-md-4" style=" " align="left">
                            <label class=' '> <h5> Unidade: </h5> </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none; width: 70%;" class=' '   name="Unidade" value=" {{$key->unidade}}">                        
                        </div>
                    </div>

                    <!-- segunda linha do form -->
                    <div class="form-group row">
                        <div class="col-md-4" style=" " align="left">
                            <label class='awesome'> <h5> CPF</h5>  </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none;" readonly name="cpf"   value=" {{$key->cpf}} ">
                        </div>

                        <div class="col-md-4" style=" " align="left">
                            <label class=' '> <h5> RG</h5>  </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none;"  readonly name="rg"    value=" {{$key->rg}} ">
                        </div>

                        <div class="col-md-4" style=" " align="left">
                            <label class=' '> <h5> Graduacão</h5>  </label>
                            &nbsp &nbsp
                            <input style="background: transparent; border:none;" readonly name="Graduacao"  value=" {{$key->graduacao}} ">
                        </div>
                    </div>

                    <br>

                    <div class="row"> 
                        <div class="form-group">
                            <label for="fileRelatorRelatorio"> Insira seu relatório aqui </label> <span> (Tamanho max. <b>10MB</b>) &nbsp; (Type: &nbsp; <b>pdf</b>) </span>  
                            <input type="file" name="fileRelatorRelatorio" class="form-control-file" id="fileRelatorRelatorio"> 
                        </div>
                    </div>

                    <br>
                    <!-- terceira linha do form -->
                    <div class="form-group row" align="center">
                        <div class="col-md-12" style=" " align="center">
                            <h5> <i class="far fa-copy"></i> Descrição do pedido do militar. </h5>  
                            <br>
                            <textarea style="background: transparent; border:none; width: 100%; margin-top: -12px;"  readonly value=" {{ $key->descricao_pedido }} " rows="8"> 
                                {{$key->descricao_pedido}}
                            </textarea>
                        </div>
                    </div>
                    <!-- terceira linha do form -->

                    <!-- terceira linha do form -->
                    <div class="form-group row" align="center">
                        <div class="col-md-12" style=" " align="left">
                            <a href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo]) }}" class="btn btn-outline-primary  btn-sm"> 
                                <i class="fas fa-paperclip"></i>  &nbsp Visualizar Anexo.  
                            </a>  
                            <!-- <input style="background: transparent; box-shadow: none; border: none; border-bottom: solid 1px black;" type="file" class="form-control" id="formGroupExampleInput" placeholder="Example Anexo para doc"> -->
                        </div>
                    </div>
                    <!-- terceira linha do form -->

                    <br>

                    <!-- @ type="hidden" name="eProtocolo_referer_44A" @
                        --------------------------------------------
                        |    Não deve ser retirado enviado com      |
                        |   form  para posterior uso identifica     |
                        |   qual o 44a                              |
                        ---------------------------------------------
                    -->
                    <input type="hidden" name="eProtocolo_referer_44A" value="{{ $key->eProtocolo }}">
                </form>

                <hr>
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
        </div>
        <!-- card-body -->
        <div class="card-footer" align="center" style="color: #869c98;">
            Listagem 44a
        </div>
    </div>

    <br>

@endsection


