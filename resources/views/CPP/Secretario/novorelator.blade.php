@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <!-- @ Cadastrar Membros Relatores.  @ -->
    <section style="position: relative; top: -15px;">
        <div class="card" style="position:relative;top: 0px;"> 

            <div class="card-footer" style="height: 40px;"> 
                <h5 style=" "> 
                    <i class="fas fa-id-card"></i>  
                    &nbsp; Cadastrar Membros Relatores. 
                </h5> 
            </div>

            <!-- card body -->
            <div class="card-body" id="card__body5" style="height: auto; "  > 
                
                <button type="button" style="border:none; padding-left: 9px; padding-top: 4px; padding-right: 9px; background: transparent;" data-toggle="modal" data-target="#exampleModal">
                    <h5 > <small> <a href="#" style="color: #869c98;"> <i class="fas fa-user-alt-slash"></i> &nbsp; Relatores desabilitados </a> </small> </h5>
                </button>
                
                <br> 

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                    <!-- modal-dialog -->
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <!-- modal-content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user-alt-slash"></i> &nbsp; Relatores desabilitados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="nome | rg | cpf" aria-label="nome | rg | cpf" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"> Buscar </button>
                                    </div>
                                </div>

                                <!-- table habilitados -->
                                <section>
                                    <table class="table">
                                        <thead class="">
                                            <tr align="center">
                                                <th scope="col"> Nome </th>
                                                <th scope="col"> Posto </th>
                                                <th scope="col"> RG </th>
                                                <th scope="col"> <div> Qualificação. </div> </th>
                                                <th scope="col"> Status. </th>
                                                <th scope="col"> <span style="color: green;"> Hab. </span> </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(isset($Members_Relatores_and_President))
                                                @foreach($Members_Relatores_and_President as $key)
                                                @if($key->user_id_your_status == 0)
                                                    <tr align="center">
                                                        <!-- nome -->
                                                        <td align="left"> {{$key->nome}}     </td>

                                                        <!-- posto -->
                                                        <td> {{$key->posto}}    </td>

                                                        <!-- rg -->
                                                        <td> {{$key->rg}}       </td>

                                                        <!-- Qualificação -->
                                                        <form action="editSecretarioEPresidente" method="GET">
                                                            <input type="hidden" value="{{$key->has_user_id}}" name="keyid">
                                                            <td style="display: flex;"> 
                                                                <span selected value=" "> {{$key->qualificacao}}  </span>                                                             
                                                            </td>
                                                        </form> 
                                                        
                                                        <!-- status -->
                                                        <td>  
                                                            <span style="color: gray;"> Desabilitado. </span>
                                                        </td>

                                                        <!-- button -->
                                                        <td > 
                                                            <div>
                                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&H=H" style="margin-left: 5px;"> 
                                                                    <button type="button" class="btn btn-outline-success"> <i class="fas fa-check"> </i>  </button> 
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </section>
                                <!-- table -->
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                
                <!-- table habilitados -->
                <section>
                    <table class="table">
                        <thead class="">
                            <tr align="center">
                                <th scope="col"> Nome </th>
                                <th scope="col"> Posto </th>
                                <th scope="col"> RG </th>
                                <th scope="col"> CPF </th>
                                <th scope="col"> <div> Qualificação. </div> </th>
                                <th scope="col"> Status. </th>
                                <th scope="col"> <span style="color: green;"> Hab. </span> | <span style="color: gray;"> Desab. </span> | <span style="color: red;"> Del. </span> </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($Members_Relatores_and_President))
                                @foreach($Members_Relatores_and_President as $key)
                                @if($key->user_id_your_status == 1)
                                    <tr>
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
                                            <span style="color: #4caf50;"> Habilitado. </span>
                                        </td>
                                        <td align="center"> 
                                            <div>
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&H=H" style="margin-left: 5px;"> 
                                                    <button type="button" class="btn btn-outline-success">      <i class="fas fa-check"> </i>  </button> 
                                                </a>
                                                
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&D=D" style="margin-left: 5px;"> 
                                                    <button type="button" class="btn btn-outline-secondary">  <i class="fas fa-times">   </i>  </button> 
                                                </a>

                                                <!-- não pode ser deletado, pois os relatores tem histórico de deliobherações -->
                                                <a href="editRegistryRelator?key={{$key->has_user_id}}&D=D" style="margin-left: 5px;"> 
                                                    <button type="button" class="btn btn-outline-danger">  <i class="fas fa-trash-alt">  </i>  </button> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </section>
                <!-- table habilitados -->

                <hr>

                <h5 style="position:relative; top:-5px;"> &nbsp; Cadastre um novo membro relator. </h5> 

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
                            <button type="submit" class="btn btn-success"> Cadastrar </button>
                        </form>
                    </div>
                </div>
                <!-- @@ -->
            <div > 
            <!-- bard body -->
        <div> 
    </section>
    <!-- @ Cadastrar Membros Relatores.  @ -->

    <br>

    <script type="text/javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
        })
    </script>

@endsection