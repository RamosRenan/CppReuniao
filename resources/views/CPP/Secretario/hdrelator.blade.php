@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section style="position: relative; top: -30px;"> 
        <div class="row" align="center"> 
            <h4 style='margin-left: 10px;  color:lightslategray;'>  <i class="fas fa-users-cog"></i> Habilite e Desabilite Relatroes.  </h4>
            </div>
    </section>

    <section style="position: relative; top: 0px;"> 

        <div class="card card-default"  style="position:relative; "> 

            <div class="card-header" style="height: auto;" align="center"> 
                <h3 style="color: #434c5e;"> Habilitar | Desabilitar </h3> 
            </div>

                <!-- @ card__body3 @ -->
            <div class="card-body" id="card__body13" style="height: auto;" align="center"> 

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

                    <button type="submit" class="btn btn-primary"> <i class="fas fa-hand-point-down"></i> Definir.</button>

                </form>
            
            </div>
            <!-- @ card__body3 @ -->

            <div class="card-header" style="height: auto;" align="center"> 
                <span style="color:#4c566a;"> <i class="fas fa-info-circle"></i> OBS.: Atenção ! Habilitar ou Desabilitar, significa que este relator pode ou não receber pedidos. 
                É <strong> NECESSÁRIO </strong>
                ir ate a pagina <a href="#" style="font-size:19px;"> <u> cadastrar novo relator </u> </a> para que de fato este relator conste nas votações das deliberações. 
                Caso contrário o sistema não o considera como relator. Desta forma o mesmo não poderá votar !
                </span>
            </div>

        </div>
        <!-- card default -->

    </section>
            



    <!-- @ SCRPT'S @ -->
    <script type="text/javascript"> 

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