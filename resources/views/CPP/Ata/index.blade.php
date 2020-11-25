<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Sd. Renan - 07/2019">
        <meta nmae="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>         
        <!-- @ place to convert PDF @ -->
        <!-- https://document.online-convert.com/convert-to-pdf -->

        <title>Doc. Ata</title>
    </head>

    <body style="width: 100%; height: auto;">
    <br>
    <div style="width: 95%; height: auto; margin: auto; border: solid 1px black;">
        <!-- Etapa 1 -->
        <!-- @ Barra com button ferar pdf  @ -->
        <section style=" "> 
            <div class="row" style=" position:absolute; top:0px; width: 99.9%; height: 35px; "> 
                <div class="col-3"> <span style="color: cian; font-size: 22px; position: relative; top:25px; left: 25px;">  Etapa 1 de 2 </span> </div>
                
                <div class="col-8"> </div>

                <div class="col-1">  
                    <a href="{{route('cpp.salavotacao.index')}}" style="font-size: 18px; color: blue; position:relative; top:23px; right: 15px; text-decoration-line:underline; " > 
                          <u> Inicio </u>   
                    </a>
                </div>                
            </div>
        </section>
        <!-- @  @ -->




        <!--* 
            * Enviar ata para ser finalizada 
            *
        -->
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
                <!-- @ texto @-->
                <!-- @ REUNIÃO DA COMISSÃO DE PROMOÇÃO DE PRAÇAS. @-->
                <section>
                    <div style=" text-align:justify;"> 
                        <span class="introduction_ata" id="introduction_ata" style="font-size:18px; font-family: 'Times New Roman', Times, serif; ">                        
                            Aos(ao) {{date('d')}} dias(a) do  mês  de  <?php setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese"); date_default_timezone_set('America/Sao_Paulo');  
                            echo ucfirst( utf8_encode(strftime("%B", strtotime('today')))); ?>  do  ano  de  {{ date('Y') }},  no  Quartel  do  Comando-Geral  da  Polícia  Militar  do  Paraná,  
                            na  sala  de  reuniões  da  CPP, às  {{date('H'.'\h'.":".'i'.'\m'."'")}},  reuniu-se  a  Comissão  de  Promoções  de  Praças,  sob  a  Presidência  do  
                            Sr. <strong> {{$ativePresidenteSecretario[1]->nome}} </strong>,   <strong> RG: {{$ativePresidenteSecretario[1]->rg}} </strong>, portariaCG designado  pela  Portaria  do  CG  nº  981,  
                            de  28 de  dezembro  de  2018, estando  presentes  na  reunião  os  senhores  membros: 
                            <strong> 
                                @if(isset($users_ative_and_inative_cpp[0])) {{$users_ative_and_inative_cpp[0]->nome}} ({{$users_ative_and_inative_cpp[0]->qualificacao}}), RG: {{$users_ative_and_inative_cpp[0]->rg}},  {{$users_ative_and_inative_cpp[0]->portariaCG}} 
                                @endif @if(isset($users_ative_and_inative_cpp[1])), {{$users_ative_and_inative_cpp[1]->nome}} ({{$users_ative_and_inative_cpp[1]->qualificacao}}), RG:{{ $users_ative_and_inative_cpp[1]->rg}}, {{$users_ative_and_inative_cpp[1]->portariaCG}} 
                                @endif @if(isset($users_ative_and_inative_cpp[2])), {{$users_ative_and_inative_cpp[2]->nome}} ({{$users_ative_and_inative_cpp[2]->qualificacao}}), RG: {{$users_ative_and_inative_cpp[2]->rg}}, {{$users_ative_and_inative_cpp[2]->portariaCG}} 
                                @endif @if(isset($users_ative_and_inative_cpp[3])), {{$users_ative_and_inative_cpp[3]->nome}} ({{$users_ative_and_inative_cpp[3]->qualificacao}}), RG: {{$users_ative_and_inative_cpp[3]->rg}}, {{$users_ative_and_inative_cpp[3]->portariaCG}}   
                                @endif @if(isset($users_ative_and_inative_cpp[4])), {{$users_ative_and_inative_cpp[4]->nome}} ({{$users_ative_and_inative_cpp[4]->qualificacao}}), RG: {{$users_ative_and_inative_cpp[4]->rg}}, {{$users_ative_and_inative_cpp[4]->portariaCG}} e 
                                @endif @if(isset($users_ative_and_inative_cpp[5])), {{$users_ative_and_inative_cpp[5]->nome}} ({{$users_ative_and_inative_cpp[5]->qualificacao}}), RG: {{$users_ative_and_inative_cpp[5]->rg}}, {{$users_ative_and_inative_cpp[5]->portariaCG}}   
                                @endif.  
                            </strong> 
                            O  Sr.  Presidente  declarou  aberto  os  trabalhos,  sendo  que,  em  seguida,  apresentou a pauta da reunião onde foram tratados os seguintes assuntos:   
                        </span> 
                    </div>
                </section> 
                <!-- @  @-->

        



                <br> <br>        





                <!-- @ 1. SORTEIO DE NOVOS EXPEDIENTES  @ -->
                 <!-- <section> 
                    <div style="width: 100%; height:auto; display:flex;">                     
                        <h4> <strong> 1. </strong> <u style="margin-left:18px; color:black;  "> @lang('globalDocsCpp.comissaoVotacao.NewCaseFile.ata') </u> </h4>
                        <br> <br>
                    </div>                    
                </section>  -->
                <!-- @    @ -->


 

                 
                <br> <br> <br> <br>





                <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.homologation.ata @ -->
                <section> 
                    <div style="width: 100%; height:auto; display:flex;">                    
                        <h4> <strong> 1. </strong> <u style="margin-left:18px; color:black; "> @lang('globalDocsCpp.comissaoVotacao.homologation.ata') </u> </h4>
                    </div>                    
                </section> 
                <!-- @ @ -->

                <br>

 
                <!-- @ 1. 1.1. TRANSCRIÇÃO DA RESOLUÇÃO Nº 001, DE 15 DE MARÇO DE 2019 comissaoVotacao.title.sumula.homologation.Sargentos.ata @ -->
                <section> 
                    <div style="width: 100%; height:auto; text-align:justify; "  > 
                        <div align="center"> <span style="font-size: 14px;">  <strong> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.Sargentos.ata') </strong> </span> </div>  
                    </div> 
                </section> 
                <!-- @   @ -->



                <!-- @ 1. Súmula comissaoVotacao.sumula.homologation.Sargentos.ata @ -->
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
                <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
                <section> 
                    <div style="width: 100%; height:auto; "> 
                                            
                        <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span>
                        
                        <br><br>

                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'I')
                                @if($key->distincao == "Sgts")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;  {{$key->contain_oficial_homolocao}}   <br> <br> 
                                @endif
                            @endif
                        @endforeach

                    </div>                    
                </section> 
                <!-- @   @ -->


                    <br>


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span>
                            
                            <br><br>

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'II')
                                    @if($key->distincao == "Sgts")
                                        <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} <br> <br> 
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->


                    <br>


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span>
                            
                            <br><br> 

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'III')
                                    @if($key->distincao == "Sgts")
                                        <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}}  <br>  <br> 
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->


                    <br>



                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span>
                            
                            <br><br> 

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'IV')
                                    @if($key->distincao == "Sgts")
                                        <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}}  <br> <br>  
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->



                    <br>



                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span>
                            
                            <br><br> 

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'V')
                                    @if($key->distincao == "Sgts")
                                        <strong>  {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}}   <br> <br> 
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->



                    <br>




                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                                                
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span>
                           
                            <br><br> 

                            @foreach($HomlogAtaContent as $key)
                                @if($key->key_inciso == 'VI')
                                    @if($key->distincao == "Sgts")
                                        <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br>
                                    @endif
                                @endif
                            @endforeach

                        </div>                    
                    </section> 
                    <!-- @   @ -->

                <!-- @ FIM DAS HOMOLOGAÇÕES DOS SARGENTOS @ -->               




                

                <br><br><br><br>





                
                <!-- @ FICHA DE MERECIMENTO DOS * SD'S & CB'S*  @ -->


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.title.sumula.homologation.CB_&_SD.ata @ -->
                    <section> 
                        <div style="width: 100%; height:auto; text-align:justify; "  > 
                            <div align="center"> <span style="font-size: 14px;"> <strong> @lang('globalDocsCpp.comissaoVotacao.title.sumula.homologation.CB_&_SD.ata') </strong> </span> </div> 
                        </div> 
                    </section> 
                    <!-- @   @ -->

 
                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO comissaoVotacao.sumula.homologation.CB_&_SD.ata @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "  > 
                            <textarea style=" width:100%; resize: none; border:none; " rows="7" readonly>   @lang('globalDocsCpp.comissaoVotacao.sumula.homologation.CB_&_SD.ata')   </textarea>  
                        </div> 
                    </section> 
                    <!-- @   @ -->

                    <br> <br>

                    <!-- @ TRECHO SE REFERE AOS INCISOS DOS Cbs e Sds @ -->
                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoI') </strong> </span> <br> <br>
                        </div>  
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'I')
                                @if($key->distincao == "Cbs e Sds")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}}  <br> <br>  
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->

                    <br>

                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoII') </strong> </span> <br> <br>
                        </div> 
                        
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'II')
                                @if($key->distincao == "Cbs e Sds")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br> 
                                @endif
                            @endif
                        @endforeach
                        
                    </section> 
                    <!-- @   @ -->

                    <br>

                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIII  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                             <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIII') </strong> </span> <br> <br>
                        </div>         
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'III')
                                @if($key->distincao == "Cbs e Sds")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br> 
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoIV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; ">                         
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoIV') </strong> </span> <br> <br>
                        </div>  
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'IV')
                                @if($key->distincao == "Cbs e Sds")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br>  
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoV  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                            <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoV') </strong> </span> <br> <br>
                        </div>  
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'V')
                                @if($key->distincao == "Cbs e Sds") 
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br>  
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->

                    <br>


                    <!-- @ 1. HOMOLOGAÇÃO DE REGISTRO DE PONTOS POSITIVOS NA FICHA DE MERECIEMENTO  IncisoVI  @ -->
                    <section> 
                        <div style="width: 100%; height:auto; "> 
                             <span style=" "> <strong> @lang('globalDocsCpp.comissaoVotacao.FichaMerecimentoSargentos.homologation.ata.IncisoVI') </strong> </span> <br> <br> 
                        </div> 
                        @foreach($HomlogAtaContent as $key)
                            @if($key->key_inciso == 'VI')
                                @if($key->distincao == "Cbs e Sds")
                                    <strong> {{$key->word}} ) </strong>  &MediumSpace;{{$key->contain_oficial_homolocao}} </textarea> <br> <br> 
                                @endif
                            @endif
                        @endforeach
                    </section> 
                    <!-- @   @ -->


                <!-- @ FIM DAS HOMOLOGAÇÕES DOS SD'S E CB'S  @ -->



                <br><br><br><br>



                <!-- @ 2. EXPEDIENTES APRECIADOS @ -->
                 <section> 
                    <h4> <strong> 2. </strong>  <u style=" margin-left:18px; color: black; "> @lang('globalDocsCpp.comissaoVotacao.AppreciatedExpedients.ata') </u> </h4>  
                    <div style="width: 100%; height:auto;"> 
                        <br> 
                        <div style="display: none;"> {{$keyo = 0}}  </div>
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                @if($value['condicao_this_deliberacao'] == 'Apreciado')
                                    <h5> 2.{{ $keyo += 1 }}.  <u style=" color:black; "> DELIBERAÇÃO Nº *** /2019 </u> </h5>
                                    <form action="/cpp/editDeliberInAta" method="post">
                                    @csrf
                                        <div style="width:90%; height:auto; margin:auto; text-align:justify; font-weight: lighter; "> 
                                            <input name="editdeliberinata" type="hidden" value="{{$value['id']}}">
                                            <textarea class="form-control"  type="text" name="contentDeliberAprec"  style="width: 100%; " rows="7"> 
                                                {{ $value['deliberacao'] }}
                                            </textarea>
                                            <button type="submit" class="btn btn-warning">Alterar</button>
                                        </div> 
                                    </form>
                                    <br> <br> <br>
                                @endif
                            @endforeach
                        @endif

                        <br> <br>
                        <div style="display:none;"> {{ $cont = $keyo}} </div>
                        @if(isset($Ata44A))
                            @foreach($Ata44A as $key => $val)
                                <form action="\cpp\editDeliberInAta44a" method="post">  
                                    @csrf
                                    <h5> 2.{{ $cont = $cont + 1 }}. <u ustyle=" color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                    <div style="width:90%; height:auto; margin:auto; text-align:justify; "> 
                                        <input name="editdeliberinata44a" type="hidden" value="{{$val['id']}}">
                                        <textarea class="form-control"  type="text" name="contentDeliber44A"  style="width: 100%; " rows="7"> 
                                            {{ $val['contain_delibercao'] }} 
                                        </textarea> 
                                        <button type="submit" class="btn btn-warning">Alterar</button>
                                    </div> 
                                    <br> <br> <br>
                                </form> 
                            @endforeach
                        @endif
                    </div>                    
                </section> 
                <!-- @ 2. EXPEDIENTES APRECIADOS @ -->


               
                <br>



                <!-- @ 3. RelatedExpedients @  -->
                 <section> 
                    <h4> <strong> 3. </strong>  <u  style="margin-left:18px; color:black;   "> @lang('globalDocsCpp.comissaoVotacao.RelatedExpedients.ata') </u> </h4>  
                    <div style="width: 100%; height:auto;"> 
                        <br>
                        <div style="display:none;"> {{ $cont = 0}} </div>
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                @if($value['condicao_this_deliberacao'] == 'Relatado')
                                    <h5> 3.{{ $cont = $cont + 1 }}. <u ustyle=" color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                    <form action="\cpp\editDeliberInAtaRelatado" method="post"> <!-- # -->
                                    @csrf
                                    <div style="width:90%; height:auto; margin:auto; text-align:justify; "> <span>  </span>
                                        <input name="editdeliberinatarelatado" type="hidden" value="{{$value['id']}}">
                                        <textarea class="form-control"  type="text" name="contentDeliberRel"  style="width: 100%; " rows="7"> 
                                            {{ $value['deliberacao'] }}
                                        </textarea>
                                        <button type="submit" class="btn btn-warning">Alterar</button>
                                        <br> <br> <br>
                                    </div> 
                                @endif
                                </form>
                             @endforeach
                        @endif
                    </div>                    
                </section> 
                <!-- @ 3. RelatedExpedients @  -->


                 
                <br> <br> 




                <!-- @  4. EXPEDIENTES POSTERGADOS @ -->
                <section> 
                    <h4> <strong> 4. </strong>   <u style="margin-left:18px; color:black; "> @lang('globalDocsCpp.comissaoVotacao.expedientsPostponed.ata') </u> </h4> 
                    <div style="width: 100%; height:auto;"> 
                        <br>
                        <div style="display:none;"> {{ $cont = 0}} </div>
                        @if(isset($AtaContent))
                            @foreach($AtaContent as $key => $value)
                                <form action="\cpp\editDeliberInAtaPost" method="post"> <!-- # -->
                                    @csrf
                                    @if($value['condicao_this_deliberacao'] == 'Postergado')
                                        <h5> 4.{{ $cont = $cont + 1 }}. <u ustyle="   color:black; "> DELIBERAÇÃO Nº *** /2019 </u > </h5>
                                        <div style="width:90%; height:auto; margin:auto; text-align:justify; "> 
                                            <input name="editDeliberInAtaPost" type="hidden" value="{{$value['id']}}">
                                            <textarea class="form-control"  type="text" name="contentDeliberPost" style="width:100%; height:auto; margin:auto; " rows="7"> 
                                                {{ $value['deliberacao'] }} 
                                            </textarea> 
                                            <button type="submit" class="btn btn-warning">Alterar</button>
                                        </div>
                                        <br> <br> <br>
                                    @endif
                                </form > <!-- # -->
                             @endforeach
                        @endif
                    </div>                    
                </section> 
                <!-- @  4. EXPEDIENTES POSTERGADOS @ -->
             

                <br>


                <!--  @ 5. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->
                <section> 
                    <h4> <strong> 5. </strong>  <u style="margin-left:18px; color:black;"> @lang('globalDocsCpp.comissaoVotacao.Notifications.ata') </u> </h4>  
                    <div style="width: 100%; height:auto;"> 
                        <br>
                        <div style="text-align:justify;"> <span style=" "> @lang('globalDocsCpp.comissaoVotacao.ContentNotifications.ata') </span> 
                        <br> <br>
                    </div>                    
                </section> 
                <!--  @ 5. NOTIFICAÇÕES E PRAZOS PARA RECURSOS @ -->


                 
                <br> <br>               



                <!--  @  6. ENCERRAMENTO DA REUNIÃO @  --> 
                <section> 
                    <h4> <strong> 6. </strong>  <u style="margin-left:18px; color:black;   "> @lang('globalDocsCpp.comissaoVotacao.EndMeet.ata') </u> </h4>  
                    <div style="width: 100%; height:auto;">
                        <br>
                        <textarea class="encerramento_reuniao" id="encerramento_reuniao" name="encerramento_reuniao" style=" width:100%; border:solid 1px #dc3545; " rows="7" required>  
                            Às 17hs do dia dezoito de março de dois mil e dezenove, o Sr. Presidente paralisou os trabalhos da Comissão e retornou com as atividades às 8h30min do dia vinte e cinco de março de dois mil e dezenove, declarando encerrada a reunião às 17hs do mesmo dia, e como nada mais foi deliberado, mandou que se lavrasse a presente Ata, a qual, constando 79 laudas numeradas, que depois de lidas e achadas conforme, seguem devidamente assinadas. Eu, *SECRETARIO - POST - NOME*, RG * *, Secretário da Comissão de Promoções de Praças, lavrei-a.
                        </textarea>
                        <br> <br>
                    </div>                    
                </section> 
                <!--  @  6. ENCERRAMENTO DA REUNIÃO @  -->             
                


                <br>    



                <!-- @  footer @ -->
                <footer style="width:100%; height:100%; margin-top:135px;"> 
                    <div style="width:100%; height:250px; display:none;" id="confirmeEndAta" class="confirmeEndAta" > 
                        <div style="width:30%; height:100%; background:#f9f9f9; margin:auto; box-shadow:0px 0px 4px 2px #dbdbdb; border:solid 1px #ffb432; " align="center"> 
                            <br>
                            <h4> {{$userLoged}} </h4>
                            <div style="width:100%; height: 1px; background:#ffb432;"> </div>
                            <br>
                            <h5 style=""> Você confirma que realmente <br> Deseja finalizar esta ATA ? </h5>
                            <br> 
                            <form method="get" action="{{ route('cpp.ata.edit', 0) }}"> 
                                <div class="" style="display:flex; width:100%; height:auto;" >
                                    <input type="hidden" name="numero_ata" value="{{$AtaContent[0]->numero_ata}}">
                                    <input type="hidden" class="introducao_reuniao" id="introducao_reuniao" name="introducao_reuniao" value=" ">
                                    <input type="hidden" class="encerramento_reuniao_inner" id="encerramento_reuniao_inner" name="encerramento_reuniao_inner" value=" ">
                                    <div style="width:50%; height:auto; margin:auto;"> 
                                        <button type="submit" class="btn btn-primary" > Confirmar </button>
                                        &nbsp;
                                        <button  id="cancelEndAta" type="button" class="btn btn-warning cancelEndAta" > Cancelar </button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>

                    
                    <div style=" cursor:pointer; width:100%; height: auto;" align="center" >
                        <a class=" btn btn-danger finalAta" id="finalAta" style=" position:relative;  top: 55px; " > 
                            <i class="fa fa-file" style="font-size: 18px"> </i> 
                            <span style="color:white;"> Finalizar ATa. </span>
                        </a>
                    </div>
                </footer> 
                <!-- @  footer @ -->  
                <br> <br>                     
            </div> 
            <!-- @ section filho margin @ -->
        </section>
        <!-- @ section pai @ -->


   
        <br> <br>  




        <!-- @  PLACE FOR MANAGEMENT JAVASCRIPT AND JQUERY @ -->
        <!-- @  href="/css/SalaVotacao/slavot.css"      @ -->
        <script type="text/javascript"> 


            $("#finalAta").on("click", function(){
                $("#confirmeEndAta").slideToggle( "slow" );
                var t =  $("#introduction_ata");
                var r = document.getElementById('introducao_reuniao').value = t[0].innerHTML;
                var e = document.getElementById('encerramento_reuniao_inner').value = document.getElementById('encerramento_reuniao').value;
                console.log(r);
                console.log(e);
            });


            $("#cancelEndAta").on("click", function(){
                $("#confirmeEndAta").slideUp();
            });


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
    </div>
    </body>
    <!--  #  Final body #  -->

</html>
<!-- @ END CODE @ -->