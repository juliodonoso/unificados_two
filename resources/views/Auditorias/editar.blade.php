@extends('layouts.menu')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@auth
@section('content')                                 
    <div class="col-md-12">
        <div class="card ">
            <form method="POST" action="{{ route('upeditaudit',array('lid' =>$lid)) }}" name="formedit" enctype="multipart/form-data">  
                @csrf          
                <div class="card-body ">   
                    @foreach($edicion as $edit)                                                           
                        <!-- Datos de la campaña-->
                            <div class="row">
                                <div class="col-sm-12" id="Camp">  <!-- Sponsor / Campaña -->
                                    <div class="row">
                                        <div class="col-sm-6">                               
                                            <select id="super" name="sponsor" class="form-control" required>     
                                                <option value="" selected disabled >Seleccione un Sponsor</option>   
                                                @foreach($sponsor as $select)
                                                    <option value="{{ $select->id }}">{{ $select->name }}</option>
                                                @endforeach
                                            </select> 
                                            <input type="hidden" value="" id="hisuper" name="hisuper">                   
                                        </div>    
                                        <div class="col-sm-6">                                 
                                            <select data-old="" id="cia" name="cia" class="form-control" required>Seleccione Campaña       
                                                <option value='' selected disabled>Seleccione Campaña</option>    
                                                @foreach($campanias as $select2)
                                                    <option value="{{ $select2->id }}">{{ $select2->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="" id="hicia" name="hicia">                  
                                        </div> 
                                    </div> 
                                </div> 
                            </div>               
                            <div class="row">                
                                <div class="col-sm-12" id="Oper">
                                    <div class="row">                     
                                        <div class="col-sm-6">                                
                                            <select data-old="" id="canal" name="canal" class="form-control" required>Seleccione Canal       
                                                <option value='' selected disabled>Seleccione Canal</option>
                                                @foreach($canal as $select3)
                                                    <option value="{{ $select3->id }}" id="canalop">{{ $select3->name }}</option>                                        
                                                @endforeach
                                            </select> 
                                            <input type="hidden" value="" id="hicanal" name="hicanal">               
                                        </div>
                                        <div class="col-sm-6">                              
                                            <select id="telop" data-old="" name="telop" class="form-control" required>
                                                <option value='' selected disabled>Seleccione Operador</option>
                                                @foreach($teleop as $select4)
                                                    <option value="{{ $select4->id }}" id="canalop">{{ $select4->name }}</option>                                        
                                                @endforeach
                                            </select>       
                                            <input type="hidden" value="" id="hioper" name="hioper">               
                                        </div>                                            
                                    </div>                    
                                </div> 
                            </div> 
                        <!-- fechas                     -->
                            <div class="row">
                                <div class="col-sm-12" id="fechas">               
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="title">fecha Venta</label>
                                            <div class="form-group">
                                                <input type='date' class="form-control datepicker" placeholder="Date Picker Here" name="fventa" id="fventa"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="title">fecha Asignacion</label>
                                            <div class="form-group">
                                                <input type='date'  class="form-control datepicker" placeholder="Date Picker Here" name="fasig" id="fasig" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="title">fecha Auditoria</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" value= {{$date}} name="faudit"  disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Datos personales  -->
                            <div class="row">
                                <div class="col-sm-12" id="datosp"> 
                                    <div class="row">                                           
                                        <div class="col-sm-2">
                                            <div class="form-group has-label">
                                                <label>
                                                    Rut Cliente                                            
                                                </label>
                                                <input id="rutcar" name ="rutcar" class="form-control" value ="{{$edit->rutcli}}"/>                                                            
                                            </div>
                                        </div>   
                                        <div class="col-sm-1">
                                            <div class="form-group has-label">
                                                <label>
                                                    Dv-Rut                                             
                                                </label>
                                                <input id="dvcar" name ="dvcar" class="form-control" value ="{{$edit->dvcli}}" />                                                            
                                            </div>
                                        </div> 
                                    </div>                           
                                </div> 
                            </div>
                        <!-- id Grabacion   -->                
                            <div class="row">
                                <div class="col-sm-12" id="idgrab"> 
                                    <div class="row">                                           
                                        <div class="col-sm-12">
                                            <div class="form-group has-label">
                                                <label>
                                                    Id Grabacion                                           
                                                </label>
                                                <input id="idgr" name ="idgrab" class="form-control" required  style="text-transform:uppercase" value ="{{$edit->idGrab}}"/>                                                            
                                            </div>
                                        </div>                                                                                                                                                                      
                                    </div>
                                </div>   
                            </div>              
                    
                        <!-- Cargar Grabacion de alerta  -->
                        @if($edit->Estado == "ALERTA")
                            <div id="cargagrab">               
                                <label for="file-0b">Grabacion de Alerta : @if($edit->grabacion !=="") {{$edit->grabacion}} @endif</label>
                                <input id="file-0b"  class="form-control" name="file-0b" type="file" enctype="multipart/form-data" accept="audio/*" required>
                                <br>                     
                            </div> 
                        @endif  
                        <!-- Observaciones  -->
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observaciones</label>
                                <textarea class="form-control" id="tt01" rows="4" name="observ" style="text-transform:uppercase; height: 90px;" >{{$edit->observ}}</textarea>
                            </div>   
                    @endforeach    
                </div> 
                <input type="hidden" name="estado" id="estado" value="CUMPLE">        
                <div class="card-footer text-right">              
                    <button type="button" class="btn btn-warning btn-fill pull-right" onclick="f_validar()">Actualizar</button>                                        
                </div>
            </form>          
        </div>
    </div>                  
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js')}}"></script>
<!-- Llenar los combos con los datos de la tabala  -->
<script>
      $(document).ready(function() {        
        const migtc = "<?php echo $edit->sponsor ?>";
        $('#super').val(migtc).prop('selected', true);
        
        const mitpc = "<?php echo $edit->idcia ?>";
        $('#cia').val(mitpc).prop('selected', true);

        const mitpx = "<?php echo $edit->idcanal?>";
        $('#canal').val(mitpx).prop('selected', true);  

        const miop = "<?php echo $edit->idoper?>";
        $('#telop').val(miop).prop('selected', true);  

        const mifvta= "<?php echo $edit->Fvta?>";
        $("#fventa").val(mifvta);    

        const mifgrab= "<?php echo $edit->Fgrab?>";
        $("#fasig").val(mifgrab);        
      });
</script>
<!-- Funcion Validar  -->
<script>
    function f_validar(){
        var $spon=$('#super');
        var $camp=$('#cia').val();      
        var $cana=$('#canal');
        var $oper=$('#telop');      
        var $grabid=$('#idgr');
        var cant = 0;
        if($grabid.val() == ""){
            swal("Dato Requerido", "Ingrese ID de Grabacion",'warning');
            cant = cant+1;
        }      
      
        if($spon.val()==0 ||
            $spon.val()==""){   
            swal("Dato Requerido", "Seleccione un Sponsor",'warning');
            cant = cant+1;
        } 
        if($camp == null){   
            swal("Dato Requerido", "Seleccione una Campaña",'warning');
            cant = cant+1;
        } 
        if($cana.val()==0 ||
            $cana.val()==""){   
            swal("Dato Requerido", "Seleccione un Canal",'warning');
            cant = cant+1;
        } 
        if($oper.val()==0 ||
            $oper.val()==""){   
            swal("Dato Requerido", "Seleccione un Operador",'warning');
            cant = cant+1;
        } 
        if(cant <=0) {
            f_grabar();
        }
    }
</script>
<!-- Funcion Grabar  -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Actualizar la Auditoria?",
            text: "Evaluacion de Ventas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Actualizado!", "Tu Registro se Actualizo.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<script>
    $('#super').on('change', function() {
        var ls = '';
        ls = $('#super option:selected').text();
        $('#hisuper').val(ls);   
    });
    $('#cia').on('change', function() {
        var lc = '';
        lc = $('#cia option:selected').text();
        $('#hicia').val(lc);   
    });
    $('#telop').on('change', function() {
        var li = '';
        li = $('#telop option:selected').text();
        $('#hioper').val(li);   
    });
    $('#canal').on('change', function() {
        var li = '';
        li = $('#canal option:selected').text();
        $('#hicanal').val(li);   
    });
</script>
@endsection
@endauth