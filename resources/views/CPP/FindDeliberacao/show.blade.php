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

     </head>


    
    <body>

 

        <header>            
            <div> 
                <a href=" {{route('cpp.findeliberacao.index')}} "> @lang('globalDocsCpp.header.deliberacao') </a>
            </div>
        </header>





        <section style="width:99%; heigth:auto; position:relative; top:50px;">
            <div align="center"> 
                <span style="position: relative; top: -15px;"> <strong> <u> {{$choiceDeliber[0]->numero_ata}}ª Reunião da Comissão de Promoções de Parças </u> </strong> </span>
                <h4> 
                    <strong>                           
                        D E L I B E R A Ç Ã O Nº {{$choiceDeliber[0]->num_deliberacao}} / {{ explode('-', $choiceDeliber[0]->date_create_deliberacao)[0] }}
                    </strong>                
                </h4>
            </div>
        </section>    



        <section style="width:99%; heigth:auto; position:relative; top: 40px;">
            <div align="center" style="text-align:justify;">  
               <div style="width:94%; heigth:auto; margin:auto;">
                    <textarea readonly maxlength="1550" style="font-family: 'Times New Roman', Times, serif; width:100%; resize:none; border:none; text-align:justify; overflow: hidden;" rows="12" cols="60">                        
                        {{ $choiceDeliber[0]->deliberacao }}                                  
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
                                @if( isset($all_memebers_voted_deliber[$i]) ) 
                                    @if(  $all_memebers_voted_deliber[$i]->votou_contra == 'true' )
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span> 
                                        @else
                                        <p> - </p>  
                                    @endif
                                @endif
                            </td>

                            <td class="favorable_vote{{$i}}" id="favorable_vote{{$i}}" align="center" >                     
                                @if( isset( $all_memebers_voted_deliber[$i] ) )
                                    @if( $all_memebers_voted_deliber[$i]->votou_favoravel == 'true' )
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span>
                                        @else
                                        <p> - </p>  
                                    @endif
                                @endif
                            </td>

                            <td> 
                                <div style="margin-left:4px;"> 
                                    @if( isset( $all_memebers_voted_deliber[$i] ) )
                                        <span>
                                            <strong> {{ $all_memebers_voted_deliber[$i]->qualificacao }} - </strong>  {{ $all_memebers_voted_deliber[$i]->posto }} {{ $all_memebers_voted_deliber[$i]->name }}
                                        </span>

                                        @else
                                        <span> NÃO HÁ RELATOR. </span>

                                    @endif
                                </div> 
                            </td> 

                            <td>                               
                                @if( isset( $all_memebers_voted_deliber[$i] ) )
                                    <div style=" margin-left: 4px;" class="assigned_deliber{{$i}}"   id="assigned_deliber{{$i}}">                                       
                                          
                                        <span> 
                                            Assinado digitalmente.: <strong> {{ date('d/m/Y \à\s H:i:s') }}. </strong>
                                        </span>

                                        <span> 
                                            Por.:<strong> {{$all_memebers_voted_deliber[$i]->name }}. </strong>
                                        </span>

                                        <span> 
                                            RG.:<strong> {{ $all_memebers_voted_deliber[$i]->rg }}    </strong>
                                        </span>

                                        @if( $all_memebers_voted_deliber[$i]->is_relator_from_this_pedido == "true" )
                                            <span style="font-size: 13px;"> <strong> *RELATOR* </strong> <span> 
                                        @endif
                                          
                                    </div>
                                    <span style=" display:none; font-size: 13px; " class="is_reporter" class="is_reporter{{$i}}"> <strong> # RELATOR # </strong> </span> 
                                @endif                            
                            </td>    

                        </tr>
                    @endfor

                </tbody> 
                <!-- @ And body table @ -->

            </table>
        </section>          
        <!--@ Final Sessão: Tabela Carregada com Ajax com votos dos relatores @-->
        
        
 

        

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
                <span> @lang('globalDocsCpp.comissaoVotacao.subfooter') </span>
            </div>
        </section> 






         



        



 
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
        
      