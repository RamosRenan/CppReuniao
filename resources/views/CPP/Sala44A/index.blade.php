@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
@yield('content')

@section('content')

 
    @if(isset($naoAlanisadosPorComissao) && count($naoAlanisadosPorComissao) > 0)
        @else
            <div class="row" align="center" style="height: 18px;">
                <div class="col-sm-12">  <i style=" font-size: 50px; color: #eaeaea;" class="fas fa-history"></i>   </div>
                <div class="col-sm-12">  <i style=" font-size: 250px; color: #eaeaea;" class="fas fa-couch"></i>   </div>
                <div class="col-sm-12">  <strong> <small style="color: #c4c4c4;"> <h5> Não há deliberações para serem votadas no momento ! </h5> </small> </strong>   </div>
                <div class="col-sm-12">  <strong> <small style="color: #c4c4c4;"> <h5> `|°__°|´ </h5> </small> </strong>   </div>
            </div>
    @endif



        <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
        <!-- Sessão header View(cadastro_eProtocolo.index) -->
            <div class="scrool_grid_salavotacao" style="position: relative; top: -10px;">
                @if(isset($naoAlanisadosPorComissao))
                    @foreach($naoAlanisadosPorComissao as $key)  
                        <div class="card card-default">
                            <div class="card-body">                                    
                                <form action=" {{route('cpp.sala44A.create')}} " method="PUT" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!--
                                    <select id="cars" name="carlist" form="carform" style="float:right; border-radius:4px;">
                                        <option value="volvo" selected>Selecione os Relatores</option>

                                        <option value=" ">
                                            @if(isset($searchall[0])) 
                                                <a style=" " href=" {{route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[0]->id ])}} "> 
                                                    <i class="fas fa-user"></i> {{$searchall[0]->name}}  
                                                </a> 
                                                @else   "NÃO HÁ RELATOR   
                                            @endif 
                                        </option>

                                        <option value=" ">
                                            @if(isset($searchall[1])) 
                                                <a style="" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[1]->id ])}} "> 
                                                    <i class="fas fa-user"></i> {{$searchall[1]->name}} 
                                                </a> 
                                                @else   "NÃO HÁ RELATOR"    
                                            @endif
                                        </option>

                                        <option value=" ">
                                            @if(isset($searchall[2])) 
                                                <a style=" " href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[2]->id ])}} "> 
                                                    <i class="fas fa-user"></i> {{$searchall[2]->name}} 
                                                </a>
                                                @else   "NÃO HÁ RELATOR"   
                                            @endif  
                                        </option>

                                        

                                        <option value=" ">
                                            @if(isset($searchall[3])) 
                                                <a style="color:white;" href=" {{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[3]->id ])}} ">  
                                                    {{$searchall[3]->name}} 
                                                </a> 
                                                @else   "NÃO HÁ RELATOR"    
                                            @endif  
                                        </option>

                                        <option value=" ">
                                            @if(isset($searchall[4])) 
                                                <a style="color:white;" href="{{route('cpp.novosexpedientes.create', ['user_membro'=>$searchall[4]->id ])}} "> 
                                                    {{$searchall[4]->name}} 
                                                </a> 
                                                @else   "NÃO HÁ RELATOR"   
                                            @endif 
                                        </option>

                                        <option value=" ">
                                            @if(isset($searchall[5])) 
                                                <a style="color:black;" href=" {{ route('cpp.novosexpedientes.show', ['user_membro'=>$searchall[5]->id ]) }} "> 
                                                    {{$searchall[5]->name}} 
                                                </a> 
                                                @else   "NÃO HÁ RELATOR"    
                                            @endif 
                                        </option>
                                    </select>
                                    -->

                                    <div class="row">
                                        <div class="col-md-5 form-group" align="center">
                                            {{ Form::label('NOME', 'NOME', array('class' => 'awesome')) }}
                                            {{ Form::text('NOME', null, array('class'=>'form-control', 'placeholder'=>$key->nome,'value'=>$key->nome,'readonly')) }}
                                            
                                        </div>

                                        <div class="col-md-5 form-group" align="center">
                                            {{ Form::label('UNIDADE', 'UNIDADE', array('class' => 'awesome')) }}
                                            {{ Form::text('UNIDADE', null, array('class'=>'form-control', 'placeholder'=>$key->unidade,'value'=>$key->unidade, 'readonly')) }}
                                        
                                        </div>

                                        <div class="col-md-2 form-group" align="center">                
                                            {{ Form::label('GRADUACAO', 'GRADUAÇÃO', array('class' => 'awesome')) }}
                                            {{ Form::text('GRADUACAO', null, array('class'=>'form-control', 'placeholder'=>$key->graduacao, 'readonly')) }}

                                        </div>

                                        <div class="col-md-2 form-group" align="center">
                                            {{ Form::label('CPF', 'CPF', array('class' => 'awesome')) }}
                                            {{ Form::text('CPF', null, array('class'=>'form-control', 'placeholder'=>$key->cpf, 'readonly')) }}
                                        
                                        </div>

                                        <div class="col-md-3 form-group" align="center">
                                            {{ Form::label('RG', 'RG', array('class' => 'awesome')) }}
                                            {{ Form::text('RG', null, array('class'=>'form-control', 'placeholder'=>$key->rg, 'readonly')) }}
                                        
                                        </div>

                                        <div class="col-md-3 form-group" align="center">
                                        {{ Form::label('eProtocolo', 'eProtocolo', array('class' => 'awesome')) }}
                                            {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>$key->eProtocolo, 'readonly')) }}
                                            
                                        </div>

                                        <div class="col-md-4 form-group" align="center">
                                        {{ Form::label('DATA_DO_EPROTOCOLO', 'Entrada no sistema', array('class' => 'awesome')) }}
                                            {{ Form::text('DATA_DO_EPROTOCOLO', null, array('class'=>'form-control', 'placeholder'=>$key->created_at, 'readonly')) }}
                                            
                                        </div>
                                        
                                    </div>


                                    <br>
                                

                                    <div class="row" align="center">
                                        <div class="col-md-12 form-group">
                                            {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome')) }}
                                            <textarea readonly name=contain_ddeliber class=form-control rows='4' value="{{$key->conteudo}}"  > {{$key->descricao_pedido}} </textarea>
                                        </div>               
                                    </div>



                                    <div class="row">                             
                                        <div class="col-md-4">
                                            <span> Comissão opnou por.:  </span>
                                            <select name="ComissaoOpnou" class="custom-select" id="inputGroupSelect02" required>
                                                <option value="">  </option>
                                                <option value="aprovar">   aprovar      </option>
                                                <option value="desaprovar"> desaprovar  </option>                                
                                                <option value="discordar"> discordar    </option>
                                            </select>                                
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <span> Comissão decidiu por.:  </span>
                                            <select name="decisao_da_comissao"  class="custom-select" id="inputGroupSelect02" required>
                                                <option value="">  </option>
                                                <option value="Indeferimento">    Indeferimento  </option>
                                                <option value="deferimento">     deferimento    </option>                                
                                                <option value="restituir">      restituir        </option>                                
                                                <option value="postergar">     postergar        </option> 
                                            </select>                                
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <span> Corum da Comissão.: </span>
                                            <select name="ComissaoCorum" class="custom-select" id="inputGroupSelect02" required>
                                                <option value="">  </option>
                                                <option value="unanimidade">   unanimidade </option>
                                                <option value="maioria"> maioria           <option> 
                                            </select>                                
                                        </div>                                                                     
                                    </div>


                                    <input type="hidden" name="eProtocolo" value=" {{ $key->eProtocolo }} ">

                                    <br>                                   


                                    <div class="row" align="center">
                                        <div class="col-md-12 form-group">
                                            <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-gavel"></i> Gerar Deliberação. </button>
                                        </div>
                                    </div>
                                    <a href="#"> <u> <small> Mais informações </small> </u> </a>
                                </form>
                            </div><!-- card body -->                                
                        </div> <!-- card card-default -->
                        <br> 
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

        </section>


@endsection


