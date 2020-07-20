@extends('layouts.app')

@yield('content_header')
    <link rel="stylesheet" type="text/css" href="/css/SalaVotacao/slavot.css"> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
@yield('content')

@section('content')

    <!-- @ Cadastrar Presidente e Secretario.  @ -->
    <section style="position: relative; top: -30px;">
        <!-- @ card card-default @ -->
        <div class="card card-default"  style="position:relative;top: 8px;"> 
            <div class="card-header" style="height: 38px; "> 
                <span> <strong> <i class="fas fa-headset"></i> | <i class="fas fa-crown"></i> Cadastrar Presidente & Secretario. </strong> </span> 
            </div>

            <!-- @ card-body @ -->
            <div class="card-body" id="card__body55" style="height: auto; " align="center"> 

                <h4> <u> Presidente & Secretario. </u> </h4>
                
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
                                                <a href="editRegistryPresidentSecretario?key={{$key->id}}&H=H " style="margin-left: 5px; color:#4caf50;"> 
                                                    <i class="fas fa-check"></i> H    
                                                </a>
                                                
                                                <a href="editRegistryPresidentSecretario?key={{$key->id}}&D=D " style="margin-left: 18px; color:gray;"> 
                                                    <i class="fas fa-ban"></i>   D   
                                                </a>

                                                <a href="editRegistryPresidentSecretario?key={{$key->id}}&Del=Del " style="margin-left: 35px; color:#dc3545;s"> 
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
                                <div class="col-4"> 
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
                                        <option> Qualificação.  </option>                                             
                                        <option  vlaue=""> Presidente                   </option>
                                        <option  vlaue=""> Secretaria(o)                 </option>
                                    </select>
                                </div>                                                                      
                            </div>

                            <br>
                            <button type="submit" class="btn btn-success"> Cadastrar. </button>

                        </form>

                    </div>

                </div>

            <div > 
            <!-- @ card-body @ -->
        <div> 
        <!-- @ card card-default @ -->
    </section>
    <!-- @ Cadastrar Presidente e Secretario.  @ -->

@endsection

