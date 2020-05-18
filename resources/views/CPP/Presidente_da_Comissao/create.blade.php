@extends('layouts.app')

@yield('content_header')

@yield('content')

@section('content')


    <!-- Sessão header View(cadastro_eProtocolo.index) -->
    <section style="width: 100%; height: auto;" > 
        
        <strong>  <h5>   <i class="fa fa-user-circle" style="font-size: 30px;" aria-hidden="true"></i>   Pagina do Relator. </h5> </strong>                  

    </section >
    <!-- Sessão header View(cadastro_eProtocolo.index) -->







    <form method="POST" action=" "> 

        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="card card-default">


            <!-- @ SESSÃO CONTEM OS WIDGETS DOS RELATORES ATIVOS @  # SESSÃO WIDGETS #-->
            <section style="margin-top: 10px; display:flex;" > 
                <div class="col-lg-0 col-12" >
                    <div class="small-box bg-info" >
                        <div class="inner" style="max-height: 50px;">
                            <h5> <i class="fas fa-user"></i> RELATOR </h5>

                            <p style="margin-top: -10px; cursor: pointer;"  > <a style="color:white;" href="#">Joãozinho Chico da Silva.</a> </p>
                        </div>

                        <div class="icon" style="max-height: 50px; ">
                            <i class="ion ion-stats-bars" style="margin-top: -27px;"></i>
                        </div>

                        <div class="icon" style="max-height: 50px; ">
                            <i class="ion ion-stats-bars" style="margin-top: -27px;"></i>
                        </div>

                        <a href="#" class="small-box-footer" style="max-height: 50px;">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        

                    </div>
                </div>
            </section> 



            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class='awesome'> Numero do E-Protocolo. </label>
                        <input class='form-control' required minlength = "12" oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 	11.111.111-1" name="sid" type="text">
                        
                    </div>

                    <div class="col-md-3 form-group">
                        <label class='awesome'> Pedido. </label>
                        <input class='form-control' required minlength = "12" oninput="mascara(this)" pattern="\([0-9]{2}\)\.([0-9]{3}\)\.([0-9]{3}\)\-([0-9]{1}\)$" placeholder="Ex.: 	11.111.111-1" name="sid" type="text">

                    </div>

                    <div class="col-md-2 form-group">                
                        <label class='awesome'> Data do eProtocolo. </label>
                        <input name="data_sid" required type='date' class='form-control'>

                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> Status. </label>
                        <input name="situacao" required type='text' class='form-control' readonly value='Cadastrado'>
                    
                    </div>                    
                    
                </div>




                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class='awesome'> Nome </label>
                        <input class='form-control' type="text"  name="Nome" style="" required>                        
                    </div>

                    <div class="col-md-3 form-group">
                        <label class='awesome'> Unidade </label>
                        <input class='form-control' type="text"  name="Unidade"  style="" required>                        
                    </div>

                    <div class="col-md-3 form-group">
                        <label class='awesome'> Graduacao </label>
                        <input  class='form-control' type="text"  name="Graduacao"  style="" required>
                    </div>

                    <div class="col-md-1 form-group">
                        <label class='awesome'> RG </label>
                        <input  class='form-control' type="text"  name="rg"  style="" required>
                    </div>

                    <div class="col-md-2 form-group">
                        <label class='awesome'> CPF </label>
                        <input  class='form-control' type="text"  name="cpf"  style="" required>
                    </div>

                </div> <!--@ row @-->




                <div class="row">
                    <div class="col-md-12 form-group">
                        <label class='awesome'> Descrição. </label>
                        <textarea rows='4' class='form-control' placeholder="Sua descrição" name="descricao" type="text" style="" required></textarea>
                    </div>                   
                    
                </div> <!--@ row @-->


                

                
                <hr>

                <label class='awsome' style="color: gray;"> Resolvo opnar por.: </label>




                <div class="row">                             
                    <div class="col-md-12">
                        <select class="custom-select" id="inputGroupSelect02">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>                                
                    </div>                                          
                </div>






                <div class="row">
                    <div class="col-md-12 form-group">
                        <label class='awesome' style="color: gray;"> Descrição do meu parecer. </label>
                        <textarea rows='4' class='form-control' placeholder="Sua descrição" name="descricao" type="text" style="" required></textarea>
                    </div>                   
                    
                </div> <!--@ row @-->






                <div class="row" >
                    <p> <button href="" class="btn btn-danger" type="submit"> <i class="fa fa-gavel" aria-hidden="true"></i> REGISTRAR MEU PARECER. </button> </p>                    
                </div> <!--@ row @-->


        </div> <!-- <div class="card-body"> -->
        </div> <!-- <div class="card-body"> -->
                   
    </form> <!-- Final Form --> 

<!-- Script's -->


@endsection


