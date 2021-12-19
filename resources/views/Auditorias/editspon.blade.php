@extends('layouts.menu')
@auth
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="col-md-12">            
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-left icon-warning">                                   
                            <p class="card-category">Periodo Activo</p>
                            <h4 class="card-title"> {{ $spon->mes }}  /  {{ $spon->anio }}</h4>                                 
                        </div>                               
                    </div>
                    <div class="col-2">
                        <div class="icon-big text-left icon-warning">                                  
                            <i class="fa fa-arrow-right" style="color: #e7e7e7 ;"></i>
                        </div>                               
                    </div>
                    <div class="col-5">                           
                        <div class="numbers">
                            <p class="card-category">Proximo Periodo a Aperturar:</p>
                            <h4 class="card-title"> {{ $mesopen }}  /  {{ $aniopen }}</h4>
                        </div>
                    </div>                           
                </div>
                <form method="get" action="{{ route('editarsponsor',array('lid' =>$spon->id,'lstatus'=>$spon->is_act)) }}" name="formedit"> 
                    @csrf      
                    <div class="row">                                                              
                        <div class="form-check">
                            <label class="form-check-label">
                                <input id="chk01" name="chk01"class="form-check-input" type="checkbox" value ="{{$spon->sponame}}">
                                <span class="form-check-sign"></span>
                                ACTIVO
                            </label>
                        </div>  
                    </div> 
                </form>
                <hr>              
            </div>                              
            <div class="card-footer ">
            <br>                       
                <div class="col-2 float-right">                               
                    <button class="btn btn-danger btn-wd" onclick='f_grabarP();'>Procesar</button>
                </div>
            </div>                    
        </div>              
    </div> 
@endsection
@endauth
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {        
        const miact = "<?php echo $spon->is_act ?>";    
        if(miact==1){           
            $("#chk01").prop("checked", true);
        } else {
            $("#chk01").prop("checked", false);
        }     
    });
</script>
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>


<!-- Status de Sponsor  -->
<script type="text/javascript">
    $(document).ready(function() {          
        const misp = "<?php echo $lksponsor ?>";
        const miid = "<?php echo $spon->id ?>";
        $('#chk01').on('change',function(){               
            if (this.checked) {  
                var msje = "ACTIVAR";
                var lstatus = 1;
            } else {
                var msje = "DESACTIVAR";
                var lstatus = 0;
            }    
            swal({                  
                title: msje+" "+misp+ "?",
                text: "STATUS DE SPONSOR",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, "+msje+" !",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {                   
                    $.ajax({
                        url: "{{route('statusp')}}",
                        type: "post",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            lid : miid,
                            lstatus : lstatus,
                        },                     
                        success: function (response) {
                            console.log(response)
                        }
                    }); 
                    swal("¡Hecho!",misp+" ha cambiado de estatus","success");
                } else {
                    swal("Cancelado", "No se Cargaron los Datos", "error");
                }
            });         
        });
    });
</script>


<!-- Funcion Procesar el cambio de Periodo  -->
<script>
    function f_grabarP() {  
        const misp = "<?php echo $lksponsor ?>";
        const miid = "<?php echo $spon->id ?>";
        const lmes = "<?php echo $mesopen ?>";
        const lanio = "<?php echo $aniopen ?>";
        swal({
            title: "Estas Seguro de Cambiar el Periodo Activo de "+misp+"?",
            text: "Cierre de Periodo",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Procesar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {   
                $.ajax({
                        url: "{{route('changep')}}",
                        type: "post",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            lid : miid,
                            lmes : lmes,
                            lanio : lanio,
                        },                     
                        success: function (response) {
                            // console.log(response)  
                          
                                                  
                        
                        }
                    });           
              swal("Actualizado!", "Tu Registro se Actualizo.", "success");            
            window.location.reload();
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>


