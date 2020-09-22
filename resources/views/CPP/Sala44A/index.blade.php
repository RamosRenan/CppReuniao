@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">
@yield('content')

@section('content')
 
    <!-- @ SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL @ -->
    <!-- Sessão header View(cadastro_eProtocolo.index) -->
        <div style="position: relative;  max-height: 500px; overflow-y: scroll;">
            @if(isset($naoAlanisadosPorComissao))
                @foreach($naoAlanisadosPorComissao as $key) 
                    <div class="card card-default" style="">
                        <hr>
                        <div class="card-body">                                    
                            <form action=" {{route('cpp.sala44A.create')}} " method="PUT" >

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                    

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

                                <div class="row" align="center">
                                    <div class="col-md-12 form-group">
                                        {{ Form::label('CONTEUDO', 'CONTEUDO', array('class' => 'awesome')) }}
                                        <textarea readonly name=contain_ddeliber class=form-control rows='2' value="{{$key->conteudo}}"  > {{$key->descricao_pedido}} </textarea>
                                    </div>               
                                </div>

                                <div class="row" align="center">                             
                                    <div class="col-md-4">
                                        <span> Comissão opnou por.:  </span>
                                        <select name="ComissaoOpnou" class="custom-select" id="inputGroupSelect02" required>
                                            <option value="aprovar">    aprovar      </option>
                                            <option value="desaprovar"> desaprovar   </option>                                
                                            <option value="discordar">  discordar    </option>
                                        </select>                                
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <span> Status desta deliberação.  </span>
                                        <input name="decisao_da_comissao" value="Apreciado" type="text" class="custom-select" id="inputGroupSelect02" readonly required> </input>                                
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <span> Corum da Comissão.: </span>
                                        <select name="ComissaoCorum" class="custom-select" id="inputGroupSelect02" required>
                                            <option value="unanimidade">   unanimidade </option>
                                            <option value="maioria">        maioria    </option> 
                                        </select>                                
                                    </div>                                                                     
                                </div>

                                <input type="hidden" name="eProtocolo" value=" {{ $key->eProtocolo }} ">

                                <br>                                   

                                <div class="row" align="center">
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-gavel"></i> Gerar Deliberação. </button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBox" data-url=""><i class="fa fa-search"></i> Mais info. </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div><!-- card body -->        

                    </div> <!-- card card-default -->

                @endforeach

            @endif

            @if(isset($naoAlanisadosPorComissao) && count($naoAlanisadosPorComissao) > 0)
                @else
                    <div class="row" align="center" style="height: auto; max-width:100%;">
                        <div class="col-sm-12">  <i style=" font-size: 20px; color: gray;" class="fas fa-history"></i>   </div>
                        <div class="col-sm-12"> <h5  style="color: gray;"> <small> Não há deliberações para serem votadas no momento !  </small>  </h5></div>
                    </div>
    @endif


        </div>
            <!-- SESSÃO CONTEM GRID COM PEDIDO  DO POLICIAL -->
            @if(session('excedeu'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-info-circle"></i>
                    Info ! Exced ATA.: Não há ATA aberta no momento. Nenhuma ATA aberta pelo Presidente ainda ! <br>
                    Sem ATA aberta não é possível prosseguir com a Deliberação !
                </div>
            @endif


            @if(session('emptyRelatores'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-info-circle"></i>
                    Não é possível prosseguir com a deliberação. Não há relatores cadastrados. Peça ao Secretário que os cadastre.
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


