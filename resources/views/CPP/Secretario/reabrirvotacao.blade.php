@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')
    <br>
    <!-- @ Reabrir Votação.  @ -->
    <section style="position: relative; "> 
        <div class="card card-default"  style="position:relative; top:-30px;"> 
            <div class="card-header" style="height: 40px; " align="center"> 
                <h5 style="color: #009acd;">  
                    <i class="fas fa-lock-open"></i>  Reabrir Votação.  
                </h5> 
            </div>
                
            <!-- @ card__body7 @ -->
            <div class="card-body" id="card__body7" style="height: auto; "  align="center"> 
                <h5 style="color: #4c566a;"> <small> Ultimas deliberações. </small> </h5>
                <table class="table" style="border-radius: 9px; ">
                    <thead style=" border-radius: 9px; ">
                        <h5 style="float: right; color: #004B8D;"> <small> Total.:  {{ count($LastDeliberacao) }} </small> </h5>
                        <br>
                        <tr style="background: #494949; "  align="center">
                            <th scope="col" style="max-width: 55px; color: #dbdbdb;" > Open. </th>
                            <th scope="col" style="color: #dbdbdb;">eProtocolo.</th>
                            <th scope="col" style="color: #dbdbdb;">Pertence  ATA.</th>
                            <th scope="col" style="color: #dbdbdb;">Número Deliberação.</th>
                            <th scope="col" style="color: #dbdbdb;">Data Criação.</th>
                            <th scope="col" style="color: #dbdbdb;">Visualizar Deliberação.</th>
                            <th scope="col-1" style="color: #ed4754; max-width: 25px;">Reabrir.</th>
                            <th scope="col-1" style="color: green; max-width: 25px;">Fechar.</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if( isset($LastDeliberacao) )
                            @foreach($LastDeliberacao as $key)
                                <tr align="center">                                            
                                    <td> @if($key->read_at == null) <i style="color: orange; font-size: 25px;" class="fas fa-exclamation-triangle"></i> @endif </td>
                                    <td>{{ $key->eProtocolo }}          </td>
                                    <td>{{ $key->numero_ata }}          </td>
                                    <td>{{ $key->num_deliberacao }}     </td>
                                    <td>{{ $key->created_at }}          </td>
                                    <td> <a href=" {{ route('cpp.secretario.show', [$key->id_notification, 'visualizar'=>'visualizar'] ) }} "> <u> Visualzar.  </u> </a>
                                    <td> <a href="{{ route('cpp.secretario.show', [$key->id_notification, 'open'=>1]) }}"> <button type="button" class="btn btn-outline-danger"> <i class="far fa-folder-open"></i> </button></td> </a>
                                    <td> <a href="{{ route('cpp.secretario.show', [$key->id_notification, 'close'=>0]) }}"> <button type="button" style="color:#dbdbdb; border: solid 1px #dbdbdb;" class="btn btn-outline-success"> <i class="far fa-folder"></i> </button></td> </a>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table> 
                <br>
                <div class="row"  align="center"> 
                    <div class="col-2"> </div>
                        <div class="col-8"> 
                            <i style="color: orange;" class="fas fa-info-circle"></i>
                            <span style="color: #4c566a;">                                      
                                ! Atenção. Reabrir constantemente deliberações, poderá causar inconsistências no banco de dados. 
                                <hr>
                            </span>
                        </div>
                    <div class="col-2"> </div>
                </div> 

            </div>
            <!-- @ card__body7 @ -->
        </div>
    </section>
    <!-- @ Reabrir Votação.  @ -->

    <br>

@endsection