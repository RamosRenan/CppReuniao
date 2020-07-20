@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <!-- @ Cadastrar Membros Relatores.  @ -->
    <section style="position: relative; top: -15px;">
        <div class="card card-default"  style="position:relative;top: 0px;"> 

            <div class="card-header" style="height: 38px; "> 
                <span> <strong> <i class="fas fa-clipboard"></i> Cadastrar Membros Relatores. </strong> </span> 
            </div>

            <!-- card body -->
            <div class="card-body" id="card__body5" style="height: auto; " align="center"> 

                <h4> <u> Membros Relatores Ativos atualmente. </u> </h4>
                
                <!-- table -->
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
                                        <form action="editSecretarioEPresidente" method="GET">
                                            <input type="hidden" value="{{$key->has_user_id}}" name="keyid">
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
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&H=H" style="margin-left: 5px;"> 
                                                    <button type="button" class="btn btn-outline-success">      <i class="fas fa-check">    </i> H      </button> 
                                                </a>
                                                
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&D=D" style="margin-left: 5px;"> 
                                                    <button type="button" class="btn btn-outline-secondary">  <i class="fas fa-times">      </i> D      </button> 
                                                </a>

                                                <!-- não pode ser deletado, pois os relatores tem histórico de deliobherações -->
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&D=D" style="margin-left: 5px;"> 
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
                <!-- table -->


                <h4 style="position:relative; top:-5px;"> <u> Cadastrar Membros Relatores. </u> </h4> 

                <!-- @ -->
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
                <!-- @@ -->

            <div > 
            <!-- bard body -->

        <div> 
    </section>
    <!-- @ Cadastrar Membros Relatores.  @ -->

@endsection