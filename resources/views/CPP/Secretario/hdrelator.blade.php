@extends('layouts.app')

@yield('content_header')
    <!-- <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css">  -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section style="position: absolute; top: 70px;"> 
        <div align="left"> 
            <h5 style=' color:lightslategray;'>  <i class="fas fa-users-cog"></i> Habilite e Desabilite Relatroes.  </h5>
        </div>
    </section>

    <!-- @ card  @ -->
    <div class="card" id="card__body13" style="height: auto;  " align="center">
    
        <div class="card-header" style="height: auto;  " align="center"> 
            <h5 style="color: #434c5e;">   Habilitar/Desabilitar Relator  </h5> 
        </div> 


        <form method="GET" action="{{ route('cpp.presidentecomissao.create') }}">

            <div class="row">

                <div style="display:none;"> {{$y=0}} </div>

                @for( $i = 0; $i < count($allUser); $i++)

                    <div class="col-4" style=" height:auto; "> 

                        <br>

                        <strong style=" position:relative; " class="Habilitar"> 

                            @if( $allUser[$i]->user_id_your_status == 1 )  
                                <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" checked  onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                                @else 
                                    <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                            @endif
                                    <label for="Habilitar"> Habilitar </label> 
                        </strong>

                        <strong style=" position:relative; " class="Desabilitar">
                            @if( $allUser[$i]->user_id_your_status == 0 ) 
                                <input style="width: 18px; height:18px; margin-left:25px;" NAME="OPCAO{{$i}}" checked type="checkbox" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}" value="{{ $allUser[$i]->has_user_id.':'.'Desabilitar'.':'.$allUser[$i]->role_id }}" >  
                                @else
                                    <input style="width: 18px; height:18px; margin-left:25px;" NAME="OPCAO{{$i}}" type="checkbox" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}" value="{{ $allUser[$i]->has_user_id.':'.'Desabilitar'.':'.$allUser[$i]->role_id }}" >  
                            @endif
                                    <label for="Desabilitar"> Desabilitar </label> 
                        </strong>

                        @if( $allUser[$i]->user_id_your_status == 1 ) 
                            <input readonly style="background: #499ffc; color:white" class="form-control" value="{{ $allUser[$i]->name }} | ID: {{ $allUser[$i]->has_user_id }} | esc{{$y}} " id="{{$allUser[$i]->has_user_id}}" name="{{$allUser[$i]->has_user_id}}">  
                            @else   
                                <input readonly style="background: #e2e2e2; color:white" class="form-control" value="{{ $allUser[$i]->name }} | ID: {{ $allUser[$i]->has_user_id }} | esc{{$y}} " id="{{$allUser[$i]->has_user_id}}" name="{{$allUser[$i]->has_user_id}}">  
                        @endif

                        <input type="hidden" value="{{ count($allUser) }}" name="countMembers"> 
                        
                        <br>
                    </div>

                @endfor

            </div>

            <button type="submit" class="btn btn-success"> Definir </button>

        </form>

        <!-- @ card footer @ -->
        <div class="card-footer" style="height: auto;" align="left"> 
            <span style=" "> 
                Habilitar ou Desabilitar, significa que este relator pode ou não receber pedidos. 
                É <b> NECESSÁRIO </b> ir ate a pagina <a href="#" style=" ">  Cadastrar novo relator </a> 
                para que de fato este relator conste nas votações das deliberações. 
                Caso contrário o sistema não o considera como relator APTO a receber pedidos. Desta forma o mesmo não poderá votar.

                <button style=" border:none; " type="button" class=" " data-toggle="popover" title="Orientações ..." 
                    data-content="Pense a seguinte situação.: No momento que você define um relator(a), e para ele(a) são destinados eProtocolos, esse relator 
                    passa a ter um histórico no sistema. Portanto é extremamente importante que este relator NÂO seja exluído do sistema, pois ele ainda poderá acessa-lo
                    para consultar seus registros. Isso não significa que, uma vez, esse relator desabilitado, ainda que cadastrado como relator, este irá receber eProtocolos.
                    Pois, para que o mesmo os receba, é necessário cadastrá-lo na sua área ''Inserir relator''.
                    Quando um relator não pertencer mais á CPP,Apenas desabilite o relator nesta área.">
                    <a href="#"> Parana mais informações clique aqui </a>
                </button> 
            </span>
        </div>
        <!-- @ card footer @ -->
    
    </div>
    <!-- @ card @ -->
    

    <!-- @ SCRPT'S @ -->
    <script type="text/javascript"> 

        $(function () {
        $('[data-toggle="popover"]').popover()
        })

         

        function disableEnableUser(e, id, i){
            // var es = "esc".concat(i);
            // alert(es);
            var getClass = e.parentNode.getAttribute('class');
            if(getClass == 'Desabilitar'){                        
                var el = document.getElementById(id).style.background = "#e2e2e2"; 
                var es = "esc".concat(i-1); 
                document.getElementById(es).checked = false;
            }else{
                var el = document.getElementById(id).style.background = "#499ffc";
                var es = "esc".concat(i+1);
                document.getElementById(es).checked = false;
            }
            //alert(aalert.getAttribute('class'));
        }

    </script>
    <!-- @ SCRPT'S @ -->


@endsection