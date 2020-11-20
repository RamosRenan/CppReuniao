<!-- form  Busca militar informado no campo - url(/cpp/cadastroE-protocolo) -->
<form class="form-inline" method="GET" action="{{ route('cpp.cadastroE-protocolo.index') }}"> 
    <!-- card-header -->
    <div class="card-header" style="width: 100%; height: auto; ">
        <!-- row -->
        <div class="row" style="width: 100%;">
            <!-- col-md-4 -->
            <div class="col-md-4"> </div>
            <!-- col-md-4 -->

            <!-- col-md-4 -->
            <div class="col-md-4" style=" " align="center"> </div> 
            <!-- col-md-4 -->
            
            <!-- col-md-4 -->
            <div class="col-md-4" >  
                <div class="form-group" style="float: right;">
                    <input type="text" class="form-control" name="search_cpf_police" id="inputPassword2" placeholder="NOME | RG | CPF" required aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"> Encontrar &nbsp; <i class="fas fa-search" style=""></i> </button>
                    </div>
                </div>
            </div>                   
            <!-- col-md-4 -->
        </div>                
        <!-- row -->
    </div>
    <!-- card-header -->
</form> 
<!-- form -->