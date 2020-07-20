@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

<!-- crio nova ata -->        
<section style="position: relative; top: 10px;">
    <div class="card card-default"  style="position:relative;top: -18px;">

        <div class="card-header" style="height: 38px; " align="center"> 
            <span style="color:gray;"> Iniciar Nova Ata. </span> 
        </div>

        <div class="card-body" id="card__body4" style=""> 
            <div style="width:100%; height: 100%; " > 
                <div class="row" style="" align="center"> 
                    <h5 style="margin-left:8px;"> Total: {{count($lastAta)}}. </h5>  
                    <div class="col-12" >                                 
                        <table class="table" style=" ">
                            <thead>
                                <tr align="center">
                                    <th scope="col">ID.</th>
                                    <th scope="col">Numero da ATA.</th>
                                    <th scope="col">Data de Inicio.</th>
                                    <th scope="col">Data de Término.</th>
                                    <th scope="col">Responsável por finalizar.</th>
                                    <th scope="col">Visualizar.</th>
                                </tr>
                            </thead>

                            @if( isset($lastAta ))
                                @foreach( $lastAta as $key )
                                    <tbody>                                        
                                        <tr align="center">                                                
                                            <td > {{$key->id}}                     </td>
                                            <td > {{$key->numero_ata}}             </td>
                                            <td > {{$key->created_at}}             </td>
                                            <td > {{$key->updated_at}}             </td>
                                            <td > {{$key->response_finalized_ata}} </td>
                                            @if(empty($key->data_termino))
                                                <td > <button type="button" class="btn btn-outline-secondary" disabled> <i class="far fa-eye"></i> </button> </td>
                                                @else
                                                <td > <button type="button" class="btn btn-primary"> <i class="far fa-eye"></i> </button> </td>
                                            @endif
                                        </tr> 
                                    </tbody>
                                @endforeach
                            @endif

                        </table>
                    <div> 
                <div> <!-- row -->

                <div style="width:100%; height:1px; background:#ffbf00; margin-top:15px;"> </div>

                <br>

                <form method="GET" action="{{route('cpp.presidentecomissao.show', 0)}}">                                     
                    <!-- row -->
                    <div class="row">
                        <div class="col">
                            <input name="novAta" type="number" class="form-control" placeholder="Número da ATA">
                        </div>
                        <div class="col">
                            <input name="dataInAta" type="date" class="form-control" placeholder="Last name">
                        </div>
                        <div class="col">
                            <input name="dataOutAta" type="date" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                    <br>
                    <button style="font-size: 14px;" type="submit" class="btn btn-success"> <i class="fas fa-leaf"></i> Criar ata. </button>  
                </form> 
            </div>
        <div> <!-- card-body -->
    <div> 
</section>
<!-- crio nova ata -->

@if(session('DangerAtaFinalized'))
    <div class="alert alert-danger" role="alert">
        Existe ata aberta.
    </div>
@endif
            
<!-- @ SCRPT'S @ -->
<script type="text/javascript"> 

</script>
<!-- @ SCRPT'S @ -->


@endsection