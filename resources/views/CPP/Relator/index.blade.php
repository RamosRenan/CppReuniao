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
    <div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> &nbsp Gerênciamento e controle. <b> Relator.</b>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fas fa-external-link-alt"  style="color:  #495057;" ></i> </h4>  
                    <h5 class="card-title" style=" "> Registrar 44-A </h5>
                    <a style=" " class=" "  href="/cpp/__44A" role=" " aria-controls="parecer44_A" aria-selected="true"> 
                        Exclusivo para 44A. Registro de parecer referente a 44a.
                    </a>
                    <br>
                    <a href="/cpp/__44A" class="btn btn-primary">Parecer 44a.</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fas fa-radiation-alt"  style="color:  orange;" ></i> </h4>  
                    <h5 class="card-title" style=" "> Corrigir voto </h5>
                    <a style=" " class=" "  href="{{ route('cpp.relator.show', 0) }}" role=" " aria-controls="parecer44_A" aria-selected="true"> 
                        Corrigir voto anteriormente registrado.
                    </a>
                    <br>
                    <a href="{{ route('cpp.relator.show', 0) }}" class="btn btn-primary">Corrigir voto.</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="far fa-clock" style="color:  #495057; "></i> </h4>  
                    <h5 class="card-title" style=" "> Postergados </h5>
                    <a style="color: #324AB2;" class=" "  href="\cpp\showParerPostergados" role="tab" aria-controls="Postergados">
                        Pareceres postergados.
                    </a>
                    <br>
                    <a href="\cpp\showParerPostergados" class="btn btn-primary">Postergados.</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fas fa-history"  style="color:  #495057;" ></i> </h4>  
                    <h5 class="card-title" style=" "> Histórico de pareceres </h5>
                    <a style="color: #324AB2;"  href="{{route('cpp.historyDeliberRelator.index')}}" role="tab" aria-controls="Meu_historico" >
                        Meu histórico. Acessar meus resgistros. Pareceres.
                    </a>
                    <br>
                    <a href="{{route('cpp.historyDeliberRelator.index')}}" class="btn btn-primary">histórico.</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="far fa-edit"  style="color:  #495057;" ></i> </h4>  
                    <h5 class="card-title" style=" "> Editar Parecer </h5>
                    <a style="color: #324AB2;" href="\cpp\editParecer" role="tab" aria-controls="Alterar_meu_parecer">
                        Alterar parecer. Aqui você poderá alterar(corrigir pareceres).
                    </a>
                    <br>
                    <a href="\cpp\editParecer" class="btn btn-primary">Editar parecer.</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fab fa-autoprefixer"  style="color:  #495057;" ></i> </h4>  
                    <h5 class="card-title" style=" "> Histórico 44-A </h5>
                    <a style="color: #324AB2;"  href="#contact" role="tab" aria-controls="Meus_44A">
                        Meus 44A
                    </a>
                    <br>
                    <a href=" " class="btn btn-primary">Histórico 44a.</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="background: transparent;">
                    <!-- container -->
                        <!-- row -->
                        <div class="row"  style="background: transparent;">
                            <div class="col-sm-4" style="background: transparent;">
                                <h2> <i class="far fa-list-alt"></i> Encaminhamentos de eprocolos da secretaria </h2>  
                                <h5 class="card-title" style=" "> <b> Pedidos encaminhados pela secretaria. </b> </h5>
                                <a style="color: #324AB2;"  href="#contact" role="tab" aria-controls="Meus_44A">
                                    eProtocolos emcaminhados. Atuais.
                                </a>
                                <br> <br>
                                <a href="\cpp\listPedidosRelator" class="btn btn-success"> 
                                    <i class="far fa-address-book"></i> &nbsp eProtocolos 
                                </a>
                            </div>

                            <div class="col-sm-4" align="center"> 
                                <h4> Pedidos a serem análisados. </h4>
                                <h5> 
                                    @if(isset($Usorteados) )
                                        @if(count($Usorteados) > 0 ) 
                                        <i class="fas fa-inbox" style="font-size: 35px;"></i> &nbsp <b style="color: #00BFFF;"> Total {{count($Usorteados)}} </b>
                                        @endif
                                    @endif
                                </h5>
                            </div>
                            
                            <!-- col-sm-3 -->
                            <div class="col-sm-4" align="center">
                                <!-- DONUT CHART -->
                                <div class="card card-info" style="width: 400px;">
                                    <div class="card-header" >
                                        <span style=" ">
                                            <h5> <i class="far fa-chart-bar"></i> &nbsp <small> Gerênciamento e controle. </small> </h5>
                                        </span>
                                    </div>
                                    <div class="card-body" align="center">
                                        <canvas id="myChart" style="min-height: 150px; height: 150px; max-height: 150px;  width: auto;"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                             <!-- col-sm-3 -->
                        </div>
                        <!-- row -->
                    <!-- container -->
                </div>
            </div>
        </div>
    </div>

    <!-- Informa se os pedidos acabaram -->
    @if(!isset($Usorteados) )
        @if(count($Usorteados) == 0 )
            <div style="width: 100%; height: auto; color: #4c566a;" align="center"> 
                <i class="fas fa-hourglass-end"></i> <br>
                <span > Seus pedidos acabaram.  </span> <br>
                <span> Aguarde novos sorteios de expedientes. </span>   
            </div>
        @endif
    @endif


    <!-- @ Todos os Alerts @ -->
    <section> 
        @if(session('nothen_turnback_deliber'))
            <div class="alert alert-danger" role="alert">
                Não há deliberação disponível para ser alterada. Solicite ao secretário(a) liberação.  
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



    <!-- ### BLOCO RESPONSÁVEL POR javascript ## -->
    <!-- ### javascript ## -->
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Promoção à graduação  de Sub.Tenente QPM 1-0', 'Promoção à graduação  de 1º Sgt. QPM 1-0', 'Promoção à graduação  de 2º Sgt. QPM 1-0', 
                        'Promoção à graduação  de 3º Sgt. QPM 1-0', 'Promoção à graduação  de Cb. QPM 1-0', 'Ressarcimento de Preterição', 'Reclassificação do Quadro', 
                        'Retificação de publicação', 'Reconsideração de Ato', 'Pontos positivos', 'Ato de Bravura', 'Sub-Judice'],
                datasets: [{
                    data: [55, 33, getisset('PROM2ºSGT'), getisset('PROM3ºSGT'),  
                    getisset('PROM00CB'), getisset('RESS00P'), getisset('RECLA00Q'), 4, 
                    getisset('RECON00A'), getisset('PON00P'),10, getisset('SUB00J')],
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


