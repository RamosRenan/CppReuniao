@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <section>
        <h3> <i class="fas fa-file-word"></i> <u> ATAs encontradas. </u> </h3>
    </section>


    <section> 
    
        <div style="max-heigth: 200px; overflow-y:scroll;"> 
            <table class="table table-bordered" style="box-shadow: 0px 0px 3px 2px gray;">

                <thead align="center" style="background: white;">
                    <th scope="col">ID</th>
                        <th scope="col">Numero da ATA.</th>
                        <th scope="col">Data de inicio.</th>
                        <th scope="col">Data de conclusão.</th>
                        <th scope="col">Responsável por finalizar.</th>
                        <th scope="col"> <i class="fas fa-archive"></i> </th>
                    </tr>
                </thead>
                                        
                <tbody align="center" >
                    @foreach($allAtas as $key)
                        <tr>
                            <th>-          </th>
                            <td>{{$key->numero_ata}}    </td>
                            <td>{{$key->data_inicio}}    </td>
                            <td>{{$key->data_termino}}  </td>
                            <td>{{$key->email}}         </td>
                            <td> <a href=" {{route('cpp.findata.create', ['numero_ata'=>$key->numero_ata] )}} "> <u> Visualizar </u> </a> </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
 
        </div>
 
    </section>
 

@endsection