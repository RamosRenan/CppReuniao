@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

        <section style="position: relative; top: -30px;"> 
            <div class="row" align="center"> 
                <h5 style='margin-left: 10px; font-size: 16px; color:lightslategray;'>  Gerêncie Atas, Cadastro de Presidente , Secretário e Membros.  </h5>
              </div>
        </section>

        <!-- linha bottom yellow -->
        <div style="width:40%; height:1px; background:#ffbf00; position: relative; top: -40px;"> </div>



        <section style="position: relative; top: 0px;"> 
            <div class="card card-default"  style="position:relative; "> 

                <div class="card-header" style="height: 38px; "> 
                    <span> <strong> <i class="fas fa-user" id="fa-user"></i> Habilitar Relator |  <i class="fas fa-user-alt-slash"></i> Desabilitar Relator. </strong> </span> 
                    <i style="float:right; cursor:pointer;" class="fas fa-arrow-circle-down" id="fa-arrow-13"></i>
                </div>

                 <!-- @ card__body3 @ -->
                <div class="card-body" id="card__body13" style="height: auto; display:none;"> 

                    <h4 style="position:relative; top:-5px;"> Habilite ou Desabilite o Relator selecionado. </h4> 
                    <form method="GET" action="{{ route('cpp.presidentecomissao.create') }}">

                        <div class="row">
                            <div style="display:none;"> {{$y=0}} </div>
                            @for( $i = 0; $i < count($allUser); $i++)
                                <div class="col-4" style=" height:auto; "> 
                                    <strong style=" position:relative; top:-6px;" class="Habilitar"> 
                                        @if( $allUser[$i]->user_id_your_status == 1 )  
                                            <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" checked  onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                                            @else 
                                                <input style="width: 18px; height:18px;" type="checkbox" NAME="OPCAO{{$i}}" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}"  value="{{ $allUser[$i]->has_user_id.':'.'Habilitar'.':'.$allUser[$i]->role_id }}"  > 
                                        @endif
                                                <label for="Habilitar"> Habilitar </label> 
                                    </strong>

                                    <strong style=" position:relative; top:-6px;" class="Desabilitar">
                                        @if( $allUser[$i]->user_id_your_status == 0 ) 
                                            <input style="width: 18px; height:18px; margin-left:25px;" NAME="OPCAO{{$i}}" checked type="checkbox" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}" value="{{ $allUser[$i]->has_user_id.':'.'Desabilitar'.':'.$allUser[$i]->role_id }}" >  
                                            @else
                                                <input style="width: 18px; height:18px; margin-left:25px;" NAME="OPCAO{{$i}}" type="checkbox" onclick="disableEnableUser(this, {{$allUser[$i]->has_user_id}}, {{$y=$y+1}})" id="esc{{$y}}" value="{{ $allUser[$i]->has_user_id.':'.'Desabilitar'.':'.$allUser[$i]->role_id }}" >  
                                        @endif
                                                <label for="Desabilitar"> Desabilitar </label> 
                                    </strong>

                                    @if( $allUser[$i]->user_id_your_status == 1 ) 
                                        <input readonly style="background: #499ffc; color:white" class="form-control" value="{{ $allUser[$i]->name }} | ID: {{ $allUser[$i]->has_user_id }} | esc{{$y}} " id="{{$allUser[$i]->has_user_id}}" name="{{$allUser[$i]->has_user_id}}">  
                                        @else   
                                            <input readonly style="background: #e2e2e2; color:white" class="form-control" value="{{ $allUser[$i]->name }} | ID: {{ $allUser[$i]->has_user_id }} | esc{{$y}} " id="{{$allUser[$i]->has_user_id}}" name="{{$allUser[$i]->has_user_id}}">  
                                    @endif
                                    <input type="hidden" value="{{ count($allUser) }}" name="countMembers"> 
                                    <br>
                                </div>
                            @endfor
                        </div>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-hand-point-down"></i> Definir.</button>
                    </form>
                
                </div>
                <!-- @ card__body3 @ -->
            </div>
        </section>





        
        <section style="position: relative; top: 10px;">
            <div class="card card-default"  style="position:relative;top: -18px;"> 
                <div class="card-header" style="height: 38px; "> 
                    <span> <strong> <i class="fas fa-plus"></i> Iniciar Nova 'Ata'. </strong> </span> 
                    <i style="float:right; cursor:pointer;" class="fas fa-arrow-circle-down" id="fa-arrow-4"></i>
                </div>

                <div class="card-body" id="card__body4" style="height: 585px; display:none;"> 
                    <div style="width:100%; height: 100%; " > 
                        <div class="row" style="" align="center"> 
                            <span style="margin-left:8px;"> Últimas 5 atas. </span>  
                            <div class="col-12" >                                 
                                <table class="table" style=" overflow-y: scroll; max-height: 25px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID.</th>
                                            <th scope="col">Numero da ATA.</th>
                                            <th scope="col">Data de Inicio.</th>
                                            <th scope="col">Data de Término.</th>
                                            <th scope="col">Responsável por finalizar.</th>
                                            <th scope="col">More Info.</th>
                                        </tr>
                                    </thead>

                                    @if( isset($lastAta ))
                                    @foreach( $lastAta as $key )
                                    <tbody>                                        
                                                                              
                                        <tr>                                                
                                            <td > {{$key->id}}                     </td>
                                            <td > {{$key->numero_ata}}             </td>
                                            <td > {{$key->created_at}}             </td>
                                            <td > {{$key->data_termino}}           </td>
                                            <td > {{$key->response_finalized_ata}} </td>
                                            <td > -=-Implementar-=- </td>
                                        </tr> 
                                                                                                                     
                                    </tbody>
                                    @endforeach
                                    @endif

                                </table>
                            <div> 
                        <div> <!-- row -->

                        <div style="width:100%; height:1px; background:#ffbf00; margin-top:15px;"> </div>

                        <br>

                        <form method="GET" action="{{route('cpp.presidentecomissao.show', 0)}}">                                     
                        <div class="row" align="center">
                            <div class="col-4"> </div> 
                            <div class="col-4" >
                                <h3> Criar ata. <small> Número da ata é opcional. </small> </h3>
                                     <input name="novAta" type="number" class="form-control"  style="width: 100px;"> 
                                    <button style=" margin-left: 3px; " type="submit" class="btn btn-success"> <i class="fas fa-plus"> </i>  Criar ata. </button>                                         
                                 <br>
                                <small style="color:red;"> Atenção ! Para inserir manualmente o número da ata certifique-se para iserir na sequência correta. </small>  
                            </div>                             
                            <div class="col-4"> </div> 
                        </div> <!-- row -->
                        </form> 
                    </div>
                <div> <!-- card-body -->
            <div> 
        </section>







        <!-- @ Cadastrar Membros Relatores.  @ -->
        <section style="position: relative; top: -15px;">
            <div class="card card-default"  style="position:relative;top: 0px;"> 
                <div class="card-header" style="height: 38px; "> 
                    <span> <strong> <i class="fas fa-clipboard"></i> Cadastrar Membros Relatores. </strong> </span> 
                    <i style="float:right; cursor:pointer;" class="fas fa-arrow-circle-down" id="fa-arrow-5"></i>
                </div>

                <div class="card-body" id="card__body5" style="height: auto; display:none;"> 

                    <h4> <u> Membros Relatores Ativos atualmente. </u> </h4>
                   
                    <section>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> ID </th>
                                    <th scope="col"> Nome </th>
                                    <th scope="col"> Posto </th>
                                    <th scope="col"> RG </th>
                                    <th scope="col"> CPF </th>
                                    <th scope="col"> <div> Qualificação. </div> </th>
                                    <th scope="col"> Status. </th>
                                    <th scope="col"> Habilitar | Desabilitar | Del </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(isset($Members_Relatores_and_President))
                                    @foreach($Members_Relatores_and_President as $key)
                                        <tr>
                                            <th scope="row"> {{$key->id}} </th>
                                            <td> {{$key->nome}}          </td>
                                            <td> {{$key->posto}}        </td>
                                            <td> {{$key->rg}}           </td>
                                            <td> {{$key->cpf}}          </td>
                                            <form action="{{ route('cpp.secretario.edit', $key->id ) }}" method="GET">
                                                <td style="display: flex;"> 
                                                        <select name="edit_status_membro" id="" class="form-control">
                                                            <option selected value=" "> {{$key->qualificacao}}  </option>                                                             
                                                            <option  vlaue=""> Membro Efetivo                   </option>
                                                            <option  vlaue=""> Membro Suplente                  </option>
                                                        </select>
                                                        @if($key->user_id_your_status == 1)
                                                            <a style="display: flex;"> <button type="submit" class="btn btn-outline-primary">   <i class="fas fa-user-edit">   </i>  </button> </a>
                                                            @else
                                                                <i class="fas fa-user-alt-slash" style="color: #e5e5e5;"></i>
                                                         @endif
                                                </td>
                                            </form>                                            
                                            <td>  
                                                @if($key->user_id_your_status == 1)
                                                    <span style="color: #4caf50;"> Habilitado. </span>
                                                    @else
                                                        <span style="color: gray;"> Desabilitado. </span>
                                                @endif
                                            </td>

                                            <td> 
                                                <div>
                                                    <a href="{{ route('cpp.secretario.edit', ['key'=>$key->has_user_id, 'H'=>'H'] ) }}" style="margin-left: 5px;"> 
                                                        <button type="button" class="btn btn-outline-success">      <i class="fas fa-check">    </i> H      </button> 
                                                    </a>
                                                    
                                                    <a href="{{ route('cpp.secretario.edit', ['key'=>$key->has_user_id, 'D'=>'D'] ) }}" style="margin-left: 5px;"> 
                                                        <button type="button" class="btn btn-outline-secondary">  <i class="fas fa-times">      </i> D      </button> 
                                                    </a>

                                                    <a href="{{ route('cpp.secretario.edit', ['key'=>$key->has_user_id, 'Del'=>'Del'] ) }}" style="margin-left: 5px;"> 
                                                        <button type="button" class="btn btn-outline-danger">  <i class="fas fa-trash-alt">     </i> Del.   </button> 
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>




                    


                    <h4 style="position:relative; top:-5px;"> <u> Cadastrar Membros Relatores. </u> </h4> 

                    <div style="width:100%; auto;" > 
                       <div style="width:100%; height: auto;"> 
                            <form method="GET" action="{{ route('cpp.secretario.create') }}">                
                                <div class="row" style="width: 99.9%;"> 
                                    <div class="col-4"> 
                                        <label> Nome Completo <small> ou parcial </small> </label>
                                        <input type="text" class="form-control" required name="relator_name"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> Posto. </label>
                                        <select type="number" class="form-control" required  name="relator_posto">  
                                            <option>                </option>
                                            <option>  Maj. QOPM     </option>
                                            <option>  Cap. QOPM     </option>
                                            <option>  1° Ten. QOPM  </option>
                                            <option>  2° Ten. QOPM  </option>
                                            <option>  Maj. QOBM     </option>
                                            <option>  Cap. QOBM     </option>
                                            <option>  1° Ten. QOBM  </option>
                                            <option>  2° Ten. QOBM  </option>
                                        </select>
                                    </div>

                                    <div class="col-2"> 
                                        <label> RG. </label>
                                        <input type="text" class="form-control" required  name="relator_rg"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> CPF. </label>
                                        <input type="text" maxlength="14" class="form-control" required  name="relator_cpf"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> Qualificação. </label>
                                        <select type="number" class="form-control" required  name="relator_qualificacao">  
                                            <option>   </option>                                             
                                            <option  vlaue=""> Membro Efetivo                   </option>
                                            <option  vlaue=""> Membro Suplente                  </option>
                                        </select>
                                    </div>                                                                      
                                </div>

                                <div class="row" style="width: 99.9%;"> 
                                    <div class="col-9"> 
                                        <label> Portaria do CG. </label>
                                        <input type="text" class="form-control" placeholder="Portaria do CG nº 098" required  name="portariaCg">  
                                    </div> 

                                    <div class="col-3"> 
                                        <label> Data da Portaira. </label>
                                        <input type="date" class="form-control" required  name="datePortaria">  
                                    </div>    
                                </div><!-- row --> 

                                <br>
                                <button type="submit" class="btn btn-success"> <i class="fab fa-envira"></i> Cadastrar. </button>

                            </form>
                       </div>
                    </div>
                <div > 
            <div> 
        </section>
        <!-- @ Cadastrar Membros Relatores.  @ -->







        <!-- @ Cadastrar Presidente e Secretario.  @ -->
        <section style="position: relative; top: -30px;">
            <div class="card card-default"  style="position:relative;top: 8px;"> 
                <div class="card-header" style="height: 38px; "> 
                    <span> <strong> <i class="fas fa-headset"></i> | <i class="fas fa-crown"></i> Cadastrar Presidente & Secretario. </strong> </span> 
                    <i style="float:right; cursor:pointer;" class="fas fa-arrow-circle-down" id="fa-arrow-55"></i>
                </div>

                <div class="card-body" id="card__body55" style="height: auto; display:none;"> 

                    <h4> <u> Presidentes e Secretarios. </u> </h4>
                   
                    <section>
                        <table class="table">
                            <thead  style="background: #007bff; color:blanchedalmond;">
                                <tr>
                                    <th scope="col"> ID </th>
                                    <th scope="col"> Nome </th>
                                    <th scope="col"> Posto </th>
                                    <th scope="col"> RG </th>
                                    <th scope="col"> CPF </th>
                                    <th scope="col"> <div> Qualificação. </div> </th>
                                    <th scope="col"> Status. </th>
                                    <th scope="col"> Habil. | Desab. | Deletar </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(isset($ativeInativePresidenteSecretario))
                                    @foreach($ativeInativePresidenteSecretario as $key)
                                        <tr>
                                            <th scope="row"> {{$key->id}} </th>
                                            <td> {{$key->nome}}          </td>
                                            <td> {{$key->posto}}        </td>
                                            <td> {{$key->rg}}           </td>
                                            <td> {{$key->cpf}}          </td>
                                            <form action="{{ route('cpp.secretario.edit', $key->id ) }}" method="GET">
                                                <td style="display: flex;"> 
                                                    {{$key->qualificacao}}                                                               
                                                </td>
                                            </form>                                            
                                            <td>  
                                                @if($key->status == 1)
                                                    <span style="color: #4caf50;"> Habilitado. </span>
                                                    @else
                                                        <span style="color: gray;"> Desabilitado. </span>
                                                @endif
                                            </td>

                                            <td> 
                                                <div>
                                                     <a href=" editSecretarioEPresidente?id={{$key->id}}&Hbl=H " style="margin-left: 5px; color:#4caf50;"> 
                                                        <i class="fas fa-check"></i> H    
                                                    </a>
                                                    
                                                    <a href=" editSecretarioEPresidente?id={{$key->id}}&Des=D " style="margin-left: 18px; color:gray;"> 
                                                        <i class="fas fa-ban"></i> D   
                                                    </a>

                                                    <a href=" editSecretarioEPresidente?id={{$key->id}}&Del=Del " style="margin-left: 35px; color:#dc3545;s"> 
                                                        <i class="fas fa-trash-alt"></i> Del.   
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <hr>
                    </section>




                    


                    <h4 style="position:relative; top:-5px;"> <u> Cadastrar Presidente & Secretario. </u> </h4> 

                    <div style="width:100%; auto;" > 
                       <div style="width:100%; height: auto;"> 
                            <form  method="post" action="novoSecretarioPresidente">  
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                <div class="row" style="width: 99.9%;"> 
                                    <div class="col-3"> 
                                        <label> Nome Completo <small style="color: #66afff;"> ou nome. </small> </label>
                                        <input type="text" class="form-control" required name="presidenteSecretario_name"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> Posto. </label>
                                        <select type="number" class="form-control" required  name="presidenteSecretario_posto">  
                                            <option> Selecione o POSTO. </option>
                                            <option>  Maj. QOPM         </option>
                                            <option>  Cap. QOPM         </option>
                                            <option>  1° Ten. QOPM      </option>
                                            <option>  2° Ten. QOPM      </option>
                                            <option>  --                </option>
                                            <option>  Maj. QOBM         </option>
                                            <option>  Cap. QOBM         </option>
                                            <option>  1° Ten. QOBM      </option>
                                            <option>  2° Ten. QOBM      </option>
                                        </select>
                                    </div>

                                    <div class="col-2"> 
                                        <label> RG. </label>
                                        <input type="number" class="form-control" required  name="presidenteSecretario_rg"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> CPF. </label>
                                        <input type="number" class="form-control" require  name="presidenteSecretario_cpf"> 
                                    </div>

                                    <div class="col-2"> 
                                        <label> Qualificação. </label>
                                        <select type="number" class="form-control" require  name="presidenteSecretario_qualificacao">  
                                            <option> Selecione a QUALIFICAÇÃO.  </option>                                             
                                            <option  vlaue=""> Presidente                   </option>
                                            <option  vlaue=""> Secretario                 </option>
                                        </select>
                                    </div>                                                                      
                                </div>

                                <br>
                                <button type="submit" class="btn btn-success"> Cadastrar. </button>

                            </form>
                       </div>
                    </div>
                <div > 
            <div> 
        </section>
        <!-- @ Cadastrar Presidente e Secretario.  @ -->








        <!-- @ Reabrir Votação.  @ -->
        <section style="position: relative; "> 
            <div class="card card-default"  style="position:relative; top:-30px;"> 
                <div class="card-header" style="height: 38px; " > 
                    <span style="color: #dc3545;"> <strong> <i class="fas fa-lock-open"></i>  Reabrir Votação. </strong> </span> 
                    <i style="float:right; cursor:pointer;" class="fas fa-arrow-circle-down" id="fa-arrow-7"></i>
                </div>
                    
                <!-- @ card__body7 @ -->
                <div class="card-body" id="card__body7" style="height: 580px; display:none;"> 
                            
                    <div class="row"  align="center"> 
                        <div class="col-4"> </div>
                        <div class="col-4"> 
                            <i class="fas fa-info-circle"></i>
                            <span style="color: #dc3545;">                                      
                                ! Atenção. Reabrir constantemente deliberações, poderá a longo prazo causar inconsistências no banco de dados. 
                                <br>
                                <hr>
                                <span style="color:lightslategray;"> Ultimas deliberações. </span>
                            </span>
                        </div>
                        <div class="col-4"> </div>
                    </div> 


                    <br>


                    <table class="table" style="border-radius: 9px; box-shadow: 0px 0px 5px 2px gray;">
                        <thead style=" border-radius: 9px; ">
                            <span> <strong> Total.: </strong> {{ count($LastDeliberacao) }} Deliberações. </span>
                            <tr style="background: #494949; "  align="center">
                                <th scope="col" style="max-width: 55px; color: #dbdbdb;" > Em aberto. </th>
                                <th scope="col" style="color: #dbdbdb;"> ID. </th>
                                <th scope="col" style="color: #dbdbdb;">eProtocolo.</th>
                                <th scope="col" style="color: #dbdbdb;">Pertence  ATA.</th>
                                <th scope="col" style="color: #dbdbdb;">Número Deliberação.</th>
                                <th scope="col" style="color: #dbdbdb;">Data Criação.</th>
                                <th scope="col" style="color: #dbdbdb;">Visualizar Deliberação.</th>
                                <th scope="col-1" style="color: #ed4754; max-width: 25px;">Reabrir.</th>
                                <th scope="col-1" style="color: #dbdbdb; max-width: 25px;">Fechar.</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if( isset($LastDeliberacao) )
                                @foreach($LastDeliberacao as $key)
                                    <tr align="center">                                            
                                        <td> @if($key->read_at == null) <i style="color: orange; font-size: 25px;" class="fas fa-exclamation-triangle"></i> @endif </td>
                                        <td> {{ $key->id }} </td>
                                        <td>{{ $key->eProtocolo }}          </td>
                                        <td>{{ $key->numero_ata }}          </td>
                                        <td>{{ $key->num_deliberacao }}     </td>
                                        <td>{{ $key->created_at }}          </td>
                                        <td> <a href=" {{ route('cpp.secretario.show', [$key->id_notification, 'visualizar'=>'visualizar'] ) }} "> <u> Visualzar.  </u> </a>
                                        <td> <a href="{{ route('cpp.secretario.show', [$key->id_notification, 'open'=>1]) }}"> <button type="button" class="btn btn-outline-danger"> <i class="far fa-folder-open"></i> </button></td> </a>
                                        <td> <a href="{{ route('cpp.secretario.show', [$key->id_notification, 'close'=>0]) }}"> <button type="button" style="color:#dbdbdb; border: solid 1px #dbdbdb;" class="btn btn-outline-success"> <i class="far fa-folder"></i> </button></td> </a>
                                    </tr>
                                @endforeach
                            @endif
                            
                        </tbody>
                    </table>    

                </div>
                <!-- @ card__body7 @ -->
            </div>
        </section>
        <!-- @ Reabrir Votação.  @ -->






        <!-- @ Contain todos os disparos de erros e avisos @ -->

            @if( session('moreThanOneDeliberOpen') == true)
            <section>
                <div class="row">
                    <div class="col-12"> 
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-user-alt-slash"></i> ! Ação não permitida. <small> Não é possível abrir mais de uma deliberação ao mesmo tempo. </small>
                        </div>
                    </div>
                </div>
            </section>
            @endif



            @if( isset($lack_fields))
            @if( session('lack_fields') == false)
            <section>
                <div class="row">
                    <div class="col-12"> 
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-user-alt-slash"></i> Não Cadastrado.
                        </div>
                    </div>
                </div>
            </section>
            @endif
            @endif



            @if( session('saveSuccess') == true)
            <section>
                <div class="row">
                    <div class="col-12"> 
                        <div class="alert alert-success" role="alert">
                            Usuário inserido com sucesso. 
                        </div>
                    </div>
                </div>
            </section>
            @endif
            
        
        
        
            @if( session('not_found_name_user') == true )
            <section>
                <div class="row">
                    <div class="col-12"> 
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-user-alt-slash"></i> Nome de usuário não encontrado ! <small> A consulta considera letras maiusculas e minusculas. </small>
                        </div>
                    </div>
                </div>
            </section>
            @endif





            <section>
                <div class=""  style=""> 
                    @if(isset($DangerAtaFinalized) && $DangerAtaFinalized == "DangerAtaFinalized")
                    <div class="alert alert-danger" role="alert">
                        Error.:DangerAtaFinalized. Não foi possível criar ATA, encontrado ata não finalizada na base de dados !
                    </div>
                    @endif
                <div> 
            </section>

            


            <section>
                <div class=""  style=""> 
                    @if(isset($Success) && $Success == "success")
                    <div class="alert alert-success" role="alert">
                        Membros Inseridos / Atualizados com sucesso !
                    </div>
                    @endif
                <div> 
            </section>




            <section>
                <div class=""  style=""> 
                    @if(session('allFields') == "false")
                    <div class="alert alert-danger" role="alert">
                        Por favor preencha todos os campos !
                    </div>
                    @endif
                <div> 
            </section>





            <section>
                <div class=""  style=""> 
                    @if(session('errorCadastPresidentSecretario') == "false")
                    <div class="alert alert-danger" role="alert">
                        Atenção ! Erro durante a inserção dos dados na base de dados. Contate o suporte. !!!
                    </div>
                    @endif
                <div> 
            </section>



            <section>
                <div class=""  style=""> 
                    @if(session('ataFinalized'))
                    <div class="alert alert-danger" role="alert">
                        Não é possível reabrir deliberação que pertence a uma Ata que foi finalizada !!!
                    </div>
                    @endif
                <div> 
            </section>

        <!-- @ Contain todos os disparos de erros e avisos @ -->







            <!-- @ SCRPT'S @ -->
            <script type="text/javascript"> 

                $("#fa-arrow-").on("click", function(){                    

                    var oo =  $("#fa-arrow-" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body").slideDown();
                        $("#fa-arrow-" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body").slideUp();
                        $("#fa-arrow-" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });




                $("#fa-arrow-55").on("click", function(){                    

                    var oo =  $("#fa-arrow-55" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body55").slideDown();
                        $("#fa-arrow-55" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body55").slideUp();
                        $("#fa-arrow-55" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });





                $("#fa-arrow-13").on("click", function(){                    

                    var oo =  $("#fa-arrow-13" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body13").slideDown();
                        $("#fa-arrow-13" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body13").slideUp();
                        $("#fa-arrow-13" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });





                $("#fa-arrow-2").on("click", function(){                    

                    var oo =  $("#fa-arrow-2" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body2").slideDown();
                        $("#fa-arrow-2" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body2").slideUp();
                        $("#fa-arrow-2" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });





                $("#fa-arrow-3").on("click", function(){                    

                    var oo =  $("#fa-arrow-3" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body3").slideDown();
                        $("#fa-arrow-3" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body3").slideUp();
                        $("#fa-arrow-3" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });




                $("#fa-arrow-4").on("click", function(){                    

                    var oo =  $("#fa-arrow-4" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body4").slideDown();
                        $("#fa-arrow-4" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body4").slideUp();
                        $("#fa-arrow-4" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });



                $("#fa-arrow-5").on("click", function(){                    

                    var oo =  $("#fa-arrow-5" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body5").slideDown();
                        $("#fa-arrow-5" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body5").slideUp();
                        $("#fa-arrow-5" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });





                $("#fa-arrow-7").on("click", function(){                    

                    var oo =  $("#fa-arrow-7" ).attr('class');

                    if(oo == "fas fa-arrow-circle-down"){
                        $("#card__body7").slideDown();
                        $("#fa-arrow-7" ).removeClass("fas fa-arrow-circle-down").addClass("fas fa-arrow-circle-up");
                    }else{
                        $("#card__body7").slideUp();
                        $("#fa-arrow-7" ).removeClass("fas fa-arrow-circle-up").addClass("fas fa-arrow-circle-down");
                    }
                });






                function disableEnableUser(e, id, i){
                    // var es = "esc".concat(i);
                    // alert(es);
                    var getClass = e.parentNode.getAttribute('class');
                    if(getClass == 'Desabilitar'){                        
                        var el = document.getElementById(id).style.background = "#e2e2e2"; 
                        var es = "esc".concat(i-1); 
                        document.getElementById(es).checked = false;
                    }else{
                        var el = document.getElementById(id).style.background = "#499ffc";
                        var es = "esc".concat(i+1);
                        document.getElementById(es).checked = false;
                    }
                    //alert(aalert.getAttribute('class'));
                }







                var ctx = document.getElementById('pieChart0');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });




                var ctx = document.getElementById('pieChart1');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });





                var ctx = document.getElementById('pieChart2');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });







                var ctx = document.getElementById('pieChart3');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });







                var ctx = document.getElementById('pieChart4');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });









                var ctx = document.getElementById('pieChart5');
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {    
                            
                    datasets: [{
                        data: [ 12, 12, 12, 
                                12, 12, 12,   
                                12, 12, 12, 
                                12, 12, 12],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',                                
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',                                
                            'rgb(201, 203, 207)',
                            'black',
                            'rgb(220, 53, 69)',                                
                            'rgb(44, 62, 80)',
                            'rgb(243, 156, 18)',
                            'RGB( 211, 84, 0 )',                                
                        ],
                        borderColor: [
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                            'white',
                            'white',
                            'white',                                
                        ],
                        borderWidth: 3
                    }]

                }

                });

            </script>
            <!-- @ SCRPT'S @ -->







@endsection