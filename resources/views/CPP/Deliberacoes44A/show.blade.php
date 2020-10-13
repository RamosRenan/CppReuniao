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

    
    <body style="width:100%; max-height: 300px; ">
        <header>            
            <div> 
                @lang('globalDocsCpp.header.deliberacao')
            </div>
        </header>

        <section style="width:99%; heigth:auto; position:relative; top:50px;">
            <div align="center"> 
                <span style="position: relative; top: -15px;"> <strong> <u> {{ $currentAta }} ª Reunião da Comissão de Promoções de Parças </u> </strong> </span>
                <h4> 
                    <strong>   
                        DELIBERAÇÃO Nº ____ / {{date('Y')}}
                    </strong>                
                </h4>
            </div>
        </section>    

        <section style="width:99%; heigth:auto; position:relative; top: 40px;">
            <div align="center" style="text-align:justify;">  
                <div style="width:94%; heigth:auto; margin:auto;">
                    <textarea readonly maxlength="1550" style="border:solid 1px #a5d8ff; width:100%; text-align:justify; " rows="8" cols="60">                        
                        {{ $dataThis44A }}
                    </textarea>
                </div>
            </div> 
        </section> 

        <!--@ Tabela Carregada com Ajax com votos dos relatores @-->         
        <section style="width:99%; heigth:auto; position:relative; top: 50px;">
            <!-- Table com mebros e seus votos -->
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
                    <!-- tr exclusivo para presidente -->
                    <tr> 
                        <td></td>
                        <td></td>
                        <td> 
                            <strong style="margin-left:4px;"> Presidente.:   </strong> 
                            <!-- percorre $presidenteSecretario até encontrar presidente --> 
                            @foreach($presidenteSecretario as $key)
                                @if($key->qualificacao == 'Presidente')
                                    <span> {{$key->posto}} {{$key->nome}} </span>
                                @endif
                            @endforeach
                        </td> 
                        <td></td> 
                    </tr>
                    <!-- /tr exclusivo para presidente -->

                    @if(isset($realtorThisDeliber))
                    <tr> 
                        <td align="center">-</td>
                        <td align="center">-</td>
                        <td align="center">{{$realtorThisDeliber[0]->posto}} {{$realtorThisDeliber[0]->nome}} &nbsp; &nbsp; <b>{{$realtorThisDeliber[0]->qualificacao}}</b></td> 
                        <td align="center"><b>**  Relator  **</b></td> 
                    </tr>
                    @endif

                    <!-- verifica se votou contra ou a favor -->
                    @if(isset($relationVote44A))
                        @foreach( $relationVote44A as $key )
                            <tr> 
                                <td align="center"> 
                                    @if($key->votou_contra) 
                                        <i class="fa fa-check" style="font-size:24px"></i> 
                                    @endif     
                                </td>
                                <td align="center"> 
                                    @if($key->votou_favoravel)  
                                        <i class="fa fa-check" style="font-size:24px"></i> 
                                    @endif 
                                </td>
                                <td> 
                                    {{$key->posto}} {{$key->nome}} &nbsp; &nbsp; <b>{{$key->qualificacao}}</b>
                                </td> 
                                <td> 
                                    <b> Assinado digitalmente. </b> 
                                    <span> {{$key->nome}}   </span> 
                                    <b> RG.: </b>           </span> 
                                    <span> {{$key->rg}}     </span>
                                </td> 
                            </tr>
                        @endforeach
                    @endif
                    <!-- @ Referência cada linha com nome único. @ -->
                </tbody> 
                <!-- @ And body table @ -->
            </table>
            <!-- Table com mebros e seus votos -->
        </section>          
        <!--@ Final Sessão: Tabela Carregada com Ajax com votos dos relatores @-->
    

        <!-- section que contém ícone para atualizar os votos dos relatores. -->
        <section style=" width:99%; heigth:auto; position:relative; top: 50px; " > 
            <div align="center" style=" position:relative; top: 15px;" >
                <!--  Carga de membros que ja votaram -->
                <a href="/cpp/updateVotoRelatoresDeliber44A?this44AeProtocolo={{$this44AeProtocolo}}"> 
                    <!-- ícone Atualiza os votos dos Relatores -->                        
                    <h3 class="glyphicon glyphicon-repeat" style=" color: gray; border-radius: 22px; box-shadow: 0px 2px 3px 1px #b5c3c9; cursor:pointer; " >  </h3> 
                    Atualizar votos.
                </a>
            </div>
        </section> 

        
        <!-- II - Lavre-se em Ata e arquive-se. -->
        <section style="width:100%; heigth:auto; position:relative; top: 70px;">
            <div style="margin-left:18px;"> 
                @lang('globalDocsCpp.comissaoVotacao.footer')
            </div>
        </section> 
        

        <!-- data da deliberação -->
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
                    Eu, <strong> Assinado digitalmente em: </strong>   <strong> RG: </strong>  ,  S,
                    Secretário da Comissão de Promoção de Praças, lavrei a presente deliberação.
                </span>
            </div>
        </section> 


        <section style=" width:100%; heigth:auto; position: relative; top: 230px; ">
            <div style=" " align="center"> 
                <form action="{{ route('cpp.deliberacao.edit', 0) }}" method="GET"> 
                    <input type="hidden" value=" {{ $this44A[0] ->id_notification}} " name="id_notification">
                    <input type="hidden" value=" {{ $this44AeProtocolo}} " name="id_44a">
                    <button type="submit"  id="validar" class="btn btn-primary btn-sm" style=" position: relative; top: 40px; box-shadow:0px 1px 5px gray; width: 400px;">
                        <i class="fa fa-check-square-o" style="font-size: 15px;"> </i> 
                        <span style="  font-family: 'Montserrat', sans-serif; color: white; position:relative;  "> Finalizar Deliberação 44A. </span> 
                    </button>
                </form>
            </div>
        </section> 

 
        <input type="hidden" value="  " id="facultyeProtoc" class="facultyeProtoc">

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
        
      