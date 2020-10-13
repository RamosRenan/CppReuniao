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
        
        <!-- card-default -->
        <div class="card" style=" ">
            <!-- @ scrool_grid_relator @ -->
            <div class="scrool_grid_relator" style="height: auto; "> 
                <div class="card-header"  > 
                    <h5> <i style="font-size: 26px; color: #004B8D;" class="far fa-user-circle"></i> &nbsp; Pedido Selecionado </h5>
                </div>
                <!-- card-body -->
                <div class="card-body " style="max-height: auto;"> 
                    <!-- form -->
                    <form action="{{ route('cpp.relator.store') }}" method="POST" enctype="multipart/form-data">
                        @if(isset($Usorteados) )
                        @if(count($Usorteados) > 0 )
                        @foreach($Usorteados as $key)

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" value=" {{ $key->eProtocolo }} " name="num_sid">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="name3input">Nome</label>
                                <input type="text" class="form-control" id="name3input"  name="Nome" style="" readonly value="{{ $key->nome }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword3">Unidade</label>
                                <input type="text"  name="Unidade"  style="" readonly value="{{ $key->unidade }}"  class="form-control" id="inputPassword3">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword3">Graduacao</label>
                                <input type="text"  name="Graduacao"  style="" readonly value="{{ $key->graduacao }}"  class="form-control" id="inputPassword3">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword3">Cpf</label>
                                <input type="text"  name="Graduacao"  style=""   name="cpf" class="form-control"  style="" readonly value="{{ $key->cpf }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2 form-group" >
                                <label> Nº eProtocolo. </label>
                                <input style="" class='form-control' readonly required minlength = "12"   value="{{ $key->eProtocolo }}" name="eProtocolo" type="text">
                            </div>
                            <div class="col-4 form-group" >
                                <label> Pedido. </label>
                                <input style="" class='form-control' required minlength = "12" readonly value="{{ $key->pedido }}"  name="pedido" type="text">

                            </div>
                            <div class="col-md-2 form-group" >                
                                <label> Data do eProtocolo. </label>
                                <input style="" name="data_sid" readonly value="{{ $key->entry_system_data }}"  name="entry_system_data" type='text' class='form-control'>

                            </div>
                            <div class="col-md-2 form-group" >
                                <label> Status. </label>
                                <input style="" name="situacao" readonly value="{{ $key->status }}"  name="status" type='text' class='form-control' readonly value='Cadastrado'>
                            
                            </div>  
                            <div class="col-md-2 form-group" >
                                <label class='awesome'> RG </label>
                                <input style="" class='form-control' type="text"  name="rg"  style="" readonly value="{{ $key->rg }}" >
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Resolve</label>
                                <select name="voto_relator" class="custom-select" id="inputGroupSelect02" required>
                                    <option >                                       </option>
                                    <option vlaue="Indeferimento">  Indeferimento   </option>
                                    <option value="deferimento">    deferimento     </option>                                
                                    <option value="restituir">      restituir       </option>                                
                                    <option value="postergar">      postergar       </option>
                                </select>  
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputZip"> <i style="color: blue;" class="fas fa-info-circle"></i> &nbsp; * Inserir relatório *</label></br>
                                <input type="file" name="fileRelatRelat" id="inputZip" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <a href="{{ route('cpp.eProtocoloAnexoController.show', ['', 'hid'=>$key->eProtocolo]) }}" class="btn btn-outline-primary" > 
                                    <i class="fas fa-paperclip"></i> &nbsp  Visualizar anexo.  
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">** Não esqueça de inserir seu parecer. (Descrição da sua decisão)</label>
                            <textarea type="text"  name="parecer" class="form-control" id="inputAddress2"  required> </textarea>
                        </div>
 
                        <div class="form-row">
                            <div class="form-group col-md-12"  align="center">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-gavel" aria-hidden="true"></i> &nbsp; Registrar parecer</button>
                            </div>
                        </div>

                        @endforeach

                            @else
                                <div style="width: 100%; height: auto; color: #4c566a;" align="center"> 
                                    <i class="fas fa-hourglass-end"></i> <br>
                                    <span > Seus pedidos acabaram.  </span> <br>
                                    <span> Aguarde novos sorteios de expedientes. </span>   
                                </div> 
                        @endif
                        @endif
                    </form>
                    <!-- form -->
                </div> 
                <!--  card-body -->
                <div class="card-footer"> </div>
            </div> 
            <!-- @ scrool_grid_relator @ -->

        <!-- @ Alerts @ -->
        <section> 
            @if(session('nothen_turnback_deliber'))
                <div class="alert alert-danger" role="alert">
                    NÃO HÁ DELIBERARAÇÃO DISPONÍVEL PARA ALTERAÇÃO DE VOTO.  SOLICITE AO SECRETÁRIO LIBERAÇÃO.  
                </div>
            @endif
        </section>


        <section> 
            @if(session('emptyToVote44A'))
                <div class="alert alert-WARNING" role="alert">
                    NÃO HÁ 44A DISPONÍVEL PARA VOTAÇÃO.  
                </div>
            @endif
        </section>


        <section> 
            @if(session('itNotRelator'))
                <div class="alert alert-WARNING" role="alert">
                    NÃO FOI POSSÍVEL REGISTRAR O PARECER, POIS VOCÊ AINDA NÃO É TIDO COMO RELATOR NO SISTEMA. PEÇA AO SECRETÁRIO QUE O CADASTRE.  
                </div>
            @endif
        </section>
        <!-- @ Alerts @ -->

        <br>


        <!-- Script's -->
        <script type="text/javascript">
            
        </script>

    @endsection


