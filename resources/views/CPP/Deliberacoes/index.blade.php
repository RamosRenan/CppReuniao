<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Sd. Renan - 07/2019">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

        <title style="float:rigth;"> Deliberação </title>
    </head>


    
    <body> 
 
        <!-- Cabeçaho da deliberação. Textos da deliberção estão mapeados em 'Lang' -->
        <header style="position: relative; top: -20px;">
            <div> 
                @lang('globalDocsCpp.header.deliberacao') 
            </div>
        </header>


        <br> <br>



        <section style="width:99%; heigth:auto; position:relative; top:30px;">
            <div align="center"> 
                <span style="position: relative; top: -45px;"> <strong> <u> {{$numeration_deliberation_ata}}ª Reunião da Comissão de Promoções de Parças </u> </strong> </span>
                <h4 style="position:relative; top: -30px;"> 
                    <strong>   
                        {{
                            $respe = str_replace ( 
                                        array("++++"),
                                        array($numeration_deliberation_deliberacao), __('globalDocsCpp.titlecabecalho.deliberacao') 
                                    ) 
                        }} 
                    </strong>                
                 </h4>
            </div>
        </section>    





        <!-- @ **** = graduacao         @ -->
        <!-- @ !!!! = nome              @ -->
        <!-- @ 0000 = cpf               @ -->
        <!-- @ ¨¨¨¨ = unidade           @ -->
        <!-- @ &&&& = conteudo          @ -->
        <!-- @ +_+  = votacao_comissao  @ --> <!-- @ Aprovar | Desaprovar   @ -->
        <!-- @ °°°° = ComissaoCorum     @ --> <!-- @ Maioria | Unanimidade  @ -->
        <!-- @ %%%% = ComissaoOpnou     @ --> <!-- @ Deferimento | Indeferimento | Restituir | Postergar @ -->
        <!-- @ #### = relator_opnou_por @ -->
        <!-- @ @@@@ = eProtocolo        @ -->
        <section style="width:99%; heigth:auto; position:relative; top: 5px;">
            <div align="center" style="text-align:justify;" >  
               <div style="width:94%; heigth:auto; margin:auto;" align="center">
                    <form action="{{ route('cpp.deliberacao.create') }}"  method="PUT"  >
                        <textarea name="contain_deli" maxlength="1550" style="font-family: 'Times New Roman', Times, serif; width:100%; resize:none; border:none; text-align:justify; overflow: hidden;" rows="12" cols="60">                        
                            {{ 
                                str_replace( 
                                    array("****", "!!!!", "0000", "¨¨¨¨","&&&&",  "°°°°", "+_+", "####", "@@@@"),
                                    array($sidTableTotable[0]->graduacao , $sidTableTotable[0]->nome , $sidTableTotable[0]->cpf ,
                                    $sidTableTotable[0]->unidade, $sidTableTotable[0]->conteudo,  $ComissaoCorum ,  $sidTableTotable[0]->votacao_comissao, 
                                    $sidTableTotable[0]->relator_opnou_por, $sidTableTotable[0]->eProtocolo),
                                    __('globalDocsCpp.comissaoVotacao.pontosPositivos') 
                                ) 
                            }}                                    
                        </textarea>
                        <input type="hidden" value="{{$sidTableTotable[0]->eProtocolo}}" name="eProtocolo">
                        <input type="hidden" value="{{$numeration_deliberation_deliberacao_ID}}" name="numeration_deliberation_deliberacao_ID">
                        <button type="submit"  id="validar" class=" btn btn-outline-primary" style=" width:15%; height:auto; position: relative; top: 300px; box-shadow:0px 1px 5px gray; ">
                            <span style=" color: gray; ">   Submeter aos relatores ...  </span>
                        </button>
                    </form>
                </div>
            </div> 
        </section> 
        
       




        <section style="width:100%; heigth:auto; position:relative; top: -70px;">
            <div style="margin-left:18px;"> 
                @lang('globalDocsCpp.comissaoVotacao.footer')
            </div>
        </section>
        
        
        
        
        <!-- obs corrigir -->
        <section style="width:100%; heigth:auto; position:relative; top: -40px;">
            <div align="center"> 
                <span>Curitiba, {{ date("d") }} de {{ date("M") }} de {{ date("Y") }}.</span>
            </div>
        </section> 



        <section style="width:100%; heigth:auto; position:relative; top: 10px;">
            <div align="center"> 
                <h4>Maj. QOPM Omar Bail.</h4> 
                <span> <strong> Presidente da CPP. </strong> <span>
            </div>
        </section> 
            
            
            
        <section style="width:100%; heigth:auto; position:relative; top: 60px;">
            <div style="margin-left:18px;"> 
                <span>
                    Eu, <strong> Assinado digitalmente em: </strong> {{$deliberacao[0]->created_at}} <strong> RG: </strong> {{$presidenteSecretario[0]->rg}}, {{$presidenteSecretario[0]->posto}} {{$presidenteSecretario[0]->nome}},
                    Secretário da Comissão de Promoção de Praças, lavrei a presente deliberação.
                 </span>
            </div>
        </section> 
        

        <!-- @ Style @ -->
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            
            th, td {
                padding: 5px;
                text-align: left;    
            }
        </style>
        <!-- Style -->

            
            
        <!-- @ Script's @ -->
        <script  type="text/javascript" > </script>
        <!-- Script's -->

            
    </body>
</html>
        
      