@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
  font-weight: lighter;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

@section('content')
    @if(isset($allLastDeliberPostergados))
        <!-- <section style="position: absolute; top: 70px; margin-bottom: 10px;"> 
            <i class="far fa-clock" style="font-size:22px; color:magenta;"> </i>
            <span style="color:gray; "> 
                <u> 
                    <span style="color:magenta; font-size: 18px;"> {{$allLastDeliberPostergados}} </span> 
                    Pedido(s) *Postergados*. 
                </u> 
                <br> 
                <small style="color: magenta;"> Fique atento aos eProtocolos postergados. </small>
            </span>
        </section> -->
    @endif

    @if(session('emptyRelatores'))
        <div class="alert alert-danger" role="alert">
            Não é possível prosseguir pois não há membros cadastrados, ou menos que 3 membros. Ou não existe Presidente ou Relator.
        </div>
    @endif

    @if(isset($relatados) && count($relatados) > 0)
        @else
            <div class="row" align="center" style="height: 18px;">
                <div class="col-sm-12">  <i style=" font-size: 30px; color: gray;" class="fas fa-history"></i>   </div>
                <div class="col-sm-12"> <h5 style="color: gray;"> <small > Não há deliberações para serem votadas no momento ! </small> </h5>  </div>
            </div>
    @endif


    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
        <div style="position:relative; top: -8px; ">
            @if(isset($relatados))
                @foreach($relatados as $key => $value)
                    <div class="card card-default_sa" style=" ">
                        <div class="card-header">
                            <!-- @ SESSÃO QUAL RELATOR  @ -->
                            <div class="row"  style="height: 18px;">
                                <div class="col-sm-3" style=" position:relative;  cursor: pointer;">
                                    <a href="#" style=" " id="{{$value->eProtocolo}}" onclick="moreInfo(this.id)" > 
                                        <u> <h5> <i class="fas fa-mouse-pointer"></i>  &nbsp <small> Mais informações clique aqui </small> </h5> </u> 
                                    </a>
                                </div>

                                <div class="col-sm-4" style=" position:relative;  cursor: pointer;">
                                    <a href="{{route('cpp.salavotacao.index')}}" style="margin-left: 35px;"> <u> Todos </u> </a>
                                    <a href="#" style="margin-left: 35px;"> <u style="color: black;"> Total: {{count($relatados)}} </u> </a>
                                </div>
                            </div>
                            <!-- @ @ -->
                        </div>

                        <div class="card-body  scrool_grid_salavotacao"  style="position: relative; top: -20px; max-height: 500px; ">
                            <form action=" {{route('cpp.salavotacao.create')}} " method="put" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        {{ Form::label('NOME', 'NOME', array('class' => 'awesome')) }}
                                        {{ Form::text('NOME', null, array('class'=>'form-control', 'placeholder'=>$value->nome,'value'=>$value->nome,'readonly')) }}

                                    </div>
                                    <div class="col-md-3 form-group">
                                        {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome')) }}
                                        {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'placeholder'=>$value->unidade,'value'=>$value->unidade, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('GRADUACAO', 'GRADUAÇÃO', array('class' => 'awesome')) }}
                                        {{ Form::text('GRADUACAO', null, array('class'=>'form-control', 'placeholder'=>$value->graduacao, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('CPF', 'CPF', array('class' => 'awesome')) }}
                                        {{ Form::text('CPF', null, array('class'=>'form-control', 'placeholder'=>$value->cpf, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('RG', 'RG', array('class' => 'awesome')) }}
                                        {{ Form::text('RG', null, array('class'=>'form-control', 'placeholder'=>$value->rg, 'readonly')) }}

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('eProtocolo', 'eProtocolo', array('class' => 'awesome')) }}
                                        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>$value->eProtocolo, 'readonly')) }}

                                    </div>
                                    <div class="col-md-4 form-group">
                                        {{ Form::label('PEDIDO', 'PEDIDO', array('class' => 'awesome')) }}
                                        {{ Form::text('eProtocolo', null, array('class'=>'form-control', 'placeholder'=>$value->pedido, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('STATUS', 'RG', array('class' => 'awesome')) }}
                                        {{ Form::text('STATUS', null, array('class'=>'form-control', 'placeholder'=>$value->status, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('DATA_ENTRADA', 'ENTRADA', array('class' => 'awesome')) }}
                                        {{ Form::text('DATA_ENTRADA', null, array('class'=>'form-control', 'placeholder'=>$value->entry_system_data, 'readonly')) }}

                                    </div>
                                    <div class="col-md-2 form-group">
                                        {{ Form::label('DATA_DO_EPROTOCOLO', 'DATA ePROTOCOLO', array('class' => 'awesome')) }}
                                        {{ Form::text('DATA_DO_EPROTOCOLO', null, array('class'=>'form-control', 'placeholder'=>$value->data_eProtocolo, 'readonly')) }}

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome')) }}
                                        <textarea readonly name=contain_ddeliber class=form-control rows='2' value="{{$value->conteudo}}"  > {{$value->conteudo}} </textarea>
                                    </div>
                                </div>

                                <!-- dropdown -->
                                <div class="dropdown">
                                    <button style="border:none; background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span style="color: blue;"> 
                                            Selecione um relator para filtrar eProtocolos, respectivos ao relator. &nbsp 
                                            <i class="fas fa-caret-down"></i> 
                                        </span>
                                    </button>

                                    <!-- dropdown-menu -->
                                    <div style="width: 50%;" class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <h5> <i class="far fa-id-card"></i> &nbsp Selecione o relator. </h5>
                                            </div>
                                        </div>
                                    
                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[0]))
                                                <a style="color: cian; " href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[0]->id ])}} ">
                                                    <h5 class=" ">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp 
                                                        {{$searchall[0]->name}} 
                                                    </h5>
                                                </a>
                                                @else   
                                                    <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->
                                        
                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[1]))
                                                <a style="color: cian;" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[1]->id ])}} ">
                                                    <h5 class=" ">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp
                                                        {{$searchall[1]->name}} 
                                                    </h5>
                                                </a>
                                                @else   
                                                    <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->

                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[2]))
                                                <a style="color:cian; " href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[2]->id ])}} ">
                                                    <h5 class="">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp
                                                        {{$searchall[2]->name}}
                                                    </h5>
                                                </a>
                                                @else   
                                                    <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->

                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[3]))
                                                <a style="color: cian; font-size: 13.56px" href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[3]->id ])}} ">
                                                    <h5 class="">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp
                                                        {{$searchall[3]->name}}
                                                    </h5>
                                                </a>
                                                @else   <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->

                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[4]))
                                                <a style="color:cian; " href="{{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[4]->id ])}} ">
                                                    <h5 class=" ">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp
                                                        {{$searchall[4]->name}}
                                                    </h5>
                                                </a>
                                                @else   
                                                    <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->

                                        <!-- dropdown-item linha -->
                                        <span class="dropdown-item">
                                            @if(isset($searchall[5]))
                                                <a style="color:cian;  " href=" {{ route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[5]->id ]) }} ">
                                                    <h5 class=" ">
                                                        <i class="far fa-user-circle"></i>
                                                        &nbsp &nbsp &nbsp{{$searchall[5]->name}}
                                                    </h5>
                                                </a>
                                                @else   
                                                    <span class=" "> "NÃO HÁ RELATOR" </span>
                                            @endif
                                        </span>
                                        <!-- dropdown-item linha -->
                                    </div>
                                    <!-- dropdown-menu -->
                                </div>
                                <!-- dropdown -->

                                <br>

                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <span> <strong> Comissão opnou por.: </strong> </span>
                                        <select name="ComissaoOpnou" class="custom-select" id="inputGroupSelect02" required>
                                             <option value="aprovar">   aprovar      </option>
                                            <option value="desaprovar"> desaprovar  </option>
                                            <option value="discordar"> discordar    </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <span> <strong> Comissão decidiu por.: </strong> </span>
                                        <select name="decisao_da_comissao"  class="custom-select" id="inputGroupSelect02" required>
                                            <option value="Indeferimento">    Indeferimento  </option>
                                            <option value="deferimento">     deferimento    </option>
                                            <option value="restituir">      restituir        </option>
                                            <option value="postergar">     postergar        </option>
                                            <option value="postergar">      encaminhamento  </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <span> <strong> Corum da Comissão.: </strong> </span>
                                        <select name="ComissaoCorum" class="custom-select" id="inputGroupSelect02" required>
                                            <option value="unanimidade">   unanimidade </option>
                                            <option value="maioria"> maioria </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <span> <strong> Condição desta Deliberação.: </strong>  </span>
                                        <select name="Condicao" class="custom-select" id="inputGroupSelect02" required>
                                            <option value="Apreciado">    Apreciado   </option>
                                            <option value="Relatado">     Relatado    </option>
                                            <option value="Postergado">   Postergado  </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- row -->

                                <input type="hidden" name="eProtocolo" value=" {{ $value->eProtocolo }} ">

                                <br>

                                <!-- row -->
                                <div class="row" align="center">
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-gavel"></i> Gerar Deliberação. </button>
                                    </div>
                                </div>
                                <!-- row -->
                            </form>
                        </div>
                        <!-- card body -->

                        <!-- Cortina que contem mais informações -->
                        <section id="" class="{{$value->eProtocolo}}" value="false" name="" style=" width: 100%; height:auto; position: absolute; top: 40px; display: none;">
                            <div style="border-radius: 5px; box-shadow: 0px 2px 2px 0px gray; max-height: 70vh; overflow-y: scroll; background-color: white; position: absolute; top: 4px; text-align: center; " align="center">
                                <!-- <div class="card" style="">
                                    <div class="card-header" align="center">
                                        Sobre a deliberação
                                    </div>
                                </div> -->
                                <br>
                                <div class="card" style="margin: auto; width: 100%;">
                                    <div class="card-header" align="center">
                                        <h5 style="color: #004B8D;"> <i style="float: left; font-size: 26px;" class="far fa-id-card"></i> Sobre a deliberação. Mais informações. </h5>
                                    </div>

                                    <!-- card-body -->
                                    <div class="card-body" style=">
                                        <h5 style="color: #004B8D;" class="card-title">
                                            <i class="far fa-user-circle"></i> 
                                            &nbsp Relator: &nbsp &nbsp {{$value->name}} 
                                        </h5>
                                        <br>
                                        
                                        <!-- table -->
                                        <table>
                                            <tr>
                                                <th>ID Relator</th>
                                                <th>{{$value->id_membro}}</th>
                                            </tr>

                                            <tr>
                                                <th>ID eProtocolo sorteado</th>
                                                <th>{{$value->id_eProtocolo_sorteados}}</th>
                                            </tr>
                                            
                                            <tr>
                                                <th>Data do eProtocolo</th>
                                                <th>{{$value->entry_system_data}}</th>
                                            </tr>

                                            <tr>
                                                <th>Última atualização</th>
                                                <th>{{$value->updated_at}}</th>
                                            </tr>

                                            <tr>
                                                <th>Relator votou</th>
                                                <th>Sim</th>
                                            </tr>

                                            <tr>
                                                <th>Relator opnou por</th>
                                                <th>{{$value->relator_opnou_por}}</th>
                                            </tr> 

                                            <tr>
                                                <th>Parecer do relator</th>
                                                <th>{{$value->parecer_relator}}</th>
                                            </tr>

                                            <tr>
                                                <th>Status</th>
                                                <th>{{$value->status}}</th>
                                            </tr>
                                        </table>
                                        <!-- table -->
                                        <br>
                                     </div>
                                     <!-- card-body -->
                                </div>
                            </div>
                        </section> 
                        <!-- Cortina que contem mais informações -->
                    </div> 
                    <!-- card card-default -->
                    <hr>  
                @endforeach
            @endif
        </div>
    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->

    <section>
        @if(session('excedeu'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-info-circle"></i>
                Info ! Exced ATA.: Não há ATA aberta no momento. Nenhuma ATA aberta pelo Presidente ainda ! <br>
                Sem ATA aberta não é possível prosseguir com a Deliberação !
            </div>
        @endif

        @if(session('is_not_has_president_or_secretary') == 'exxced')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-info-circle"></i>
                Info ! Is_Not_Has_President_or_Sercretary.: Não foi possível gerar deliberção, pois não há secretário ou presidente ativos.
            </div>
        @endif

        @if(isset($emptyrelatados))
            @if($emptyrelatados == false)
                <br> <br>
                <div style=" " class="alert alert-warning" role="alert" align="center">
                    <h5> <i style="float: left;" class="fas fa-user-alt-slash"></i> </h5>
                    <h4> <small> Nada encontrado para este relator. </small> </h4>
                </div>
            @endif
        @endif
    </section>

    <br>

    <!-- @ Script's @  -->
    <script>
        function moreInfo(e){
            var cn = document.getElementsByClassName(e); 
            if(cn[0].getAttribute('value') == 'false'){
                var r = $(cn).slideDown();
                cn[0].setAttribute('value', true);
            }else{
                var r = $(cn).slideUp();
                cn[0].setAttribute('value', false);
            }
            console.log(cn);
            console.log(r);
        }//moreInfo()
    </script>
    <!-- @ Script's @  -->

@endsection
