@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
<form method="POST" action="{{ route('excelconcep') }}"> 
          {{ csrf_field() }}  
               
    <div class="card ">                                
        <div class="card-body ">  
        <div class="card-body">         
        <!-- <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center" id="divsel">
            <p class="card-category">Seleccione las opciones para generar Reporte</p>						
            <input  class="btn btn-info" name="BtnSeleccionar" id="BtnSeleccionar" Value="Deselect" />       
          </div>         
        </div> -->
            </div> 
            <div class="row">                   
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Mes</label>                    
                        <select multiple data-title="Seleccione los Meses"  id="mes"  name="mes[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
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
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-mes" name="chk-mes">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">AÑO</label>
                        <!-- <select class="form-control" id="anio" name="anio" disabled> -->
                        <select multiple data-title="Seleccione los Años"  id="anio"  name="anio[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=2018>2018</option>
                            <option value=2019>2019 </option> 
                            <option value=2020>2020</option>
                            <option value=2021>2021</option>
                            <option value=2022>2022</option> 
                            <option value=2023>2023</option>
                            <option value=2024>2024</option>
                            <option value=2025>2025</option>                                                                                                     
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-anio" name="chk-anio">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="row">                   
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Clinica</label>
                        <!-- <select class="form-control" id="clin" name="clin" disabled> -->
                        <select multiple data-title="Seleccione las Clinicas"  id="clin"  name="clin[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                        
                            <option value="RED SALUD">RED SALUD</option>
                            <option value="DAVILA">DAVILA</option> 
                            <option value="SANTA MARIA">SANTA MARIA</option>
                            <option value="INDISA">INDISA</option>
                            <option value="CONCEPCION">CONCEPCION</option>                                                                                                         
                        </select>                        
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-clin" name="chk-clin">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">PLAN</label>
                        <!-- <select class="form-control" id="plan" name="plan" disabled> -->
                        <select multiple data-title="Seleccione los Planes"  id="plan"  name="plan[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=1>1</option>
                            <option value=2>2</option> 
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option> 
                            <option value=6>6</option>                                                                                                     
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-plan" name="chk-plan">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                   
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Gestion de auditoria</label>                      
                        <select multiple data-title="Seleccione las Gestiones"  id="gt"  name="gt[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=1>INGRESADA</option>
                            <option value=2>DEVUELTA</option> 
                            <option value=3>INGRESADA EN CIERRE</option>  
                            <option value=0>SIN GESTION</option>                                                                     
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-gt" name="chk-gt">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Tipificacion</label>
                        <!-- <select class="form-control" id="tp" name="tp" disabled> -->
                        <select multiple data-title="Seleccione las Tipificaciones" name="tp[]" id="tp" class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue" >
                            <option value=1>DUPLICIDAD</option>
                            <option value=2>RUT</option>                                                  
                            <option value=3>INCONSISTENCIA EN EL MANDATO</option> 
                            <option value=7>OTROS</option>                                                                          
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-tp" name="chk-tp">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Sub-Tipificacion</label>
                        <!-- <select class="form-control" id="stp" name="stp" disabled> -->
                        <select multiple data-title="Seleccione las Sub-Tipificaciones"  id="stp"  name="stp[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=8>AUTORIZADA</option>
                            <option value=9>RECHAZADA </option> 
                            <option value=10>PENDIENTE </option>                                       
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-stp" name="chk-stp">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                   
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Gestion de Llamada</label>
                        <!-- <select class="form-control" id="gtc" name="gtc" disabled> -->
                        <select multiple data-title="Seleccione las Gestiones de llamada"  id="gtc"  name="gtc[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=5>BUENA VENTA</option>
                            <option value=6>VOLVER A LLAMAR</option> 
                            <option value=7>NO CONTACTADO</option> 
                            <option value=8>RECHAZA CONTRATACION</option> 
                            <option value=9>RENUNCIA</option> 
                            <option value=0>SIN GESTION</option>                                                                                                     
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-gtc" name="chk-gtc">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Tipificacion de llamada</label>
                        <!-- <select class="form-control" id="tpc" name="tpc" disabled> -->
                        <select multiple data-title="Seleccione las Tipificaciones de llamada"  id="tpc"  name="tpc[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=4>APAGADO</option>  
                            <option value=5>WHATSAPP</option>                        
                            <option value=6>RESPUESTA NEGATIVA EN LLAMADA</option>
                            <option value=7>OTROS</option>                                                                             
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-tpc" name="chk-tpc">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="row">                   
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Banco</label>
                        <!-- <select class="form-control" id="bk" name="bk" disabled> -->
                        <select multiple data-title="Seleccione los Bancos"  id="bk"  name="bk[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=1>CHILE / CREDICHILE / EDWARS</option>
                            <option value=504>BBVA</option> 
                            <option value=16>BCI/TBANC/NOVA</option>
                            <option value=28>BICE</option>
                            <option value=27>CORPBANCA / CONDELL</option>
                            <option value=12>BANCO ESTADO</option>
                            <option value=51>FALABELLA</option>
                            <option value=39>ITAU</option> 
                            <option value=37>SANTANDER / BANEFE</option>
                            <option value=14>SCOTIABANK</option>
                            <option value=49>SECURITY /CONSORCIO / COOPEUCH</option>                                                                                                        
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-bk" name="chk-bk">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">TIPO DE MANDATO</label>
                        <select  id="man" name="man" class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=1>PAC</option>
                            <option value=2>PAT</option>                                                                                                       
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"  id="chk-man" name="chk-man">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                   
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Supervisor</label>
                        <!-- <select class="form-control" id="stp" name="stp" disabled> -->
                        <select multiple data-title="Seleccione los Supervisores"  id="super"  name="super[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value="C1">CONCEPCION-1 (C1)</option>
                            <option value="D1">DAVILA-1 (D1)</option> 
                            <option value="D2">DAVILA-2 (D2)</option> 
                            <option value="D3">DAVILA-3 (D3)</option> 
                            <option value="IND1">INDISA-1 (IND1)</option> 
                            <option value="IND2">INDISA-2 (IND2)</option> 
                            <option value="IND3">INDISA-3 (IND3)</option>
                            <option value="IND4">INDISA-4 (IND4)</option> 
                            <option value="IND5">INDISA-5 (IND5)</option> 
                            <option value="RED1">RED SALUD-1 (RED1)</option> 
                            <option value="RED2">RED SALUD-2 (RED2)</option> 
                            <option value="RED3">RED SALUD-3 (RED3)</option>
                            <option value="S1">SANTA MARIA-1 (S1)</option> 
                            <option value="S2">SANTA MARIA-2 (S2)</option> 
                            <option value="S3">SANTA MARIA-3 (S3)</option>
                            <option value="S4">SANTA MARIA-4 (S4)</option> 
                            <option value="S5">SANTA MARIA-5 (S5)</option>                                                                                                   
                        </select>                        
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-super" name="chk-super">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleFormControlSelect1">Ejecutivo</label>
                        <!-- <select class="form-control" id="eje" name="eje" disabled> -->
                        <select multiple data-title="Seleccione los ejecutivos"  id="eje"  name="eje[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                            <option value=1>EJECUTIVO 1</option>
                            <option value=2>EJECUTIVO 2</option>
                            <option value=2>EJECUTIVO 3</option>
                            <option value=2>EJECUTIVO 4</option> 
                            <option value=2>......</option>                                                                                                      
                        </select>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="chk-eje" name="chk-eje">
                                    <span class="form-check-sign"></span>
                                    Seleccionar para reporte
                                </label>
                            </div>
                        </div>
                    </div>
                   
                    </form>
                </div>
            
            <div class="card-footer ">
                <hr>
               

                <div class="stats">                   
                <button type="submit" class="btn btn-fill btn-warning">Generar</button>
                    <!-- <a href="" class="btn btn-warning" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Generar Reporte</a>   -->
                </div>
            </div>           
        </div>
    </div>
</div>
@endsection
@endauth

<style>
 #BtnSeleccionar { 
          /* border: none;   */
          /* padding: 2px 2px;   */
          cursor: pointer; 
      }

     #divsel {
         border : none;
     } 

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  
    $(document).ready(function() {
        selected = true;
        $('#BtnSeleccionar').click(function() {             
            if (selected) {
                $('input[type=checkbox]').prop("checked", true);        
                $('#BtnSeleccionar').val('Deselect');                   
            } else {
                $('input[type=checkbox]').prop("checked", false);
                $('#BtnSeleccionar').val('Select');           
            }
            selected = !selected;
        });
    });

  

    
</script>

<script>
// Mes
$(document).ready(function() {
    $('#chk-mes').click(function(){
    if (this.checked) {
        document.getElementById('mes').disabled = false;          
    }else         
        document.getElementById('mes').disabled = true;
    });
});
// Anio
$(document).ready(function() {
    $('#chk-anio').click(function(){
    if (this.checked) {
        document.getElementById('anio').disabled = false;          
    }else         
        document.getElementById('anio').disabled = true;
    });
});
// Clinica
$(document).ready(function() {
    $('#chk-clin').click(function(){
    if (this.checked) {
        document.getElementById('clin').disabled = false;          
    }else         
        document.getElementById('clin').disabled = true;
    });
});
// Plan 
$(document).ready(function() {
    $('#chk-plan').click(function(){
    if (this.checked) {
        document.getElementById('plan').disabled = false;          
    }else         
        document.getElementById('plan').disabled = true;
    });
});
// Gestion
$(document).ready(function() {
    $('#chk-gt').click(function(){
    if (this.checked) {
        $("#gt").addClass('enable');
      
    }else         
    $("#gt").multiselect("disabled");
    });
});
// Tipificacion
$(document).ready(function() {
    $('#chk-tp').click(function(){
    if (this.checked) {
        document.getElementById('tp').disabled = false;          
    }else         
        document.getElementById('tp').disabled = true;
    });
});
// sub-Tipificacion
$(document).ready(function() {
    $('#chk-stp').click(function(){
    if (this.checked) {
        document.getElementById('stp').disabled = false;          
    }else         
        document.getElementById('stp').disabled = true;
    });
});
// Gestion llamadas
$(document).ready(function() {
    $('#chk-gtc').click(function(){
    if (this.checked) {
        document.getElementById('gtc').disabled = false;          
    }else         
        document.getElementById('gtc').disabled = true;
    });
});
// Tipificacion llamadas
$(document).ready(function() {
    $('#chk-tpc').click(function(){
    if (this.checked) {
        document.getElementById('tpc').disabled = false;          
    }else         
        document.getElementById('tpc').disabled = true;
    });
});


// Banco 
$(document).ready(function() {
    $('#chk-mes').click(function(){
    if (this.checked) {
        document.getElementById('bk').disabled = false;          
    }else         
        document.getElementById('bk').disabled = true;
    });
});
// Mandato 
$(document).ready(function() {
    $('#chk-man').click(function(){
    if (this.checked) {
        document.getElementById('man').disabled = false;          
    }else         
        document.getElementById('man').disabled = true;
    });
});
// Supervisor 
$(document).ready(function() {
    $('#chk-sup').click(function(){
    if (this.checked) {
        document.getElementById('sup').disabled = false;          
    }else         
        document.getElementById('sup').disabled = true;
    });
});
// ejecutivo
$(document).ready(function() {
    $('#chk-eje').click(function(){
    if (this.checked) {
        document.getElementById('eje').disabled = false;          
    }else         
        document.getElementById('eje').disabled = true;
    });
});




</script>


