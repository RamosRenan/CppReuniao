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


    <!-- body -->
    <body>

        @if(session('empate')!= null)
            @if(session('empate'))
                <div class="alert alert-warning" role="alert">
                    Deliberação identificada com empate. Solicite ao Presidente que vote esta deliberação para prosseguir.
                </div>
            @endif
        @endif

        <header style="width: 100%; height: auto;">            
            <div style="width: 100%; height: 100px;"> 
                @lang('globalDocsCpp.header.deliberacao')
            </div>
        </header>

        <hr>
        <br>


        <section style="width:99%; heigth:auto; ">
            <div align="center"> 
                <span style="position: relative; top: -15px;"> <strong> <u> {{$redirect_this_page[0]->numero_ata}} ª Reunião da Comissão de Promoções de Parças </u> </strong> </span>
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



        <section style="width:99%; heigth:auto; ">
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
        <section style="width:99%; heigth:auto; ">
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
                        <td>   
                            @if(session('empate')!= null)
                                @if(isset( session('vote_president')[0]))
                                    @if( session('vote_president')[0]->votou_contra == 'true')
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span> 
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>  
                            @if(session('empate')!= null)
                                @if(isset( session('vote_president')[0]))
                                    @if( session('vote_president')[0]->votou_favoravel == 'true')
                                        <span class="glyphicon glyphicon-ok" id="glyphicon-ok2"   style=""></span> 
                                    @endif                                 
                                @endif
                            @endif
                        </td>
                        <td>                              
                            @if( isset( session('presidente')[0] ) )
                                <strong> Presidente: </strong>  {{session('presidente')[0]->nome}}.                                  
                                    @else
                                    <p> NÃO HÁ PRESIDENTE </p>                                   
                            @endif                        
                        </td> 
                        <td>    
                            @if(session('empate')!= null)
                                @if(session('empate'))
                                    <span> 
                                        Nome: {{session('presidente')[0]->nome}} Assinado digitalmente.: <strong> {{ date('d/m/Y \à\s H:i:s') }}. </strong>
                                    </span>                                  
                                @endif 
                            @endif 
                        </td> 
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
                                        <span> NÃO HÁ VOTO DO RELATOR. </span>

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


        <!-- @ Button update votos @ -->
        <!-- @ Carrega membros que ja votaram @ -->
        <section style="width:99%; heigth:auto; " > 
            <div align="center" style=" position:relative; top: 15px;" >
                <a href=" {{ route('cpp.deliberacao.show', $redirect_this_page[0]->eProtocolo ) }} "> 
                    <span class="glyphicon glyphicon-repeat" style=" font-size: 22px; color: darkgrey; border-radius: 22px; box-shadow: 0px 2px 3px 1px #b5c3c9; cursor:pointer; " > </span> 
                    <u> Atualizar votor </u>
                </a>
            </div>
        </section> 

        

        <section style="width:100%; heigth:auto;  ">
            <div style="margin-left:18px;"> 
                @lang('globalDocsCpp.comissaoVotacao.footer')
            </div>
        </section> 
        

        <br> <br>               

        
        <section style="width:100%; heigth:auto; ">
            <div align="center"> 
                <span>Curitiba, {{ date("d") }} de {{ date("M") }} de {{ date("Y") }}.</span>
            </div>
        </section> 


        <br> <br> <br>               


        <section style="width:100%; heigth:auto;">
            <div align="center"> 
                <span> <strong> Assinado digitalmente em: </strong> {{$redirect_this_page[0]->created_at}} <strong> </strong>
                <h4>    Maj. QOPM Omar Bail.       </h4> 
                <span> <strong> Presidente da CPP. </strong> <span>
            </div>
        </section> 

        <br> <br> <br> 
            
        <section style="width:100%; heigth:auto; position:relative; ">
            <div style="margin-left:18px;"> 
                <span>
                    Eu, <strong> Assinado digitalmente em: </strong> {{$redirect_this_page[0]->created_at}} <strong> RG: </strong> {{$presidenteSecretario[0]->rg}}, {{$presidenteSecretario[0]->posto}} {{$presidenteSecretario[0]->nome}},
                    Secretário da Comissão de Promoção de Praças, lavrei a presente deliberação.
                 </span>
            </div>
        </section> 

        <br> <br> 
        
        @if(session('empate'))
            <section style="width:100%; heigth:auto;  position:relative;">
                <div style="width:100%; heigth:auto;" align="center"> 
                    <form action="{{ route('cpp.deliberacao.edit', 0) }}" method="get"> 
                        <input type="hidden" value=" {{ $id_notification }} " name="id_notification">
                        @if(isset(session('vote_president')[0]))
                            <button type="submit"  id="validar" class="" style="width:30%; height:auto; position: relative;  box-shadow:0px 1px 5px gray; background: #034F84;">
                                <span style=" color:  white ; "> Finalizar Deliberação. </span>
                            </button>
                        @endif

                        @else
                            <div class="row" align="center" style="width: 99.9%;">
                                <button type="button"  id="validar" class="" style="width:30%; height:auto; position: relative;  box-shadow:0px 1px 5px gray; background: #034F84;" disabled>
                                    <span style=" color:  white ; "> Finalizar Deliberação. (Peça ao presidente que vote).  </span>
                                </button>
                            </div>
                    </form>
                </div>
            </section> 
        @endif

        <br> <br> 

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
        
      