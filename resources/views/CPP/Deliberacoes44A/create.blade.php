<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Sd. Renan - 07/2019">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        
        <title style="float:rigth;"> Deliberação </title>
    </head>


    
    <body>

     <br>

        <header>            
            <div> 
                @lang('globalDocsCpp.header.deliberacao')
            </div> 
        </header>




        <section style='position:absolute; top: 0px; cursor:pointer;'> 

            <div  style='position:relative; left: 15px; top: 15px; ' > 
                <a style="color: #d6d6d6; text-decoration-line: underline; font-family: 'Montserrat', sans-serif; "> <span class="glyphicon glyphicon-print"></span> Imprimir </a>
            </div>

        </section>





        <section style="width:99%; heigth:auto; position:relative; top:50px;">
            <div align="center"> 
                <span style="position: relative; top: -15px;"> <strong> <u> {{$redirect_this_page[0]->numero_ata}}ª Reunião da Comissão de Promoções de Parças </u> </strong> </span>
                <h4> 
                    <strong>   
                        {{
                            $respe = str_replace ( 
                                        array("++++"),
                                        array($redirect_this_page[0]->num_deliberacao), __('globalDocsCpp.titlecabecalho.deliberacao') 
                                    ) 
                        }} 
                    </strong>                
                </h4>
            </div>
        </section>    



        <section style="width:99%; heigth:auto; position:relative; top: 40px;">
            <div align="center" style="text-align:justify;">  
               <div style="width:94%; heigth:auto; margin:auto;">
                    <textarea readonly maxlength="1550" style="font-family: 'Times New Roman', Times, serif; width:100%; resize:none; border:none; text-align:justify; overflow: hidden;" rows="12" cols="60">                        
                        {{ 
                            $redirect_this_page[0]->deliberacao
                        }}                                      
                    </textarea>
                </div>
            </div> 
        </section> 





        <!--@ Tabela Carregada com Ajax com votos dos relatores @-->         
        <section style="width:99%; heigth:auto; position:relative; top: 50px;">
            <table align="center"  style="text-align:justify;">


                <thead> 
                    <tr>
                        <th style="font-size: 10px; min-width: 60px;"    >  <div align="center"> Voto<br>Contra.    </div>  </th>
                        <th style="font-size: 10px;  min-width: 60px;"   >  <div align="center"> Voto<br>Favorável. </div>  </th>
                        <th style="width: 260px; text-align:center;"     >  MEMBROS DA COMISSÃO                             </th>
                        <th style="min-width: 330px; text-align:center; ">  ASSINATURA                                      </th>
                    </tr>
                </thead>
                

                <!-- @ body table @ -->
                <tbody>

                    <tr> 
                        <td>                                                            </td>
                        <td>                                                            </td>
                        <td> <strong style="margin-left:4px;"> Presidente.: </strong>   </td> 
                        <td>                                                            </td> 
                    </tr>

                    <!-- @ Referencia cada linha com nome único. @ -->
                    @for($i = 0; $i < 6; $i++)
                        <tr> 
                            <td class="vote_against{{$i}}"   id="vote_against{{$i}}" align="center" >                    
                                @if( isset( session('all_memebers_voted_deliber')[$i] ) )
                                    @if( session('all_memebers_voted_deliber')[$i]->votou_contra == 'true' )
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span> 
                                        @else
                                        <p> - </p>  
                                    @endif
                                @endif
                            </td>

                            <td class="favorable_vote{{$i}}" id="favorable_vote{{$i}}" align="center" >                     
                                @if( isset( session('all_memebers_voted_deliber')[$i] ) )
                                    @if( session('all_memebers_voted_deliber')[$i]->votou_favoravel == 'true' )
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span>
                                        @else
                                        <p> - </p>  
                                    @endif
                                @endif
                            </td>

                            <td> 
                                <div style="margin-left:4px;"> 
                                    @if( isset( session('all_memebers_voted_deliber')[$i] ) )
                                        <span>
                                            <strong> {{ session('all_memebers_voted_deliber')[$i]->qualificacao }} - </strong>  {{ session('all_memebers_voted_deliber')[$i]->posto }} {{ session('all_memebers_voted_deliber')[$i]->name }}
                                        </span>

                                        @else
                                        <span> NÃO HÁ RELATOR. </span>

                                    @endif
                                </div> 
                            </td> 

                            <td>                               
                                @if( isset( session('all_memebers_voted_deliber')[$i] ) )
                                    <div style=" margin-left: 4px;" class="assigned_deliber{{$i}}"   id="assigned_deliber{{$i}}">                                       
                                          
                                        <span> 
                                            Assinado digitalmente.: <strong> {{ date('d/m/Y \à\s H:i:s') }}. </strong>
                                        </span>

                                        <span> 
                                            Por.:<strong> {{ session('all_memebers_voted_deliber')[$i]->name }}. </strong>
                                        </span>

                                        <span> 
                                            RG.:<strong> {{ session('all_memebers_voted_deliber')[$i]->rg }}    </strong>
                                        </span>

                                        @if( session('all_memebers_voted_deliber')[$i]->is_relator_from_this_pedido == "true" )
                                            <span style="font-size: 13px;"> <strong> *RELATOR* </strong> <span> 
                                        @endif
                                          
                                    </div>
                                    <span style=" display:none; " class="is_reporter" class="is_reporter{{$i}}"> <strong> # RELATOR # </strong> </span> 
                                @endif                            
                            </td>    

                        </tr>
                    @endfor

                </tbody> 
                <!-- @ And body table @ -->

            </table>
        </section>          
        <!--@ Final Sessão: Tabela Carregada com Ajax com votos dos relatores @-->



      

        <section style="width:99%; heigth:auto; position:relative; top: 50px;" > 
            <div align="center" style=" position:relative; top: 15px;" >
                <!-- @ Carga de membros que ja votaram @ -->
                <a href=" {{ route('cpp.deliberacao.show', $redirect_this_page[0]->eProtocolo ) }} "> 
                    <span class="glyphicon glyphicon-repeat" style=" font-size: 22px; color: #d1d1d1; border-radius: 22px; box-shadow: 0px 2px 3px 1px #b5c3c9; cursor:pointer; " > </span> 
                </a>
            </div>
        </section> 



        

        <section style="width:100%; heigth:auto; position:relative; top: 70px;">
            <div style="margin-left:18px;"> 
                @lang('globalDocsCpp.comissaoVotacao.footer')
            </div>
        </section> 
        


        

        
        <section style="width:100%; heigth:auto; position:relative; top:100px;">
            <div align="center"> 
                <span>Curitiba, {{ date("d") }} de {{ date("M") }} de {{ date("Y") }}.</span>
            </div>
        </section> 







        <section style="width:100%; heigth:auto; position:relative; top:130px;">
            <div align="center"> 
                <h4>    Maj. QOPM Omar Bail.       </h4> 
                <span> <strong> Presidente da CPP. </strong> <span>
            </div>
        </section> 
            
            




            
        <section style="width:100%; heigth:auto; position:relative; top: 180px;">
            <div style="margin-left:18px;"> 
                <span>
                    Eu, <strong> Assinado digitalmente em: </strong> {{$redirect_this_page[0]->created_at}} <strong> RG: </strong> {{$presidenteSecretario[0]->rg}}, {{$presidenteSecretario[0]->posto}} {{$presidenteSecretario[0]->nome}},
                    Secretário da Comissão de Promoção de Praças, lavrei a presente deliberação.
                </span>
            </div>
        </section> 






        <section style=" width:100%; heigth:auto; position:relative; top: 180px; ">
            <div style=" " align="center"> 
                <form action="{{ route('cpp.deliberacao.edit', 0) }}" method="GET"> 
                    <input type="hidden" value=" {{ $id_notification }} " name="id_notification">
                    <button type="submit"  id="validar" class="btn btn-default btn-sm" style=" position: relative; top: 60px; box-shadow:0px 1px 5px gray; width: 100%;">
                        <i class="fa fa-check-square-o" style="font-size: 25px;"></i> 
                        <strong style="  font-family: 'Montserrat', sans-serif; color: #286582; position:relative; top: -4px;"> ! FINALIZAR DELIBERAÇÃO DEFINITIVAMENTE. E submter para ATA. </strong> 
                    </button>
                </form>
            </div>
        </section> 



        



        <input type="hidden" value=" {{$redirect_this_page[0]->id}} " id="facultyeProtoc" class="facultyeProtoc">

        <!-- @ Style @ -->
        <style>

            table, th, td{
                border: 1px solid black;
                border-collapse: collapse;
            }            
           
        </style>
        <!-- Style -->

            



            
        <!-- @ Script's @ -->
        <script  type="text/javascript"> 

            // var myVar = setInterval(RequestNotification, 3000);           
            function RequestNotification(){
                $.ajax({
                    type: 'GET',
                    url: "http://localhost:8000/cpp/deliberacao/show",
                    data: {'rew': $('#facultyeProtoc').val() },
                    datatype:'html',
                    success:function(data){

                        console.log(data);

                        for (let i = 0; i < data.length; i++){ //for01
                            for (let j = 0; j < data[i].length; j++) {//for02
                                for (let k = 0; k < data[i][j].length; k++) {//for03
                                    console.log( data[i][j][k].name ); 
                                    console.log( data[i][j].length );

                                    if( data[i][j].length > 0){ //if()
                                        if( data[i][j][k].name == 'votou_contra' ){//if()
                                            $('#vote_against'+j).append( "true" );
                                            }else{ //else
                                            $('#favorable_vote'+j).append( "true" );
                                        } //else()
                                        var stylo = {
                                            display: 'block',
                                        };
                                        $('#member_assigned'+j).append(data[i][j][k].name);
                                        $('#assigned_deliber'+j).css(stylo);
                                        $('#assigned_deliber'+j).css(stylo);

                                    }//if()

                                }//for01
                            }//for02
                        } //for03
                         

                        console.log(data[0][0]);              
                
                       if(data.length > 0){
                        clearInterval(myVar);
                       }
                    },
                    error:function(){
                    }
                });
            
            }






            function hiddenvalidar(){
                alert('Realmente deseja inserir esta deliberação na ATA ?');
                document.getElementById('validar').style.display = 'none';
            }//hiddenvalidar





            function Click_glyphicon_ok(i){

                if(document.getElementById(i.children[0].id).style.getPropertyValue("display") ==  "none"){
                    document.getElementById(i.children[0].id).style.display = "block";                            
                }else{
                    document.getElementById(i.children[0].id).style.display = "none";
                }                        

            }//Click_glyphicon_ok
           




            function hasclicked_voto_user(i){

                var res_value_user = document.getElementById(i.children[0].id).getAttribute('value');

                    if(res_value_user == auth_login_now){
                        document.getElementById(i.children[0].id).style.display = "block";
                            
                }

            }//hasclicked_voto_user()




        </script>
        <!-- Script's -->

            
    </body>
</html>
        
      