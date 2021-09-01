@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="gen01" name="gen01" action="{{ route('gendiario')}}"> 
                {{ csrf_field() }} 
                @if(isset($lsnro) >0)
                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                        <span data-notify="message">No existen Registros que Exportar.</span>
                    </div>
                @endif
                <div class="row"> 
                    <div class="col-md-4">
                        <h5 class="title">Desde</h5>
                        <div class="form-group">
                            <input type="text" id="datetimepicker" name="dated" class="form-control datepicker" placeholder="Seleccione Fecha" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="title">Hasta</h5>
                        <div class="form-group">
                            <input type="text" id="datetimepicker" name="dateh" class="form-control datepicker" placeholder="Seleccione Fecha" />
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Gestion</label>
                        <select class="form-control" id="sel01" name="gestion" required>
                            <option value="" selected disabled>Seleccione Gestion</option>                            
                            <option value=5>BUENA VENTA</option>
                            <option value=6>VOLVER A LLAMAR</option> 
                            <option value=7>NO CONTACTADO</option> 
                            <option value=8>RECHAZA CONTRATACION</option> 
                            <option value=9>RENUNCIA</option> 
                            <option value=0>SIN GESTION</option>                                                                           
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Clinica</label>
                        <select class="form-control" id="sel02" name="clin">
                            <option value="" selected disabled>Seleccione clinica</option> 
                            <option value="RED SALUD">RED SALUD</option>
                            <option value="DAVILA">DAVILA</option> 
                            <option value="STA MARIA">SANTA MARIA</option>
                            <option value="INDISA">INDISA</option>
                            <option value="CONCEPCION">CONCEPCION</option> 
                        </select>   
                    </div> 
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Tipo</label>
                        <select class="form-control" id="sel03" name="tipo" required>
                            <option value="TODOS" selected disabled>Seleccione Tipo</option> 
                            <option value="PAC">PAC</option>
                            <option value="PAT">PAT</option>                          
                        </select>   
                    </div> 
                </div> 
                <div class="card-footer ">               
                    <button type="submit" class="btn btn-warning btn-wd btn-finish pull-right">Generar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Init Sliders
        demo.initSliders();
    });
</script>

<script>

$( "#datetimepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});


</script>


