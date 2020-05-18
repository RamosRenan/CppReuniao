@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> </script>
@yield('content')

@section('content')

    <!-- Chart -->
    <section style="width: 100%; height: 200px; display: flex;"> 
        <div style="width: 50%; height: auto;">
            <canvas id="myChart" style="position: relative; left: 25px; background-color: white; border-radius: 13px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); " width="200" height="150"></canvas>
        </div>

        <div style="width: 30%; height: 500px; left: 150px; overflow-y: scroll; text-align: center; position: relative; background-color: white; border-radius: 13px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" align="center"> 
            <br>
            <h3> <u> Selecione o reltor. </u> </h1> 
            <br>
            @if(isset($CountIsertMembers))
                @foreach($CountIsertMembers as $key => $val)
                    <a href=" /cpp/gestaocontrole/create?id={{$val->id}} "> 
                        <h5> {{$val->name}} </h5> 
                    </a>
                @endforeach
            @endif
        </div>
    </section>
 

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
            label: '# of Votes',
            data: [getisset('PROM00SUB'), getisset('PROM1ºSGT'), getisset('PROM2ºSGT'), getisset('PROM3ºSGT'),  
            getisset('PROM00CB'), getisset('RESS00P'), getisset('RECLA00Q'), getisset('RET00P'), 
            getisset('RECON00A'), getisset('PON00P'), getisset('ATO00B'), getisset('SUB00J')],
            backgroundColor: [
                'black',
                ' #dc7633 ',
                ' orange ',
                ' #58d68d ',
                ' blue',
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
            borderWidth: 3
        }]
    },
    // options: {
    //     scales: {
    //         yAxes: [{
    //             ticks: {
    //                 beginAtZero: true,
    //                 min: 0,
    //                 max: 500
    //             }
    //         }]
    //     }
    // }
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