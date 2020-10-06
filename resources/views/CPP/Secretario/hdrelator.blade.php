@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section style="position: absolute; top: 70px;"> 
        <div align="left"> 
            <h5 style=' color:lightslategray;'>  <i class="fas fa-users-cog"></i> Habilite e Desabilite Relatroes.  </h5>
        </div>
    </section>

 
    <div class="card-header" style="height: auto; margin-top: -30px;" align="center"> 
        <h5 style="color: #434c5e;"> Relator </h5> 
        <h5 style="color: #434c5e;"> <small> Habilitar | Desabilitar </small></h5> 
    </div>

    <!-- @ card__body3 @ -->
    <div class="card-body" id="card__body13" style="height: auto; margin-top: -5px;" align="center"> 

        <form method="GET" action="{{ route('cpp.presidentecomissao.create') }}">

        <div class="row">

            <div style="display:none;"> {{$y=0}} </div>

            @for( $i = 0; $i < count($allUser); $i++)

                <div class="col-4" style=" height:auto; "> 

                    <strong style=" position:relative; top:-6px;" class="Habilitar"> 

                        @if( $allUser[$i]->user_id_your_status == 1 )  
                            <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" checked  onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                            @else 
                                <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                        @endif
                                <label for="Habilitar"> Habilitar </label> 
                    </strong>

                    <strong style=" position:relative; top:-6px;" class="Desabilitar">
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

        <button type="submit" class="btn btn-success"> <i class="fas fa-hand-point-down"></i> Definir.</button>

        </form>
    
    </div>
    <!-- @ card__body3 @ -->

    <hr>

    <div class=" " style="height: auto;" align="left"> 
        <span style="color:#4c566a;"> 
            <i class="fas fa-info-circle"></i> <br>
            OBS.: Atenção ! Habilitar ou Desabilitar, significa que este relator pode ou não receber pedidos. 
            É <b> NECESSÁRIO </b> ir ate a pagina <a href="#" style="font-size:19px;"> <u> Cadastrar novo relator </u> </a> 
            para que de fato este relator conste nas votações das deliberações. 
            Caso contrário o sistema não o considera como relator APTO a receber pedidos. Desta forma o mesmo não poderá votar !
        </span>

        <br>
        <br>
        
        <button style="float: left;" type="button" class="btn btn-lg btn-warning" data-toggle="popover" title="Peeega o bizu !!!" 
        data-content="Pense a seguinte situação.: No momento que você define um relator(a), e para ele(a) são destinados eProtocolos, esse relator 
        passa a ter um histórico no sistema. Portanto é extremamente importante que este relator NÂO seja exluído do sistema, pois ele ainda poderá acessa-lo
        para consultar seus registros. Isso não significa que, uma vez, esse relator desabilitado, ainda estando cadastro como relator irá receber eProtocolos.
        Pois, para que o mesmo os receba, é necessário cadastrá-lo na sua area 'Inserir relator'.
        Quando um relator não pertencer mais á CPP, siga os passos: 1- Exclua o relator na sua área 'Inserir relator';  2- Apenas desabilite o relator nesta área.">
            <i class="fas fa-exclamation-triangle"></i> &nbsp Atenção clique aqui </u>
        </button>
    </div>

    <br>

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