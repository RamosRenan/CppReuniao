<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Sd. Renan - 07/2019">
        <title>Doc. Ata</title>
    </head>

    <body>
    <br>
    <div style="width: 100%; height: 100vh; margin: auto; border: solid 1px black;">
    <div style="width: 95%; height: auto; margin: auto;">
        <!-- @ POLÍCIA MILITAR DO PARANÁ COMANDO-GERALCOMISSÃO DE PROMOÇÃO DE PRAÇAS @ -->
        <header>
            <div>
                 <div align="center">
                    <h4 style="font-family: 'Times New Roman', Times, serif; ">
                        <strong>
                            @lang('globalDocsCpp.comissaoVotacao.header.ata')
                        </strong>
                    </h4>
                </div>
                <hr>
            </div>
        </header>
        <!-- @  And  @ -->


        <br> <br> <br> <br>



        <!-- @ Publique-se. Coronel ........., Comandante-Geral da PMPR. @ -->
        <div style="float:right; font-family: 'Times New Roman', Times, serif;  "> <span> <strong> @lang('globalDocsCpp.comissaoVotacao.sub_header_cel.ata')  </strong> </span> </div>
        <!-- @   @ -->


        <br> <br> <br> <br>



        <!-- @ “Reunião Ordinária” ATA DA XXXXª REUNIÃO DA COMISSÃO DE PROMOÇÕES DE PRAÇAS @ -->
        <div style="width:100%; height:auto;" align="center">
            <br> <br> <br> <br>
            <h4 style="font-family: 'Times New Roman', Times, serif; ">
                "Reunião Ordinária"
            </h4>

            <h4 style="font-family: 'Times New Roman', Times, serif; ">
                <strong>              

                     {{
                        $resp = str_replace (
                                    array("XXXX"),
                                    array($AtaContent[0]->numero_ata), __('globalDocsCpp.comissaoVotacao.title.ata')
                                )
                    }}
                </strong>
             </h4>
        </div>
        <!-- @  @ -->


        
        <!-- @ Trato dos assuntos @-->
        <!-- @ REUNIÃO DA COMISSÃO DE PROMOÇÃO DE PRAÇAS. @-->
        <section>
            <div style="width:100%; height:auto;">
                <div style="width:94%; height:auto; margin:auto; text-align:justify;"> 
                    <span style="font-size:18px; font-family: 'Times New Roman', Times, serif; " > 
                    {{
                        $resp = str_replace ( 
                                    array("<strong>", "</strong>"),
                                    array("", ""), $AtaContent[0]->INTRODUCAO_REAUNIAO_ORDINARIA 
                                ) 
                    }}                         
                    </span> 
                </div>
            </div>
        </section> 
        <!-- @  @-->


        <br> <br> <br> <br>  



        <!-- @ 1. SORTEIO DE NOVOS EXPEDIENTES  @ -->
        <section> 
            <div style="width: 100%; height:auto; display:flex;">                     
                <h4> <strong>1.</strong> <u style="margin-left: 2px; color:black;  "> @lang('globalDocsCpp.comissaoVotacao.NewCaseFile.ata') </u> </h4>
            </div>
            
            <div style="width: 100%; height:auto; text-align: left;"> 
                    @foreach($totcadastrado as $key => $value)
                    <p> 
                        <b> 1.{{$key = $key + 1}} </b> 
                        Requerimento impetrado pelo <b> {{$totcadastrado[$key-1]->graduacao}} {{$totcadastrado[$key-1]->nome}}, 
                        RG: {{$totcadastrado[$key-1]->rg}} </b>, pertencente ao <b> {{$totcadastrado[$key-1]->unidade}} </b>, no qual solicita  
                        <b> {{$totcadastrado[$key-1]->pedido}} (Ref.: PID nº {{$totcadastrado[$key-1]->eProtocolo}})</b>. 
                        <br> 
                    </p> 
                    @endforeach
            </div>             
        </section> 
        <!-- @    @ -->



        <br>



        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.homologation.ata @ -->
        <section> 
            <div style="width: 100%; height:auto; display:flex;">                    
                <div> 
                    <strong>2.</strong> 
                    <span  style=" font-size: 15px;" > <strong><u>HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIMENTO</u> </strong></span>
                </div>
            </div>                    
        </section> 
        <!-- @ @ -->



        <br>
 


        <!-- @ 2. 2.1. TRANSCRIÇÃO DA RESOLUÇÃO Nº 001, DE 15 DE MARÇO DE 2019 comissaoVotacao.title.sumula.homologation.Sargentos.ata @ -->
        <section> 
            <div style="width: 100%; height:auto; text-align:justify; " > 
                <div align="center" > <span style="font-size: 14px;">  <strong> <u> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.Sargentos.ata') </u> </strong> </span> </div>  
            </div> 
        </section> 
        <!-- @   @ -->

 


        <!-- @ 2. Súmula comissaoVotacao.sumula.homologation.Sargentos.ata @ -->
        <section> 
            <div style="width: 100%; height:auto; text-align:justify; ">                                 
                <span style=" " >                    
                    <strong> Súmula </strong>: Dispõe sobre o deferimento de requerimentos e os respectivos registros de pontos positivos na ficha de merecimento dos Cabos e Soldados. <br> <br>  
                    A Comissão de Promoção   de Praças da PMPR, no uso de suas atribuições legais previstas no Art. 4º, inciso VIII, da Lei Estadual nº 5.940, de 8 de maio de 1969 (LPP),  
                    com fulcro no Art. 36, também da LPP e na Portaria do CG nº 635/1999, publicada no Boletim Geral nº 165/1999, considerando o cumprimento dos requisitos legais, resolve:   <br> <br>
                    <strong> Art. 1º </strong> Deferir, por unanimidade de votos, os requerimentos impetrados pelos militares estaduais e protocolados na Secretaria da Comissão de Promoção  
                    de Praças, e conseqüentemente determinar ao respectivo Secretário que <strong> registre na Ficha de Merecimento dos Cabos e Soldados </strong> abaixo relacionados, conforme adiante se especifica: 
                </span>
            </div>                    
        </section> 
        <!-- @   @ -->



        <br> <br>




        <!-- @ FICHA DE MERECIMENTO DOS *SARGENTOS*  @ -->
        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span>
        
        <br><br>

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'I')
                @if($key->distincao == "Sgts")
                    <div style=" text-align:justify;"> 
                        <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                    </div> 
                    <br>  
                @endif
            @endif
        @endforeach

        <!-- @   @ -->


        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span>
        
        <br><br>

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'II')
                @if($key->distincao == "Sgts")
                <div style=" text-align:justify;"> 
                    <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                </div> 
                <br> 
                @endif                
            @endif
        @endforeach
 
        <!-- @   @ -->



        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span>
                            
        <br><br> 

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'III')
                @if($key->distincao == "Sgts")
                <div style=" text-align:justify;"> 
                    <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                </div> 
                <br>   
                @endif            
            @endif
        @endforeach

        <!-- @    @ -->




        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span>
                            
        <br><br> 

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'IV')
                @if($key->distincao == "Sgts")
                <div style=" text-align:justify;"> 
                    <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                </div> 
                <br>  
                @endif            
            @endif
        @endforeach

   



        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span>
        
        <br><br> 

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'V')
                @if($key->distincao == "Sgts")
                <div style=" text-align:justify;"> 
                    <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                </div> 
                <br> 
                @endif               
            @endif
        @endforeach

            
        <!-- @   @ -->



        <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span>
        
        <br> <br> 

        @foreach($HomlogAtaContent as $key)
            @if($key->key_inciso == 'VI')
                @if($key->distincao == "Sgts")
                <div style=" text-align:justify;"> 
                    <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                </div> 
                <br>  
                @endif             
            @endif
        @endforeach

        <!-- @ FIM DAS HOMOLOGAÇÕES DOS SARGENTOS @ --> 


        <br>



        <!-- @ FICHA DE MERECIMENTO DOS * SD'S & CB'S*  @ --> 

            <!-- @ 2. 2.1. TRANSCRIÇÃO DA RESOLUÇÃO Nº 002, DE 15 DE MARÇO DE 2019 comissaoVotacao.title.sumula.homologation.Sargentos.ata @ -->
            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.title.sumula.homologation.CB_&_SD.ata @ -->
            <section> 
                <div style="width: 100%; height:auto; text-align:justify; "  > 
                    <div align="center"> <span style="font-size: 14px;"> <strong> <u> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.CB_&_SD.ata') </u> </strong> </span> </div> 
                </div> 
            <!-- @   @ -->
  

            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.sumula.homologation.CB_&_SD.ata @ -->
                <div style="width: 100%; height:auto; text-align:justify; " > 
                    <span style=" width:100%; " >   
                        <strong> Súmula: </strong> Dispõe sobre o deferimento de requerimentos e os respectivos registros de pontos positivos na ficha de merecimento dos Cabos e Soldados. <br> <br>
                        A Comissão de Promoção   de Praças da PMPR, no uso de suas atribuições legais previstas no Art. 4º, inciso VIII, da Lei Estadual nº 5.940, de 8 
                        de maio de 1969 (LPP), com fulcro no Art. 36, também da LPP e na Portaria do CG nº 635/1999, publicada no Boletim Geral nº 165/1999, considerando 
                        o cumprimento dos requisitos legais, resolve: <br> <br> <strong> Art. 1º </strong>  Deferir, por unanimidade de votos, os requerimentos impetrados pelos militares estaduais e 
                        protocolados na Secretaria da Comissão de Promoção   de Praças, e conseqüentemente determinar ao respectivo Secretário que registre na Ficha de 
                        Merecimento dos Cabos e Soldados abaixo relacionados, conforme adiante se especifica:   
                    </span>  
                </div> 
            </section> 
            <!-- @   @ -->


            <br> <br>

 
            <!-- @ TRECHO SE REFERE AOS INCISOS DOS Cbs e Sds @ -->
            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
            <section> 
                <div style="width: 100%; height:auto; "> 
                    <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span> <br> <br>
                </div>  
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'I')
                        @if($key->distincao == "Cbs e Sds")
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br> 
                        @endif                       
                    @endif
                @endforeach

            </section> 
            <!-- @   @ -->

 
            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
            <section> 
                <div style="width: 100%; height:auto; "> 
                    <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span> <br> <br>
                </div> 
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'II')
                        @if($key->distincao == "Cbs e Sds")
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br>                       
                        @endif
                    @endif
                @endforeach
                
            </section> 
            <!-- @   @ -->

 
            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
            <section> 
                <div style="width: 100%; height:auto; "> 
                        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span> <br> <br>
                </div>         
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'III')
                        @if($key->distincao == "Cbs e Sds")
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br>                        
                        @endif
                    @endif
                @endforeach


            </section> 
            <!-- @   @ -->

 

            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
                 <div style="width: 100%; height:auto; ">                         
                    <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span> <br> <br>
                </div>  
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'IV')
                        @if($key->distincao == "Cbs e Sds")
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br>                        
                        @endif
                    @endif
                @endforeach
                
             <!-- @   @ -->

 

            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
            <section> 
                <div style="width: 100%; height:auto; "> 
                    <span> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span>  <br> 
                </div>  
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'V')
                        @if($key->distincao == "Cbs e Sds") 
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br>                        
                        @endif
                    @endif
                @endforeach
            </section> 
            <!-- @   @ -->

            <br>

            <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
            <section> 
                <div style="width: 100%; height:auto; "> 
                        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span> <br> <br> 
                </div> 
                
                @foreach($HomlogAtaContent as $key)
                    @if($key->key_inciso == 'VI')
                        @if($key->distincao == "Cbs e Sds")
                        <div style=" text-align:justify;"> 
                            <p> <b> {{$key->word}} ) </b>    {{$key->contain_oficial_homolocao}} </p> 
                        </div> 
                        <br>                        
                        @endif
                    @endif
                @endforeach
            </section> 
            <!-- @   @ -->
 
        <!-- @ FIM DAS HOMOLOGAÇÕES DOS SD'S E CB'S  @ -->


        <br>  


        <!-- @ 3. EXPEDIENTES APRECIADOS @ -->
        <section> 
            <h4> <strong>3.</strong> <u> @lang('globalDocsCpp.comissaoVotacao.AppreciatedExpedients.ata') </u> </h4>  
            <div style="width: 100%; height:auto;"> 
                @if(isset($AtaContent))
                    @foreach($AtaContent as $key => $value)
                        @if($value['condicao_this_deliberacao'] == 'Apreciado')
                            <h5> 3.{{ $key += 1 }}.  <u> DELIBERAÇÃO Nº {{ $value['num_deliberacao'] }} /2019 </u> </h5>
                            <div style="width:90%; height:auto; margin:auto; text-align:justify; font-weight: lighter; "> <span> {{ $value['deliberacao'] }} </span> </div>  
                        @endif
                    @endforeach
                @endif
            </div>                    
        </section> 
        <!-- @ 3. EXPEDIENTES APRECIADOS @ -->

  
        <br>  


        <!-- @ 4. RelatedExpedients @  -->
        <section> 
            <h4> <strong> 4. </strong>  <u> @lang('globalDocsCpp.comissaoVotacao.RelatedExpedients.ata') </u> </h4>  
            <div style="width: 100%; height:auto;">
                <div style="display: none;"> {{$yek = 0}} </div>
                 @if(isset($AtaContent))
                    @foreach($AtaContent as $key => $value)
                        @if($value['condicao_this_deliberacao'] == 'Relatado')
                            <h5> 4.{{ $yek += 1 }}. <u ustyle=" color:black; "> DELIBERAÇÃO Nº {{ $value['num_deliberacao'] }} /2019 </u > </h5>
                            <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $value['deliberacao'] }} </span> </div>   
                        @endif
                    @endforeach
                @endif

                @if(isset($Ata44A))
                    @foreach($Ata44A as $key => $value)
                        <h5> 4.{{ $yek += 1 }}. <u ustyle=" color:black; "> DELIBERAÇÃO Nº {{ $value['num_44A'] }} /2019 </u > </h5>
                        <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $value['contain_delibercao'] }} </span> </div>  
                    @endforeach
                @endif
            </div>                    
        </section> 
        <!-- @ 4. RelatedExpedients @  -->


 
        <br> 



        <!-- @  5. EXPEDIENTES POSTERGADOS @ -->
        <section> 
            <h4> <strong> 5. </strong> <u> @lang('globalDocsCpp.comissaoVotacao.expedientsPostponed.ata') </u> </h4> 
            <div style="width: 100%; height:auto;"> 
                <div style="display: none;"> {{$sheck = 0}} </div>
                @if(isset($AtaContent))
                    @foreach($AtaContent as $key => $value)
                        @if($value['condicao_this_deliberacao'] == 'Postergado')
                            <h5> 5.{{ $sheck += 1 }}. <u ustyle="   color:black; "> DELIBERAÇÃO Nº {{ $value['num_deliberacao'] }} /2019 </u > </h5>
                            <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $value['deliberacao'] }} </span> </div>  
                        @endif
                    @endforeach
                @endif
            </div>                    
        </section> 
        <!-- @  5. EXPEDIENTES POSTERGADOS @ -->

        <br>


        <!--  @ 6. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->
        <section> 
            <h4> <strong> 6. </strong>  <u style=" color:black;  "> @lang('globalDocsCpp.comissaoVotacao.Notifications.ata') </u> </h4>  
            <div style="width: 100%; height:auto;"> 
                <br>
                <div style="text-align:justify;"> <span style="font-weight: lighter;"> @lang('globalDocsCpp.comissaoVotacao.ContentNotifications.ata') </span> 
                <br> <br>
            </div>                    
        </section> 
        <!--  @ 6. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->
 
        <br> <br>  

        <!--  @  7. ENCERRAMENTO DA REUNIÃO @  --> 
        <section> 
            <h4> <strong> 7. </strong>  <u style="color:black;   "> @lang('globalDocsCpp.comissaoVotacao.EndMeet.ata') </u> </h4>  
            <div style="width: 100%; height:auto; text-align:justify; ">
                <br>
                <span> @if(isset($AtaContent[0]->TERMO_ENCERRAMENTO_REUNIAO)) {{$AtaContent[0]->TERMO_ENCERRAMENTO_REUNIAO}} @endif </span>                
            </div>                    
        </section> 
        <!--  @  7. ENCERRAMENTO DA REUNIÃO @  -->  


        <br> <br> <br> <br> <br> <br> <br> <br> <br>

       <!-- @  footer @ -->
       <footer style="width:100%; height: auto; "> 
            <!-- @  footerMembros @ -->
            <section style="height: auto;">  
                <div style="width: 100%; height: auto; text-align:center;">
                    <span>  
                        {{$ativePresidenteSecretario[1]->nome}} 
                        <br> 
                        <strong> Presidente </strong> 
                        <br> 
                        <strong> Ata assinada digitalmente. </strong>
                    </span>
                    
                    <br> <br> <br>  <br>  <br>  <br>  <br>

                    @foreach($users_ative_and_inative_cpp as $key=> $value)
                        <span>  
                            {{$users_ative_and_inative_cpp[$key]->nome}} 
                            <br> 
                            <strong> {{$users_ative_and_inative_cpp[$key]->qualificacao}} </strong>
                            <br> 
                        <strong> Ata assinada digitalmente. </strong> 
                        </span>
                        
                    <br> <br> <br> <br> <br> <br>  <br>
                    @endforeach
                </div>
            </section> 
            <!-- @  footerMembros @ -->                    
        </footer> 
        <!-- @  footer @ -->                
         
    </div>
    </div>
    </body>
    <!--  #  Final body #  -->
</html>
<!-- @ END CODE @ -->
