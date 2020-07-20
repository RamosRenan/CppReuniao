@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')
    <!-- DONUT CHART -->
    <div class=" " style="width:100%; height:auto; display:flex;"  >
    <div class="card card-danger" style="width: 300px;">
        <div class="card-header" >
            <span style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[0]->name ) &&  $CountIsertMembers[0]->name !=null)
                    {{$CountIsertMembers[0]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- DONUT CHART -->
    <div class="card card-info" style="width: 300px; margin: auto;">
        <div class="card-header" >
            <span style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[1]->name ) &&  $CountIsertMembers[1]->name !=null)
                    {{$CountIsertMembers[1]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- DONUT CHART -->
    <div class="card card-warning" style="width: 300px;">
        <div class="card-header" >
            <span   style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[2]->name ) &&  $CountIsertMembers[2]->name !=null)
                    {{$CountIsertMembers[2]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    </div>
    <!-- /.card -->

    <!-- _________________________ -->

    <!-- DONUT CHART -->
    <div class=" " style="width:100%; height:auto; display:flex;"  >
    <div class="card card-light" style="width: 300px;">
        <div class="card-header" >
            <span   style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[3]->name ) &&  $CountIsertMembers[3]->name !=null)
                    {{$CountIsertMembers[3]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- DONUT CHART -->
    <div class="card card-dark" style="width: 300px; margin: auto;">
        <div class="card-header" >
            <span   style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[4]->name ) &&  $CountIsertMembers[4]->name !=null)
                    {{$CountIsertMembers[4]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- DONUT CHART -->
    <div class="card card-danger" style="width: 300px;">
        <div class="card-header" >
            <span   style="font-size: 12.5px;">
                @if(isset( $CountIsertMembers[5]->name ) &&  $CountIsertMembers[5]->name !=null)
                    {{$CountIsertMembers[5]->name}}
                @endif
            </span>
        </div>
        <div class="card-body" align="center">
            <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 150px;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    </div>
    <!-- /.card -->

    




    <!--
    <div style="width: 100%; text-align: center; position: relative; " > 
        <h4 style="color:#1864ab; "> <u> Selecione o reltor. </u> </h4> 
        <br>
        <div style="width: 100%; max-height: 80px; overflow-y: scroll;  text-align: center; position: relative; " align="center"> 
            @if(isset($CountIsertMembers))
                @foreach($CountIsertMembers as $key => $val)
                    <a href=" /cpp/gestaocontrole/create?id={{$val->id}} "> 
                        <small style=" "> <i class="fas fa-chevron-circle-right" style="color:magenta;"></i>   {{$CountIsertMembers[0]->name}}   </small> <br>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    -->
    <br>  

    <!-- Chart  
    <section style="width: 100%; height: auto; display: flex; " align="center"> 
        <div class="chart-container" style="  border-radius:100%; margin:auto; position: relative; height: 270px; width: 270px" >
            <canvas id="myChart" style="position: relative;" width="80" height="80"></canvas>
        </div>        
    </section>
    -->

    @if(isset($legendChart))
        @if(count($legendChart) > 0)
            @foreach($legendChart as $key => $val)
                <input type="hidden" class="{{$val->codigopedido}}" id="{{$val->codigopedido}}" name="{{$val->pedido}}" value="{{$val->total}}">
            @endforeach

            @else
                <div style="width: 50%; height: auto;" class="alert alert-warning" role="alert">
                    Nada encontrado para este relator ...
                </div>
        @endif
    @endif




<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Promoção à graduação  de Sub.Tenente QPM 1-0', 'Promoção à graduação  de 1º Sgt. QPM 1-0', 'Promoção à graduação  de 2º Sgt. QPM 1-0', 
                 'Promoção à graduação  de 3º Sgt. QPM 1-0', 'Promoção à graduação  de Cb. QPM 1-0', 'Ressarcimento de Preterição', 'Reclassificação do Quadro', 
                 'Retificação de publicação', 'Reconsideração de Ato', 'Pontos positivos', 'Ato de Bravura', 'Sub-Judice'],
        datasets: [{
            data: [getisset('PROM00SUB'), getisset('PROM1ºSGT'), getisset('PROM2ºSGT'), getisset('PROM3ºSGT'),  
            getisset('PROM00CB'), getisset('RESS00P'), getisset('RECLA00Q'), getisset('RET00P'), 
            getisset('RECON00A'), getisset('PON00P'), getisset('ATO00B'), getisset('SUB00J')],
            backgroundColor: [
                'black',
                ' #dc7633 ',
                ' orange ',
                ' #58d68d ',
                ' #1864ab',
                ' #2874a6 ',
                '  pink ',
                ' green',
                ' magenta ',
                '  yellow ',
                ' red ',
                ' #4a235a ',
            ],
            borderColor: [
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
                'white',
            ],
            borderWidth: 6
        }]
    },
    options: {
        legend: {
            display: false,
            labels: {
                fontColor: 'cian',
            }
        }
    }
});

function getisset(e){

    if(document.getElementById(e) === null){
        return 0;
    }else{
        return document.getElementById(e).value;
    }
    return 0;
}

</script>


 
@endsection