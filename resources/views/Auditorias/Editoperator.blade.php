@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('Grabeditop') }}">  
                {{ csrf_field() }} 
                <div class="row">
                    @foreach($operador as $eje)
                        <div class="col-sm-12" id="Camp"> 
                            <div class="row">
                                <div class="col-sm-6">
                                @if($lsnoedit == 1) 
                                    <input placeholder="Ingrese Nombre del Ejecutivo" id="name" type="text" class="form-control" name="name" value=" {{$eje->name}}" readonly="readonly">
                                @else 
                                    <input placeholder="Ingrese Nombre del Ejecutivo" id="name" type="text" class="form-control" name="name" value=" {{$eje->name}}" required autocomplete="name" autofocus> 
                                @endif
                                </div>
                                <input type="hidden" value="{{$eje->id}}" id="idop" name="idop">                                
                                <div>
                                  <input id ="check01" name ="check01" class="form-check-input" type="checkbox" value="{{$eje->stat}}"> <label for="check01" id="label01"></label>                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 ">        
                                    @if($lsnoedit == 1)                                    
                                        <input class="form-control" type="text" value=" {{$eje->namesp}}" id="sponsorname" name="sponsorname" readonly="readonly"> 
                                        <input type="hidden" id="super" name="sponsor">        
                                    @else 
                                        <select id="super" name="sponsor" class="form-control" required>  
                                            <option value="" selected>Seleccione un Sponsor</option>   
                                            <option value="1">BANCO ESTADO</option>
                                            <option value="2">CENCOSUD</option>
                                            <option value="3">ENTEL</option>
                                            <option value="4">WALMART</option>                                                                           
                                        </select>    
                                    @endif                                                                                            
                                </div>                                 
                                <div class="col-sm-6">  
                                        @if($lsnoedit == 1)                                                   
                                            <input class="form-control" type="text" value="" id="canalname" name="canalname" readonly="readonly"> 
                                            <input type="hidden" id="canal" value=" {{$eje->namec}}" name="canal">        
                                        @else 
                                            <select id="canal" name="canal" class="form-control" required> 
                                                <option value=''>Seleccione Canal</option>
                                                <option value="1">DELIVERY</option>
                                                <option value="2">MUNDO CALL</option>
                                                <option value="3">SOEX</option>
                                                <option value="4">CALLMARK</option>                                                                            
                                            </select> 
                                        @endif 
                                                                                       
                                </div>
                            </div>                           
                        </div> 
                    @endforeach
                </div>                  
            </form>
            @if($lsnoedit == 0)   
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-warning btn-fill pull-right" onclick="validar()">Grabar</button>
                </div>                    
            @else
                <div class="alert alert-danger alert-with-icon" data-notify="container" id="cumple">                    
                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                    <span><b> Atencion:  </b> Operador ya cuenta con Registros. <b>No se Pueden Editar los datos </b>.</span>                      
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-warning btn-fill pull-right" onclick="validar()">Grabar</button>
                </div> 
            @endif              
        </div>
    </div>
</div>
@endsection
@endauth
<!-- Grabar  -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar el Operador?",
            text: "Ejecutivos de ventas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Grabado!", "Operador Grabado.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<!-- validar datos  -->
<script>
    function validar(){
        var $spon=$('#super');
        var $camp=$('#name');
        var $cana=$('#canal');    
        var cant = 0;
        const miVar6 = "<?php echo $lsnoedit ?>";
        if(miVar6 == 0) {
        if($spon.val()==0 ||
            $spon.val()==""){   
            swal("Dato Requerido", "Seleccione un Sponsor",'warning');
            cant = cant+1;
        } 
        if($camp.val()==0 ||
            $camp.val()==""){   
            swal("Dato Requerido", "Ingrese Nombre del Ejecutivo",'warning');
            cant = cant+1;
        } 
        if($cana.val()==0 ||
            $cana.val()==""){   
            swal("Dato Requerido", "Seleccione un Canal",'warning');
            cant = cant+1;
        }   
        if(cant <=0) {
            f_grabar();
        }
        } else {
            f_grabar();
        }
    }
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>

<script>   
    $(document).ready(function() {        
        const miVar = "<?php echo $eje->sponsorid ?>";
        const miVar2 = "<?php echo $eje->canalid ?>";
        const miVar3 = "<?php echo $eje->stat ?>";
        const miVar4 = "<?php echo $eje->namec ?>";
        const miVar5 = "<?php echo $eje->namesp ?>";
        const miVar6 = "<?php echo $lsnoedit ?>";       
        if( miVar6 == 1) {
            $('#canalname').val(miVar4);
            $('#sponsorname').val(miVar5);
            $('#canal').val(miVar2);
            $('#super').val(miVar);
        } else {
            $('#canal').val(miVar2).prop('selected', true);
            $('#super').val(miVar).prop('selected', true);   
        }        
        if(miVar3 == 1){           
            $("#check01").prop("checked", true);
            $('#label01').text("INACTIVO");
        } else {
            $("#check01").prop("checked", false);
            $('#label01').text("ACTIVO");
        }       
    });
</script>   


<script language="javascript">

    $(document).ready(function() {

       $('#check01').click(function() {           
            var checkboxvar = document.getElementById('check01');
            var label = $(parent).find('label01');
            if (!checkboxvar.checked) {
                $('#label01').text("ACTIVO");               
            } else {
                $('#label01').text("INACTIVO");              
            }         
       });
    });

</script>


<style>
    #label01 {
        padding-left: 20px;
        margin: 10;
    }

    #check01 { 
        margin: 10;
        padding-top: 40;
        padding-right: 10px;
    }
</style>
