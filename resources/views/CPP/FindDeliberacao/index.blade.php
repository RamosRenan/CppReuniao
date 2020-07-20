@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

            <section style="position: relative; top: -50px;">
                <h5> <i class="fas fa-file-word"></i>  Encontre a Deliberação desejeda.  </h5>
            </section>


            <section> 

                <div class="card"> 
                    <div class="card-header"> 
                        <!-- @ form @ -->
                        <form align="center" action="{{ route('cpp.findeliberacao.show', 0) }}" method="get"> 

                            <div align="center" style="width: 100%; height: auto;"> 
                                <span> <i class="fas fa-filter" style="font-size: 22px;"></i> <h5> Informe os campos necessários. </h5> </span>
                            </div>

                            <hr>


                            <!-- @ container @ -->
                            <div class="container">
                                <!-- @ row @ -->
                                <div class="row">                                    
                                    <div class="col-sm"> </div>

                                    <div class="col-sm">
                                        <label> <h5> Número da Deliberação. </h5> </label>
                                        <input type="number" class="form-control" name="num_deliberacao" required >  
                                    </div>

                                    <div class="col-sm">
                                        <label> <h5> Número da ATA. </h5> </label>
                                        <input type="number" class="form-control" name="num_ata" required >
                                    </div>

                                    <div class="col-sm"> </div>
                                </div>
                                <!-- @ row @ -->
                            </div>
                            <!-- @ container @ -->

                            <br>

                            <div>
                                <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> Procurar. </button>
                            </div>

                        </form>
                        <!-- @ form @ -->
                    </div>
                </div>

            </section>




            <!-- @ Warning não encontrado deliber @ -->
            @if(session('notFoundDeliber') == 'false')
                <section> 
                    <div class="p-3 mb-2 bg-danger text-white"> <u> Nenhuma deliberação encontrada. Certifique-se quanto ao número da ata e deliberação. </u> </div>            
                </section>
            @endif



@endsection