@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form id="formedit" name="formedit" action="{{ route('updest',array('iddest' =>$iddest))}}" method="POST" >  
                {{ csrf_field() }}    
                <div class="form-group">
                <label for="file-0b">Para:</label>
                    <input id="file-0b"  class="form-control" name="para" type="text" value="{{$para}}">         
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">CC:</label>
                    <textarea class="form-control" id="tt01" rows="4" name="cc" style="height: 90px;" >{{$cc}}</textarea>
                </div>
                <label style="color:grey; font-size:14px">LOS DESTINATARIOS EN COPIA DEBEN ESTAR ENTRE COMILLAS SIMPLES Y SEPARADOS POR COMA:
                <br><span style="color:   #a8dcd7  ">   'pruebas@unificados.cl' , 'ejemplos@unificados.cl'  </span></label>
                <div class="card-footer text-right">              
                    <button type="button" class="btn btn-warning btn-fill pull-right" onclick="f_grabar()">Actualizar</button>                                        
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
<!-- Funcion Grabar  -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Actualizar los destinatarios?",
            text: "Correos de Alertas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Actualizado!", "destinatarios Actualizados.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
