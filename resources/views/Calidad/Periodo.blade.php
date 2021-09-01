@extends('layouts.menu')
@auth
@section('content')
<div class="container">
    <div class="container-fluid">       
        <div class="col-md-14">
            @if($pCount == 0)  
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-left icon-warning">
                                    <i class="nc-icon nc-time-alarm text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7">                           
                                <div class="numbers">
                                    <p class="card-category">Periodo Activo</p>
                                    <h4 class="card-title"> {{ $perid->mes }}  /  {{ $perid->anio }}</h4>
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-unlock-alt"></i> Periodo Abierto
                        </div>
                        <div class="col-2 float-right">                               
                            <button class="btn btn-danger btn-wd" onclick='f_grabarP();'>Cerrar</button>
                        </div>
                    </div>
                </div>
                <div class="container">    
            @else 
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-left icon-warning">
                                    <i class="fa fa-lock text-warning"></i>                                   
                                </div>
                                <div class="stats">
                                     Ultimo Periodo Gestionado:  <h5>{{$ult->mes}} / {{$ult->anio}}</h5>
                                     </div>
                            </div>                                                      
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-lock"></i> No Hay Periodos abiertos
                        </div>
                        <div class="col-2 float-right">                          
                            <button class="btn btn-info btn-wd" onclick='f_abrirP();'>Abrir</button>
                        </div>
                    </div>
                </div>
            @endif                
        </div>    
    </div>   
</div>
@endsection
@endauth
@if($pCount == 0)  
<script>    
    function f_grabarP(id) {  
        swal({
            title: "Estas Seguro?",
            text: "Una vez cerrado el Periodo No podras Abrirlo Nuevamente!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Cerrar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = "{{ URL::route('pclose',$perid->id) }}";
                swal("Cerrado!", "El Periodo ha sido Cerrado.", "success");
            } else {
                swal("Cancelado", "Periodo Activo", "error");
            }
        });
    }
</script>
@else
<script>
    function f_abrirP() {  
        swal({
            title: "Estas Seguro de Abrir el periodo?",
            text: "al aperturar el periodo se podran generar gestiones y cargas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Abrir!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = "{{ URL::route('popen') }}";
                swal("Abriendo Periodo!", "El Periodo ha sido Abierto.", "success");
            } else {
                swal("Cancelado", "No hay periodos activos", "error");
            }
        });
    }
</script>
@endif
