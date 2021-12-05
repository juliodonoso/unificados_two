@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('comments') }}">  
                {{ csrf_field() }}   
                 @foreach($comentarios as $resp)                 
                    <div class="row">                        
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Sponsor</label>
                            <input type="text" class="form-control" value ="{{$resp->sponame}}" readonly="true">
                        </div> 
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Canal</label>
                            <input type="text" class="form-control" value ="{{$resp->canal}}" readonly="true">
                        </div>
                        <div class="col-sm-6" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Campaña</label>
                            <input type="text" class="form-control" value ="{{$resp->campania}}" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Rut Cliente</label>
                            <input type="text" class="form-control" value ="{{$resp->rutcli}} - {{$resp->dvcli}} " readonly="true">
                        </div> 
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Operador Evaluado</label>
                            <input type="text" class="form-control" value ="{{$resp->opereva}}" readonly="true">
                        </div>
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Fecha Vta</label>
                            <input type="text" class="form-control" value ="{{$resp->Fvta}}" readonly="true">
                        </div>
                        <div class="col-sm-3" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Fecha Audit</label>
                            <input type="text" class="form-control" value ="{{$resp->created_at}}" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Id Grabacion</label>
                            <input type="text" class="form-control" value ="{{$resp->idGrab}} " readonly="true">
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Observaciones</label>
                            <!-- <input type="text" class="form-control" value ="{{$resp->observ}} " readonly="true"> -->
                            <textarea class="form-control" id="tt01" rows="4" name="cmmtcall" readonly="true"  style="text-transform:uppercase; height: 90px;" value ="{{$resp->observ}} "></textarea>
                        </div>                     
                    </div>
                    <hr>
                    <!-- CALL CENTER  -->
                    <label for="">CALL CENTER</label>        
                    <div class="row">                                                              
                        <div class="form-check">
                            <label class="form-check-label">
                                <input id="chk01" name="chk01"class="form-check-input" type="checkbox" >
                                <span class="form-check-sign"></span>
                                APELACION
                            </label>
                        </div>  
                    </div>  
                    <div class="row">
                        <div class="col-sm-8" id="Camp">  <!-- Sponsor / Campaña -->
                            <label>Auditor Calidad Call Center</label>
                            <input type="text" class="form-control" name="audcall" value ="{{$resp->AuditorCall}}">
                        </div>                                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="Camp">
                            <label>Comentarios Call Center</label>
                            <textarea class="form-control" id="tt01" rows="4" name="cmmtcall" style="text-transform:uppercase; height: 90px;"  >{{$resp->CommentsCall}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <!-- BECS  -->
                    <label for="">CIA BECS</label>                 
                        <div class="row">                        
                            <div class="col-md-6">
                                <label>Resolucion Final - BECS</label>         
                                <select name="resol" class="form-control" id="resol">
                                    <option selected disabled>Seleccione opcion ...</option>                                      
                                    <option value=1>SE ACEPTA LA APELACION Y SE CAMBIA ESTADO</option>
                                    <option value=2>SE RECHAZA APELACION SE MANTIENE NOTA</option>
                                    <option value=3>PENDIENTE</option>
                                    <option value=4>ALERTA CRITICA</option>                                                                            
                                </select> 
                            </div> 
                            <div class="col-md-6">
                                <label>Acciones CIA - BECS</label>         
                                <select name="Acccia" class="form-control" id="Acccia">
                                    <option selected disabled>Seleccione opcion ...</option>                                      
                                    <option value=1>RETROALIMENTACION CALL CENTER</option>
                                    <option value=2>RETROALIMENTACION EMPRESA AUDITORA</option>
                                    <option value=3>PENDIENTE</option>                                                                                                       
                                </select> 
                            </div> 
                        </div>                        
                        <div class="row">
                            <div class="col-sm-12" id="Camp">
                                <label>Comentarios CIA BECS</label>
                                <textarea class="form-control" id="tt01" rows="4" name="cmmtcia" style="text-transform:uppercase; height: 90px;">{{$resp->CommentsCIA}}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="ID" id="ID" value="{{$resp->id}}">
                        <div class="card-footer text-right">                          
                            <button type="button" class="btn btn-warning btn-fill pull-right" onclick="f_grabar()">Grabar</button>                                        
                        </div>
                @endforeach     
            </form>
        </div>
    </div>
</div>
@endsection
@endauth

<style>

#chk01 {

        display:inline-block;
    }


</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>

<script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar los comentarios?",
            text: "Auditorias de Ventas ",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Grabado!", "Tu gestion fue grabada.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
<script>
      $(document).ready(function() { 

        // Resolucion Final 
        const migtc = "<?php echo $resp->resolucionbecs ?>";
        $('#resol').val(migtc).prop('selected', true);
        // Acciones CIA
        const mitpc = "<?php echo $resp->accionesbecs ?>";
        $('#Acccia').val(mitpc).prop('selected', true);      

        const micalla = "<?php echo $resp->Apelacion ?>";     
        if(micalla==1){           
            $("#chk01").prop("checked", true);
        } else {
            $("#chk01").prop("checked", false);           
        }
      });
</script>