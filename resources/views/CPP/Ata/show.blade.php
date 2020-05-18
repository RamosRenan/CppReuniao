<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Sd. Renan - 07/2019">
        <meta nmae="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         
        <!-- @ place to convert PDF @ -->
        <!-- https://document.online-convert.com/convert-to-pdf -->

        <title>Doc. Ata</title>
    </head>

    <body>
        <!-- @ Barra com button ferar pdf  @ -->
        <section style=" "> 
            <div class="row" style=" position:fixed; top:0px; width: 99.9%; height: 35px; background: #f4f4f4; box-shadow: 0px 0px 3px 1px #dce2ea; "> 
                <div class="col-md-4">   
                    <button type="button" class=" " style=" position:relative; left: 100px; box-shadow: 0px 0px 3px 1px #828282; " onclick="Export2Doc('exportContent')" > 
                        <i class="fa fa-file" style="font-size: 18px"></i> Gerar .Doc 
                    </button> 
                </div>

                <div class="col-md-4"> </div>

                <div class="col-md-4">  
                    <a href="{{route('cpp.salavotacao.index')}}" style=" color: blue; position:relative; top: 05px; float: right; text-decoration-line:underline; " > 
                        Home 
                    </a>
                    <i class="fa fa-home" style=" position:relative; top: 05px; right: 4px; font-size: 18px; float: right; color: blue; cursor:pointer;"></i>   
                </div>                
            </div>
        </section>
        <!-- @  @ -->


 

        
        <section style="width:100%; height: 100%; " id="exportContent" >
            <div style="width:98%; height: 100%; margin:auto; margin-top:18px; ">
 
                <br> 

                                
                <!-- @ POLÍCIA MILITAR DO PARANÁ COMANDO-GERALCOMISSÃO DE PROMOÇÃO DE PRAÇAS @ -->
                 <header>
                    <div style="width:100%; height:100%;">
                        <div align="center"> <h4 style="font-family: 'Times New Roman', Times, serif; "> <strong> @lang('globalDocsCpp.comissaoVotacao.header.ata') </strong> </h4> </div>
                        <hr style="width:96%; margin:auto; background-color:black;">
                    </div>
                </header>  
                <!-- @   @ -->



                <br>



                <!-- @ Publique-se. Coronel ........., Comandante-Geral da PMPR. @ -->
                <nav style="float:right; font-family: 'Times New Roman', Times, serif;  "> <span> <strong> @lang('globalDocsCpp.comissaoVotacao.sub_header_cel.ata')  </strong> </span> </nav>
                <!-- @   @ -->




                <br> <br> <br>
                




                <!-- @ “Reunião Ordinária” ATA DA XXXXª REUNIÃO DA COMISSÃO DE PROMOÇÕES DE PRAÇAS @ -->
                <div style="width:100%; height:auto;" align="center">
                    <h4 style="font-family: 'Times New Roman', Times, serif; ">
                        
                        <br> <br> <br>
                        <strong>
                        <span> “Reunião Ordinária” </span>

                        <br>
                        
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
                            <textarea style="font-size:18px; font-family: 'Times New Roman', Times, serif; width:100%; resize:none; border:none; text-align:justify; width:100%; overflow: hidden;" rows="8" cols="60" readonly>                        
                                {{ $AtaContent[0]->INTRODUCAO_REAUNIAO_ORDINARIA }} 
                            </textarea> 
                        </div>
                    </div>
                </section> 
                <!-- @  @-->

        
                <br> <br>    
            


                <!-- @ 1. SORTEIO DE NOVOS EXPEDIENTES  @ -->
                 <section> 
                    <div style="width: 100%; height:auto; display:flex;"> 
                    
                        <h4> <strong> 1. </strong> </h4>  <h4> <u style="margin-left:18px; color:black;  "> @lang('globalDocsCpp.comissaoVotacao.NewCaseFile.ata') </u> </h4>
                        <br>
                        <br>
                    </div>                    
                </section> 
                <!-- @    @ -->


 

                 
                <br> <br> <br> <br>





                <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.homologation.ata @ -->
                 <section> 
                    <div style="width: 100%; height:auto; display:flex;">                    
                        <h4> <strong> 2. </strong> </h4> <h4> <u style="margin-left:18px; color:black; "> @lang('globalDocsCpp.comissaoVotacao.homologation.ata') </u> </h4>
                    </div>                    
                </section> 
                <!-- @ @ -->

                <br>

 
                <!-- @ 2. 2.1. TRANSCRIÇÃO DA RESOLUÇÃO Nº 001, DE 15 DE MARÇO DE 2019 comissaoVotacao.title.sumula.homologation.Sargentos.ata @ -->
                <section> 
                    <div style="width: 100%; height:auto; text-align:justify; "  > 
                        <div align="center"> <span style="font-size: 14px;">  <strong> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.Sargentos.ata') </strong> </span> </div>  
                    </div> 
                </section> 
                <!-- @   @ -->



                <!-- @ 2. Súmula comissaoVotacao.sumula.homologation.Sargentos.ata @ -->
                <section> 
                    <div style="width: 100%; height:auto; "> 
                                        
                        <textarea style=" width:100%; resize: none; border:none; text-align:justify; overflow: hidden; " rows="10" readonly >   
                             @lang('globalDocsCpp.comissaoVotacao.sumula.homologation.Sargentos.ata')  
                        </textarea>
                        
                        <br> <br>

                    </div>                    
                </section> 
                <!-- @   @ -->


                 

                        
                <!-- @ FICHA DE MERECIMENTO DOS *SARGENTOS*  @ -->
                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span>
                            
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'I')
                                    @if($key->distincao == "Sgt's")
                                        {{$key->contain_oficial_homolocao}}   <br> <br> <br> 
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->


                    <br>


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span>
                            
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'II')
                                    @if($key->distincao == "Sgt's")
                                        <textarea style=" width:100%; resize:none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->


                    <br>


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span>
                            
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'III')
                                    @if($key->distincao == "Sgt's")
                                        <textarea style=" width:100%; resize:none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br>  <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->


                    <br>



                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span>
                            
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'IV')
                                    @if($key->distincao == "Sgt's")
                                        <textarea style=" width:100%; resize:none; border:none; "> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->



                    <br>



                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span>
                            
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'V')
                                    @if($key->distincao == "Sgt's")
                                        <textarea style=" width:100%; resize:none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->



                    <br>




                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span>
                           
                            <br><br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'VI')
                                    @if($key->distincao == "Sgt's")
                                        <textarea style=" width:100%; resize:none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->

                <!-- @ FIM DAS HOMOLOGAÇÕES DOS SARGENTOS @ -->
                




                

                <br> <br>






                
                <!-- @ FICHA DE MERECIMENTO DOS * SD'S & CB'S*  @ -->


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.title.sumula.homologation.CB_&_SD.ata @ -->
                    <section> 
                        <div style="width: 100%; height:auto; text-align:justify; "  > 
                            <div align="center"> <span style="font-size: 14px;"> <strong> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.CB_&_SD.ata') </strong> </span> </div> 
                        </div> 
                    </section> 
                    <!-- @   @ -->

 
                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.sumula.homologation.CB_&_SD.ata @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "  > 
                            <textarea style=" width:100%; resize: none; border:none; " rows="7" readonly>   @lang('globalDocsCpp.comissaoVotacao.sumula.homologation.CB_&_SD.ata')   </textarea>  
                        </div> 
                    </section> 
                    <!-- @   @ -->

                    <br> <br>

                    <!-- @ TRECHO SE REFERE AOS INCISOS DOS CB'S E SD'S @ -->
                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span> <br> <br>
                        </div>  
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'I')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach

                    </section> 
                    <!-- @   @ -->

                    <br>

                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span> <br> <br>
                        </div> 
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'II')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none;  " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach
                        
                    </section> 
                    <!-- @   @ -->

                    <br>

                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                             <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span> <br> <br>
                        </div>         
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'III')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none;  " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach


                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; ">                         
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span> <br> <br>
                        </div>  
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'IV')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none;  " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach
                        
                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span> <br> <br>
                        </div>  
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'V')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none;  " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach

                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 2. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                             <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span> <br> <br> <br>
                        </div> 
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'VI')
                                @if($key->distincao == "Cb's e Sd's")
                                    <textarea style=" width:100%; resize: none; border:none; " readonly> {{$key->contain_oficial_homolocao}} </textarea> <br> <br> <br>
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->


                <!-- @ FIM DAS HOMOLOGAÇÕES DOS SD'S E CB'S  @ -->








                <br> <br> <br>









                <!-- @ 3. EXPEDIENTES APRECIADOS @ -->
                 <section> 
                    <div style="width:100%; height: auto; display:flex;"> <h4> <strong> 3. </strong> </h4> <h4> <u style=" margin-left:18px; color: black; "> @lang('globalDocsCpp.comissaoVotacao.AppreciatedExpedients.ata') </u> </h4> </div>
                    <div style="width: 100%; height:auto;"> 
                        <br> 
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                @if($value['condicao_this_deliberacao'] == 'Apreciado')
                                    <h5> 3.{{ $key += 1 }}.  <u style=" color:black; "> DELIBERAÇÃO Nº *** /2019 </u> </h5>
                                    <div style="width:90%; height:auto; margin:auto; text-align:justify; font-weight: lighter; "> <span> {{ $value['deliberacao'] }} </span> </div> <br> <br> <br>
                                @endif
                            @endforeach
                        @endif
                        <br> <br>
                    </div>                    
                </section> 
                <!-- @ 3. EXPEDIENTES APRECIADOS @ -->

               
                <br>



                <!-- @ 4. RelatedExpedients @  -->
                 <section> 
                    <div style="width:100%; height: auto; display:flex;"> <h4> <strong> 4. </strong> </h4>  <h4> <u style="margin-left:18px; color:black; "> @lang('globalDocsCpp.comissaoVotacao.RelatedExpedients.ata') </u> </h4> </div>
                    <br>
                    <div style="width: 100%; height:auto;"> 
                        <div style="display:none;"> {{ $cont = 0}} </div>
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                @if($value['condicao_this_deliberacao'] == 'Relatado')
                                    <h5> 4.{{ $cont = $cont + 1 }}. <u ustyle="   color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                    <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $value['deliberacao'] }} </span> </div> <br> <br> <br>
                                @endif
                             @endforeach
                        @endif

                        @if(isset($Ata44A))
                            @foreach($Ata44A as $key)
                                <h5> 4.{{ $cont = $cont + 1 }}. <u ustyle="   color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $key->contain_delibercao }} </span> </div> <br> <br> <br>
                            @endforeach
                        @endif
                    </div>                    
                </section> 
                <!-- @ 4. RelatedExpedients @  -->



                 
                <br> <br> <br>




                <!-- @  5. EXPEDIENTES POSTERGADOS @ -->
                <section> 
                    <div style="width:100%; height: auto; display:flex;">  <h4> <strong> 5. </strong> </h4> <h4> <u style="margin-left:18px; color:black;   "> @lang('globalDocsCpp.comissaoVotacao.expedientsPostponed.ata') </u> </h4> </div>
                    <div style="width: 100%; height:auto;"> 
                        <br>
                        <div style="display:none;"> {{ $cont = 0}} </div>
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                @if($value['condicao_this_deliberacao'] == 'Postergado')
                                    <h5> 5.{{ $cont = $cont + 1 }}. <u ustyle="   color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                    <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span> {{ $value['deliberacao'] }} </span> </div> <br> <br> <br>
                                @endif
                             @endforeach
                        @endif
                    </div>                    
                </section> 
                <!-- @  5. EXPEDIENTES POSTERGADOS @ -->
             

                <br>


                <!--  @ 6. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->
                <section> 
                    <div style="width:100%; height: auto; display:flex;"> <h4> <strong> 6. </strong> </h4> <h4> <u style="margin-left:18px; color:black;  "> @lang('globalDocsCpp.comissaoVotacao.Notifications.ata') </u> </h4> </div>
                    <div style="width: 100%; height:auto;"> 
                        <br>
                        <div style="text-align:justify;"> <span style="font-weight: lighter;"> @lang('globalDocsCpp.comissaoVotacao.ContentNotifications.ata') </span> 
                        <br> <br>
                    </div>                    
                </section> 
                <!--  @ 6. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->





                 
                <br>
                <br>               
               





                <!--  @  7. ENCERRAMENTO DA REUNIÃO @  --> 
                <section> 
                    <div style="width:100%; height: auto; display:flex;"> <h4> <strong> 7. </strong> </h4>  <h4> <u style="margin-left:18px; color:black;   "> @lang('globalDocsCpp.comissaoVotacao.EndMeet.ata') </u> </h4> </div>
                    <br>
                    <div style="width: 100%; height:auto;">
                        {{ $AtaContent[0]->TERMO_ENCERRAMENTO_REUNIAO }}
                    </div>                    
                </section> 
                <!--  @  7. ENCERRAMENTO DA REUNIÃO @  -->  
                
                




                <br>  <br>  <br>  <br>  <br>
                





                <!-- @  footer @ -->
                <footer style="width:100%; height:100%; margin-top:135px;">                     
                    <!-- @  footerMembros @ -->
                    <section style="height:100%;">  

                        <!-- @ Table Members @ -->
                        <div style="width: 100%; height:100%;">                         
                            <div style="width:98%; height:100%; margin:auto; " align="center">
                             
                                <div class="row" style=" ">                                
                                    <div class="col-4" ></div>
                                    <div class="col-4" > _________________________________________ <br> <span style="position:relative; top: 1px;">  Presidente. <br>  </span> </div>
                                    <div class="col-4" ></div>                                
                                </div>

                                <br>
                                <br>
                                <br>

                                <div class=" row " style="">
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Efetivo  <br><br>   </div>
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Efetivo  <br><br>   </div>
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Efetivo  <br><br>   </div>  
                                </div>
                                
                               
                                <div class="row">
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Efetivo  <br><br>   </div>
                                    <br><br>
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Suplente <br><br>   </div>
                                    <div class="col-4"> _________________________________________ <br> <span style="position:relative;">  Membro Suplente <br><br>   </div>  
                                </div> 

                            </div>                                                
                        </div> 
                        <!-- @ Table Members @ -->                      


                    </section> 
                    <!-- @  footerMembros @ -->

                    <br> <br>
                    
                </footer> 
                <!-- @  footer @ -->                


                <br> <br>               
                
            </div> 
            <!-- @ section filho margin @ -->
        </section>
        <!-- @ section pai @ -->
    
        <br> <br>  

               
        <!-- @  PLACE FOR MANAGEMENT JAVASCRIPT AND JQUERY @ -->
        <script type="text/javascript"> 
        //  href="/css/SalaVotacao/slavot.css"            

            function Export2Doc(element, filename = 'AtaCpp'){
                var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
                var postHtml = "</body></html>";
                var html = preHtml+document.getElementById(element).innerHTML+postHtml;

                var blob = new Blob(['\ufeff', html], {
                    type: 'application/msword'
                });
                
                // Specify link url
                var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
                
                // Specify file name
                filename = filename?filename+'.doc':'document.doc';
                
                // Create download link element
                var downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);
                
                if(navigator.msSaveOrOpenBlob ){
                    navigator.msSaveOrOpenBlob(blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = url;
                    
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }
                
                document.body.removeChild(downloadLink);
            }


            jQuery(document).ready(function($){

                $(".word-export").click(function(event) {
                    alert('olaaa');
                    $(".export-content").wordExport();

                });

            });


                            
        </script>
        <!-- @  PLACE FOR MANAGEMENT JAVASCRIPT AND JQUERY @ -->  

    </body>
    <!--  #  Final body #  -->

</html>
<!-- @ END CODE @ -->