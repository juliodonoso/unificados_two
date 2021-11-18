@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('upcia') }}">  
                {{ csrf_field() }} 
                <div class="row">
                        <div class="col-sm-12" id="Camp">                       
                            <div class="row">
                            <div class="col-sm-6">
                                    <input placeholder="Ingrese Nombre de la Campaña" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                                <div class="col-sm-6">                               
                                    <select id="super" name="sponsor" class="form-control" required>     
                                        <option value="" selected>Seleccione un Sponsor</option>   
                                        @foreach($sponsor as $select)
                                            <option value="{{ $select->id }}">{{ $select->name }}</option>
                                        @endforeach
                                    </select>                                                   
                                </div>                                   
                            </div>                           
                        </div> 
                    </div>                  
            </form>
            <div class="card-footer text-right">             
                <button type="button" class="btn btn-warning btn-fill pull-right" onclick="validar()">Grabar</button>                                        
            </div>
        </div>
    </div>
</div>
@endsection
@endauth


<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar la Campaña?",
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
<script>
    function validar(){
        var $spon=$('#super');
        var $camp=$('#cia');    
        var cant = 0;
        if($spon.val()==0 ||
            $spon.val()==""){   
            swal("Dato Requerido", "Seleccione un Sponsor",'warning');
            cant = cant+1;
        } 
        if($camp.val()==0 ||
            $camp.val()==""){   
            swal("Dato Requerido", "Ingrese la Campaña",'warning');
            cant = cant+1;
        }       
        if(cant <=0) {
            f_grabar();
        }
    }
</script>