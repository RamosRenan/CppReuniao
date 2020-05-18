@extends('layouts.app')
		
@yield('content_header')

@yield('content')

@section('content')

    <style> 
        th{
            font-size: 14px;
        }
    </style>

        <div class="card" style="position:relative; top: 8px;">
            <div class="card-header"> <i class="fa fa-id-card" style="font-size:25px;" aria-hidden="true"></i> <strong style="margin-left: 15px;"> Editar Cadastro.</strong> </div>    
        </div>
	

	<div class="panel-body table-responsive">
        @if( !count($editSid) <= 0 )
        {!! Form::open(['method'=>'PUT', 'route'=>['cpp.cadastroE-protocolo.update', $editSid[0]->eProtocolo]]) !!}        

		<table class="table table-bordered table-striped dt-select">
			
            <thead>
                    <tr>
                        <th class=" ">
                            Nome 
                        </th>

                        <th class=" ">
                            RG 
                        </th>

                        <th class=" ">
                            Pedido 
                        </th>

                        <th class=" ">
                            CPF 
                        </th>

                        <th class=" ">
                            Unidade 
                        </th>

                        <th class=" ">
                            Graduação 
                        </th>

                        <th class=" ">
                            eProtocolo 
                        </th>

                        <th class=" ">
                            Status 
                        </th>

                        <th class=" ">
                            Cadastrado 
                        </th>
                    
                    </tr>
                </thead>
			
			    <tbody><!-- tbody -->
            
			
                    @if(isset($editSid))
                        
                            <input type="hidden" value=" {{ $editSid[0]->eProtocolo }} " name="findSid">

                            <input type="hidden" value=" {{ $editSid[0]->cpf }} " name="findcpf">

                            <tr data-entry-id=""  style="text-align: justify;">

                                <td align="center">
                                    <input class="form-control" value=" {{ $editSid[0]->nome }} " name="nome" type="text" placeholder="" style="background: #f4f6f9;">							
                                </td>

                                <td align="center">
                                    <input class="form-control" value=" {{ $editSid[0]->rg }} " name="rg" type="text" placeholder="" style="background: #f4f6f9;">
                                </td>

                                <td align="center">
                                    <select required style="border: 1px solid #d9dce0; background: #f4f6f9; width:100%; height:34px;" onchange="keyped()"  id="pedido" name = "pedido">
                                        <option selected >   	</option>

                                        <option value="Promoção à graduação  de Sub.Tenente QPM 1-0">Promoção à graduação  de Sub.Tenente QPM 1-0</option>

                                        <option value="Promoção à graduação  de 1º Sgt. QPM 1-0">Promoção à graduação  de 1º Sgt. QPM 1-0</option>

                                        <option value="Promoção à graduação  de 2º Sgt. QPM 1-0">Promoção à graduação  de 2º Sgt. QPM 1-0</option>

                                        <option value="Promoção à graduação  de 3º Sgt. QPM 1-0" >Promoção à graduação  de 3º Sgt. QPM 1-0</option>

                                        <option value="Promoção à graduação  de Cb. QPM 1-0">Promoção à graduação  de Cb. QPM 1-0</option>

                                        <option value="Ressarcimento de Preterição">Ressarcimento de Preterição </option>

                                        <option value="Reclassificação do Quadro" >Reclassificação do Quadro</option>

                                        <option value="Retificação de publicação">Retificação de publicação</option>

                                        <option value="Reconsideração de Ato">Reconsideração de Ato</option>

                                        <option value="Pontos positivos">Pontos positivos</option>

                                        <option value="Ato de Bravura" >Ato de Bravura</option>

                                        <option value="Sub-Judice">Sub-Judice</option>
                                    </select>
                                    
                                    <input type="hidden" name="keypedido" id="keyp" value="  "> <!-- No final do código, scrpit responsável por pegar 'value' de 'option' e inserir no '<input type="hidden" name="keypedido">'. Verificar o motivo no aquivo " App\Http\Controllers\Presidente\PresidenteController "  -->
                                    
                                </td>

                                <td style="max-width: 450px;">	 
                                    <input required class="form-control" value=" {{ $editSid[0]->cpf }} " name="cpf" type="text" placeholder="" style="background: #f4f6f9;">	
                                </td>

                                <td align="center"> 
                                    <input required class="form-control" value= " {{ $editSid[0]->unidade }} " name="unidade" type="text" placeholder="" style="background: #f4f6f9;">	
                                </td>

                                <td> 
                                    <input required class="form-control" value=" {{ $editSid[0]->graduacao }} " name="graduacao" type="text" placeholder="" style="background: #f4f6f9;">
                                </td>

                                <td> 
                                    <input required class="form-control" value=" {{ $editSid[0]->eProtocolo }} " name="eProtocolo" type="text" placeholder="" style="background: #f4f6f9;">
                                </td>

                                <td> 
                                    <input required readonly class="form-control" name="status" value=" {{ $editSid[0]->status }} " type="text" placeholder="" style="background: #f4f6f9;">
                                </td>

                                <td> 
                                    <input required class="form-control" value=" {{ $editSid[0]->entry_system_data }} " name="entry_system_date" type="date" placeholder="" style="background: #f4f6f9;">
                                </td>

                            </tr>                            
                        @else
                            
                    @endif						
                    
                </tbody><!-- tbody -->

        </table>


        <table> 
            <tbody> 
                <tr align="center">
                    <label> <strong> DESCRIÇÃO. </strong>  </label>
                    <textarea value=" " type="text" name="conteudo" style=" min-width:100%; overflow: hidden; background: #f4f6f9;" rows="10" cols="60"> 
                        {{ $editSid[0]->conteudo }} 
                    </textarea>
                </tr>
            </tbody>
        </table>
        
        <button type="submit" class="btn btn-warning">  <i class="fa fa-edit" style="font-size: 22px"></i> Confirmar edição. </button>
        
        {!! Form::close() !!} <!-- form -->
        
            @else
                <div style="width: 100%; height: auto;" align="center"> 
                    <span > <h3 style="color: #5b5b5b;"> Info ! <small style="font-size: 16px; color: #9e9e9e;" > eProtocolos que já foram SORTEADOS não podem ser alterados. </small> </h3>  </span> 
                    <i class="fas fa-ban" style="font-size: 40px; color: #5b5b5b; "></i>
                </div>

        @endif
    </div><!-- panel-body table-responsive -->    

    <div class="panel-footer text-center"> </div>
    



<!-- Script's  -->
<script>
		/*
		*select option chama esta função
		*Insere na tabela:'sid' coluna:'codigo pedido' uma string única para cada tipo de pedido
		*/
		function keyped(){
			//var run = document.getElementById("pedido").length;
			var val = document.getElementById("pedido").value;

			switch (val) {

				//
				case "Promoção à graduação  de Sub.Tenente QPM 1-0":
					document.getElementById("keyp").value = "PROM00SUB";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Promoção à graduação  de 1º Sgt. QPM 1-0":
					document.getElementById("keyp").value = "PROM1ºSGT";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Promoção à graduação  de 2º Sgt. QPM 1-0":
					document.getElementById("keyp").value = "PROM2ºSGT";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Promoção à graduação  de 3º Sgt. QPM 1-0":
					document.getElementById("keyp").value = "PROM3ºSGT";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Promoção à graduação  de Cb. QPM 1-0":
					document.getElementById("keyp").value = "PROM00CB";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Ressarcimento de Preterição":
					document.getElementById("keyp").value = "RESS00P";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Reclassificação do Quadro":
					document.getElementById("keyp").value = "RECLA00Q";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Retificação de publicação":
					document.getElementById("keyp").value = "RET00P";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Reconsideração de Ato":
					document.getElementById("keyp").value = "RECON00A";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Pontos positivos":
					document.getElementById("keyp").value = "PON00P";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Ato de Bravura":
					document.getElementById("keyp").value = "ATO00B";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				case "Sub-Judice":
					document.getElementById("keyp").value = "SUB00J";
					var keypedido = document.getElementById("keyp").value;
					alert(keypedido);
					break;
				//
				default:
					alert("Não válido");
					break;

			}//Final Switch Case:


		}

	</script>
	<!-- Script's -->


@endsection
