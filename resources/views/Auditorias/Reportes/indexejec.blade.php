@extends('layouts.menu')
@auth
@section('content')

<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('ejecut') }}">  
                {{ csrf_field() }} 
                <div class="row">
                    <div class="col-sm-12" id="Camp">  <!-- Sponsor / Campaña -->
                        <div class="row">
                            <div class="col-sm-3">                               
                                <select id="super" name="sponsor" class="form-control">     
                                    <option value="" selected>Seleccione un Sponsor</option>   
                                    @foreach($sponsor as $select)
                                        <option value="{{ $select->id }}">{{ $select->name }}</option>
                                    @endforeach
                                </select> 
                                <input type="hidden" value="" id="hisuper" name="hisuper">                   
                            </div> 
                            <div class="col-sm-3">                               
                                <select id="canal" name="canal" class="form-control">     
                                    <option value="" selected>Seleccione Canal</option>   
                                    @foreach($canal as $select2)
                                        <option value="{{ $select2->id }}">{{ $select2->name }}</option>
                                    @endforeach
                                </select> 
                                <input type="hidden" value="" id="hicanal" name="hicanal">                   
                            </div> 
                            <div class="col-sm-6">                               
                                <select id="cia" name="cia" class="form-control">     
                                    <option value="" selected>Seleccione Campaña</option>   
                                    @foreach($cia as $select3)
                                        <option value="{{ $select3->id }}">{{ $select3->name }}</option>
                                    @endforeach
                                </select> 
                                <input type="hidden" value="" id="hicia" name="hicia">                   
                            </div> 

                        </div> 
                        <div class="row">                          
                            <div class="col-sm-6">                               
                                <select id="oper" name="oper" class="form-control">     
                                    <option value="" selected>Seleccione Operador</option>   
                                    @foreach($teleop as $select4)
                                        <option value="{{ $select4->id }}">{{ $select4->name }}</option>
                                    @endforeach
                                </select> 
                                <input type="hidden" value="" id="hioper" name="hioper">                   
                            </div>                                               
                            <div class="col-sm-6">                               
                                <select id="ejecut" name="ejecut" class="form-control">     
                                    <option value="" selected>Seleccione Auditor</option>   
                                    @foreach($usuarios as $select5)
                                        <option value="{{ $select5->id }}">{{ $select5->name }}</option>
                                    @endforeach
                                </select> 
                                <input type="hidden" value="" id="hiejec" name="hiejec">                   
                            </div>                                                                                   
                        </div> 
                        <div class="row">                          
                            <div class="col-sm-6">                               
                                <select id="anio" name="anio" class="form-control">     
                                    <option value="" selected>Seleccione Año</option>                               
                                        <option value=2021>2021</option>
                                        <option value=2022>2022</option>
                                        <option value=2023>2023</option>                                
                                </select> 
                                <input type="hidden" value="" id="hianio" name="hianio">                   
                            </div>                                               
                            <div class="col-sm-6">                               
                                <select id="mes" name="mes" class="form-control">     
                                    <option value="" selected>Seleccione Mes</option>   
                                    <option value=1>ENERO</option>
                                    <option value=2>FEBRERO</option> 
                                    <option value=3>MARZO</option>
                                    <option value=4>ABRIL</option>
                                    <option value=5>MAYO</option> 
                                    <option value=6>JUNIO</option>
                                    <option value=7>JULIO</option> 
                                    <option value=8>AGOSTO</option>
                                    <option value=9>SEPTIEMBRE</option>
                                    <option value=10>OCTUBRE</option> 
                                    <option value=11>NOVIEMBRE</option>
                                    <option value=12>DICIEMBRE</option>   
                                </select> 
                                <input type="hidden" value="" id="himes" name="himes">                   
                            </div>                                                                                   
                        </div> 
                    </div> 
                </div>
            </form>   
            <hr>  
            <div class="card-footer text-right">                
                <button type="submit" class="btn btn-info btn-fill pull-right" onclick="f_generar()">Enviar</button>                                        
            </div>           
        </div>
    </div>
</div>
@endsection
@endauth

<script>
    function f_generar() {  
        swal({
            title: "Desea Generar el reporte?",
            text: "Reportes de Auditoria",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Generar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {              
              document.formedit.submit() 
            } 
        });
    }
</script>