@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('Grabeditcia') }}">  
                {{ csrf_field() }} 
                <div class="row">
                    @foreach($operador as $eje)
                        <div class="col-sm-12" id="Camp">                          
                            <div class="row">
                            <div class="col-sm-6">
                                    <input placeholder="Ingrese Nombre de la Campaña" id="name" type="text" class="form-control" name="name" value=" {{$eje->name}}" required autocomplete="name" autofocus>
                                </div>
                                <input type="hidden" value="{{$eje->id}}" id="idop" name="idop"> 
                                <div class="col-sm-6">                               
                                    <select id="super" name="sponsor" class="form-control" required>     
                                        <option value="" selected>Seleccione un Sponsor</option>   
                                        <option value="1">BANCO ESTADO</option>
                                        <option value="2">CENCOSUD</option>
                                        <option value="3">ENTEL</option>
                                        <option value="4">WALMART</option>                                                                           
                                    </select>                                                   
                                </div>                                
                              
                            </div>                           
                        </div> 
                    @endforeach
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
            title: "Estas Seguro de Modificar la Campaña?",
            text: "Modificaras los historicos Grabados con este Nombre de Campaña",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Grabado!", "Campaña Modificada.", "success");
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
        var $camp=$('#name');       
        var cant = 0;
        if($spon.val()==0 ||
            $spon.val()==""){   
            swal("Dato Requerido", "Seleccione un Sponsor",'warning');
            cant = cant+1;
        } 
        if($camp.val()==0 ||
            $camp.val()==""){   
            swal("Dato Requerido", "Ingrese Nombre de Campaña",'warning');
            cant = cant+1;
        } 
        
        if(cant <=0) {
            f_grabar();
        }
    }
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
<script>   
    $(document).ready(function() {        
        const miVar = "<?php echo $eje->sponsorid ?>";
        const miVar2 = "<?php echo $eje->canalid ?>";
        $('#super').val(miVar).prop('selected', true);      
        $('#canal').val(miVar2).prop('selected', true);      
    });
</script>   
