@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('editupdate',array('Nrocar' =>$Nrocar,'ldid' =>$ldid)) }}">  
                {{ csrf_field() }} 
                @foreach($propedit as $resp)
                    <!-- Datos Personales 1 -->
                    <div class="row">
                        <div class="col-sm-12" id="datosp">
                            <div class="row">                                                   
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Rut                                             
                                        </label>
                                        <input id="rutcar" name ="rutcar" class="form-control"  value="{{$resp->rutcar}}"/>                                                            
                                    </div>
                                </div>   
                                <div class="col-md-1">
                                    <div class="form-group has-label">
                                        <label>
                                            DvRut                                             
                                        </label>
                                        <input id="dvcar" name ="dvcar" class="form-control"  value="{{$resp->dvcar}}"/>                                                            
                                    </div>
                                </div>                                                
                                <div class="col-md-3">
                                    <div class="form-group has-label">
                                        <label>
                                            Nombres                                                    
                                        </label>
                                        <input id="nom" name ="nom" class="form-control"  value="{{$resp->nom}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group has-label">
                                        <label>
                                            Apellido Paterno                                                     
                                        </label>
                                        <input id="pat"name ="pat" class="form-control"  value="{{$resp->pat}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group has-label">
                                        <label>
                                            Apellido Materno                                                     
                                        </label>
                                        <input id="mat" name ="mat" name="Pruebaxxxxx" class="form-control"  value="{{$resp->mat}}" />                                                            
                                    </div>
                                </div>                                                                                                     
                            </div>
                        </div>  
                    </div> 
                    <!-- Datos de contacto --> 
                    <div class="row">
                        <div class="col-sm-12" id="datosc">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-label">
                                        <label>
                                            Email                                                    
                                        </label>
                                        <input id="email" name="email" class="form-control"  value="{{$resp->email}}"/>                                                            
                                    </div>
                                </div>                                                
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Telefono                                                    
                                        </label>
                                        <input id="telf" name ="telf" class="form-control"  value="{{$resp->telf}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-2">                                                      
                                    <div class="form-group has-label">
                                        <label>
                                            Fecha Nacimiento                                                     
                                        </label>
                                        <input id="datep" name ="nac" class="form-control" type="text" placeholder="Fecha" value="{{$resp->fnac}}"/>                                                            
                                        <!-- <input id="datetimepicker" name ="nac" type="text" class="form-control datepicker" placeholder="Fecha" value="{{$resp->fnac}}"/>                                                             -->
                                    </div>                                                                                                                                                     
                                </div>    
                                <!-- Select sexo -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Sexo</label>
                                        <select class="form-control" id="sel02" name ="ssexo">
                                            <option value="" disabled>Seleccione Sexo</option>
                                            <option value="F">Femenino</option>
                                            <option value="M">Masculino</option>     
                                        </select>
                                    </div>
                                </div>
                                <!-- select Plan -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Isapre</label>
                                        <select class="form-control" id="sel04"name ="sisapre">
                                            <option value=11>FONASA</option>
                                            <option value=4>CONSALUD</option>     
                                        </select>
                                    </div>
                                </div>                                                                                                                                                      
                                <div class="col-md-1">
                                    <div class="form-group has-label">
                                        <label>
                                            Peso                                                    
                                        </label>
                                        <input id="peso" name ="peso" class="form-control" value="{{$resp->peso}}" />                                                            
                                    </div>
                                </div> 
                            </div>
                        </div>  
                    </div> 
                    <!-- Datos Personales 2 -->
                    <div class="row">
                        <div class="col-sm-12" id="datosp2">
                            <div class="row"> 
                                <div class="col-md-1">
                                    <div class="form-group has-label">
                                        <label>
                                            Estatura                                                    
                                        </label>
                                        <input id="estat" name ="estat" class="form-control" value="{{$resp->estat}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-1">
                                    <div class="form-group has-label">
                                        <label>
                                            IMC                                                     
                                        </label>
                                        <input id="imc" name ="imc" class="form-control" value="{{$resp->imc}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group has-label">
                                        <label>
                                            Direccion                                                     
                                        </label>
                                        <input id="dir" name ="dirt" class="form-control" value="{{$resp->dir}}" />                                                            
                                    </div>
                                </div>                                               
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Comuna                                                     
                                        </label>
                                        <input id="comuna" name ="comuna" class="form-control" value="{{$resp->comunas}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Ciudad                                                     
                                        </label>
                                        <input id="ciudad" name ="ciudad" class="form-control" value="{{$resp->ciudad}}" />                                                            
                                    </div>
                                </div>                                                     
                            </div>  
                        </div>   
                    </div>  
                    <!-- Datos de la contratacion  -->
                    <div class="row">
                        <div class="col-sm-12" id="datospoli">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Clinica                                                     
                                        </label>
                                        <input id="clinica" name ="clinica" class="form-control" value="{{$resp->clinica}}" />                                                            
                                    </div>
                                </div>  
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Poliza                                                     
                                        </label>
                                        <input id="poliza" name ="poliza"class="form-control" value="{{$resp->poliza}}" />                                                            
                                    </div>
                                </div>                                               
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            LLave                                                     
                                        </label>
                                        <input id="llave" name ="llave" class="form-control"  value="{{$resp->llave}}" />                                                            
                                    </div>
                                </div>                                                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Plan</label>
                                        <select class="form-control" id="splan" name ="splan" required>
                                            <option value=1>1</option>
                                            <option value=2>2</option>     
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            UF                                                     
                                        </label>
                                        <input  id="uf" name ="uf" class="form-control"  value="{{$resp->uf}}" />                                                            
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Propuesta                                                     
                                        </label>
                                        <input  id="propuesta" name ="propuesta" class="form-control"  value="{{$resp->propuesta}}" />                                                            
                                    </div>
                                </div>                                                     
                            </div>  
                        </div>   
                    </div> 
                    <!-- Pre- existencias -->
                    <div id="divpre" class="row" >
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-label">
                                        <label>
                                            Pre-existencias                                                     
                                        </label>                                
                                        <input id="obs"  name ="pre" class="form-control" value="{{$resp->obs}}" />                                                                                             
                                    </div>
                                </div>                                                                             
                            </div>  
                        </div>   
                    </div>
                    <!-- Pagador y datos bancarios  -->
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="row">                      
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Banco</label>
                                        <select class="form-control" id="sel03" name="sbanco">
                                            <option value="" disabled>Seleccione Banco</option>
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
                                            <option value=999>PAT</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            N° Cuenta                                                   
                                        </label>                                  
                                        <input id="nrocta" name="nrocta" class="form-control" value="{{$resp->nrocta}}" />                                                                                              
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Rut Pagador                                                   
                                        </label>                                  
                                        <input id="rutter" name="rutter" class="form-control" value="{{$resp->rutter}}" />                                                                                              
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group has-label">
                                        <label>
                                            DvTer                                             
                                        </label>
                                        <input id="dvter" name="dvter" class="form-control" name="dir" value="{{$resp->dvter}}"/>                                                            
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group has-label">
                                        <label>
                                            Pagador                                                    
                                        </label>                                  
                                        <input id="nomter" name="nomter" class="form-control"value="{{$resp->nombreter}}" />                                                                                              
                                    </div>
                                </div>
                            </div>  
                        </div>   
                    </div>
                    <!-- Datos de la venta  -->
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="row">                            
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Deposito                                                     
                                        </label>                                    
                                        <input id="montodep" name="montodep" name ="montodep"class="form-control" value="{{$resp->totaldep}}" />                                                                                               
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Fecha Dep                                                     
                                        </label>                                    
                                        <input id="fechadep" name ="fechadep" class="form-control" value="{{$resp->fechadep}}" />                                                                                               
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Fecha Vta                                                     
                                        </label>                                    
                                        <input id="fechavta" name ="fechavta"class="form-control" value="{{$resp->fechavta}}" />                                                                                               
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Ejecutivo                                                    
                                        </label>                                    
                                        <input id="ejec" name ="ejec" class="form-control" value="{{$resp->ejecutivo}}" />                                                                                               
                                    </div>
                                </div>   
                                <div class="col-md-2">
                                    <div class="form-group has-label">
                                        <label>
                                            Supervisor                                                    
                                        </label>                                    
                                        <input id="super" name ="super" class="form-control" value="{{$resp->supervisor}}" />                                                                                               
                                    </div>
                                </div>                                                                             
                            </div>  
                        </div>   
                    </div>
                    <!-- Cargas  -->
                    <div id="items"> 
                        <div class="row">
                            <div class="col-md-1">  
                                <div class="form-group" id="divb">                                                          
                                    <button  id="add"  type="button" class="btn btn-warning">Agregar Cargas <i class="nc-icon nc-single-02"></i></button>                                                 
                                </div>
                            </div>
                        </div>                
                        <div class="alert alert-danger" role="alert" style="display:none;" id="cx01">
                            Se alcanzo el limite de Cargas por Propuesta!
                        </div>            
                        @if($Nrocar> 0 )                                   
                            <div class="row" id="rowt">
                                <div class="col-sm-12" id="titu">
                                    <div class="row">
                                        <div id="titc1">                                    
                                            <label>
                                                Rutcar                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc2">                                    
                                            <label>
                                                dvcar                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc3">                                    
                                            <label>
                                                Paterno                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc4">                                    
                                            <label>
                                                Materno                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc5">                                    
                                            <label>
                                                Nombres                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc6">                                    
                                            <label>
                                                Peso                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc7">                                    
                                            <label>
                                                Estat                                                     
                                            </label>                            
                                        </div>
                                        <div id="titc8">                                    
                                            <label>
                                                Fecha Nac                                                     
                                            </label>                            
                                        </div>
                                    </div> 
                                </div> 
                            </div>                 
                            @php
                                $lscoutn = 0;
                            @endphp   
                            @foreach($lscargas as $cargas) 
                                @php
                                    $lscoutn = $lscoutn + 1;                                  
                                @endphp                    
                                <div  class="form-groupx" id ="divc{{$lscoutn}}">
                                    <!-- Inputs ocultos para las cargas  -->
                                  
                                    <input id="imccg{{$lscoutn}}" name="imc{{$lscoutn}}" class="form-control" value="{{$cargas->imc}}" type="hidden" /> 
                                    <div id="divc1x" class="form-a">                                 
                                        <input id="rutcg{{$lscoutn}}" name="ruta{{$lscoutn}}" class="form-control" value="{{$cargas->rutcar}}" /> 
                                    </div>  
                                    <div id="divc2x" class="form-a">
                                        <input id="dvcg{{$lscoutn}}" name="dva{{$lscoutn}}" class="form-control" value="{{$cargas->dvcar}}" />                                                            
                                    </div>                                                                              
                                    <div id="divc3x" class="form-a">                                   
                                        <input id="patcg{{$lscoutn}}" name="pata{{$lscoutn}}" class="form-control"  value="{{$cargas->pat}}" />
                                    </div>                                                       
                                    <div id="divc4x" class="form-a">
                                        <input  id="matcg{{$lscoutn}}" name="mata{{$lscoutn}}" class="form-control"  value="{{$cargas->mat}}" />                                                            
                                    </div>                                
                                    <div id="divc5x" class="form-a">
                                        <input  id="nomcg{{$lscoutn}}" name="noma{{$lscoutn}}" class="form-control"  value="{{$cargas->nom}}" />                                                            
                                    </div>                              
                                    <div id="divc6x" class="form-a">
                                        <input  id="pesocg{{$lscoutn}}" name="pesoa{{$lscoutn}}" class="form-control"  value="{{$cargas->peso}}" />                                                            
                                    </div> 
                                    <div id="divc7x" class="form-a">                                    
                                        <input  id="estacg{{$lscoutn}}" name="estata{{$lscoutn}}" class="form-control"  value="{{$cargas->estat}}" />                                                            
                                    </div>
                                    <div id="divc8x"class="form-a">                                    
                                        <input  id="fncg{{$lscoutn}}" name="fnaca{{$lscoutn}}" class="form-control"  value="{{$cargas->fnac}}" />                                                            
                                    </div> 
                                    <!-- <input class="btn btn-info btn-wd" value="" id="btdel" onclick='f_borrar();'>  -->
                                    <!-- <a data-id="{{$resp->id}}"  onclick='f_borrar();' ><span class='fa fa-trash'></span></a>   -->
                                    <button data-id = "{{$cargas->id}}" id="{{$lscoutn}}"  class='delete' onclick='f_borrar();'><span class='fa fa-trash'></span></button>  
                                    <!-- <input data-id = "{{$cargas->id}}" class="btn btn-info btn-wd" value="Borrar" id="bt02" onclick='f_borrar();'>  -->
                                </div>                         
                            @endforeach             
                        @endif                       
                    </div>  
                @endforeach
                <!-- Recaudos -->
                <div class="row"> 
                <hr>  
                    <label class="col-sm-2 control-label">Opciones:</label>
                    <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input id="is-call" name="is-call" class="form-check-input" type="checkbox">
                                <span class="form-check-sign"></span>
                                PENDIENTE PARA GESTION DE LLAMADAS
                            </label>
                        </div>
                      
                    </div>                    
                </div>
                <hr>
                <!-- Gestion  Auditoria-->
                <div class="row">                   
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Gestion de auditoria</label>
                        <select class="form-control" id="sel05" name="gestion" required>
                            <option value="" selected disabled>Seleccione Gestion</option>                            
                            <option value=1>INGRESADA</option>
                            <option value=2>DEVUELTA</option> 
                            <option value=3>INGRESADA EN CIERRE</option>  
                            <option value=0>SIN GESTION</option>                                                                                                     
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Tipificacion</label>
                        <select class="form-control" id="sel06" name="tipif">
                            <option value="" selected >Seleccione Tipificacion</option>
                            <option value=1>DUPLICIDAD</option>
                            <option value=2>RUT</option>                                                  
                            <option value=3>INCONSISTENCIA EN EL MANDATO</option> 
                            <option value=7>OTROS</option>   
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Sub-Tipificacion</label>
                        <select class="form-control" id="sel07" name="subtipif">
                            <option value="" selected >Seleccione Sub-Tipificacion</option>
                            <option value=8>AUTORIZADA</option>
                            <option value=9>RECHAZADA </option> 
                            <option value=10>PENDIENTE </option>                                       
                        </select>
                    </div>
                </div>
                <!-- Gestion de llamadas -->
                <div class="row">                   
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Gestion de Llamada</label>
                        <select class="form-control" id="sel08" name="callgestion">
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
                        <label for="exampleFormControlSelect1">Tipificacion de llamada</label>
                        <select class="form-control" id="sel09" name="calltipif">
                            <option value="" selected >Seleccione Tipificacion</option>                             
                            <option value=4>APAGADO</option>  
                            <option value=5>WHATSAPP</option>                        
                            <option value=6>RESPUESTA NEGATIVA EN LLAMADA</option>
                            <option value=7>OTROS</option>                                                                             
                        </select>
                    </div>    
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Ejecutiva/(o) Asignada</label>
                        <input id="rutcar" name ="rutcar" class="form-control"  value="{{$resp->ejea}}" DISABLED/>     
                    </div>                     
                </div>
                <!-- Observaciones  -->
                <div class="row">                   
                    <div class="col-sm-12">
                        <div class="form-group has-success">
                        <textarea class="form-control" id="observa" name="observa" rows="5" placeholder="Observaciones" >{{$resp->observaciones}} </textarea>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Grabar  -->
            <div class="row">
                <div class="col-md-6">                       
                    <div class="card-body">                           
                        <input class="btn btn-info btn-wd" value="Salir" id="bt02" onclick='f_salire();'> 
                        <input class="btn btn-warning btn-wd" value="Grabar" id="bt01" onclick='f_grabar();'>                                                      
                    </div>
                </div>
            </div> 
            <div>
        <!-- <input onclick="validar();" type="button" value="Enviar" id="enviar" class="boton"> -->
       
    </div>           
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Init Sliders
        demo.initSliders();
    });
</script>
<form method="POST" action="{{ route('borrarc',array('ldid' =>$ldid)) }}" name="borrarcg" id="borrarcg">
    @csrf              
    <input type="hidden"  id="borrar" name="borrar" class="input_valores_provisionales" value="" /> 

    <!-- aqui llena el array que se ejecutara cuando grabe  -->
</form>
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>

<!-- Crear divs para las cargas  -->
<script>   
    $(document).ready(function() {  
        $(function () {
            $("#add").on( "click", function() {	
                var dadic = document.getElementsByClassName("form-groupx").length;  
                    
                var nroid = dadic + 1; 
                if(nroid == 2)  {
                    if ( !$("#divc1").length > 0 ) {
                        nroid = 1;
                    } 
                }
                if(nroid == 3)  {
                    if ( !$("#divc1").length > 0 ) {
                        nroid = 1;
                    } 
                    if ( !$("#divc2").length > 0 ) {
                        nroid = 2;
                    } 
                }    
                // $('#items').append("<div class='form-groupx'  id='divc"+ nroid +"' ><div class='input-group'><input type='text' class='form-control' name='rut' placeholder='Rut' id='rutc"+ nroid +"'></div><div class='input-group'><input type='text' class='form-control' name='date' placeholder='Paterno' id='patc"+ nroid +"'></div><div class='input-group'><input type='text' class='form-control' name='date' placeholder='Materno' id='matc"+ nroid +"'></div><div class='input-group'><input type='text' class='form-control' name='date' placeholder='Nombres' id='namc"+ nroid +"'></div><div class='input-group'><input type='text' class='form-control' name='date' placeholder='Peso' id='pesc"+ nroid +"'></div><div class='input-group'><input type='text' class='form-control' name='date' placeholder='Estat' id='estc"+ nroid +"'></div><button class='delete'><span class='fa fa-trash'></span></button></div>");
                $('#items').append("<div  class='form-groupx'   id='divc"+ nroid +"'><div id='divc1x' class='form-a'><input id='rutcg"+ nroid +"' name='rutcg"+ nroid +"' class='form-control' placeholder='Rut'  value=''/></div><div id='divc2x' class='form-a'><input placeholder='dv' id='dvcg"+ nroid +"' name='dvcg"+ nroid +"' class='form-control' value=''/></div><div id='divc3x' class='form-a'><input placeholder='Paterno' id='patcg"+ nroid +"' name='patcg"+ nroid +"' class='form-control'  value=''/></div><div id='divc4x' class='form-a'><input placeholder='Materno' id='matcg"+ nroid +"' name='matcg"+ nroid +"'  class='form-control'  value=''/></div><div id='divc5x' class='form-a'><input placeholder='Nombres'  id='nomcg"+ nroid +"' name='nomcg"+ nroid +"' class='form-control'  value=''/></div><div id='divc6x' class='form-a'><input placeholder='Rel' id='relcg"+ nroid +"'  name='relcg"+ nroid +"' class='form-control'  value=''/></div><div id='divc8x'class='form-a'><input placeholder='Fecha Nac' id='fncg"+ nroid +"' name='fncg"+ nroid +"' class='form-control'  value=''/></div><button id='trashc"+ nroid +"' class='delete'><span class='fa fa-trash'></span></button></div>");
                var divs = document.getElementsByClassName("form-groupx").length;
                if (divs==3){
                    $('#add').hide();
                    $('#cx01').show();
                } else {
                    $('#add').show();
                    $('#cx01').hide();
                }
            });
        })
        $("body").on("click", ".delete", function (e) {     
            $(this).parent("div").remove();
            var divs = document.getElementsByClassName("form-groupx").length;        
            if (divs==3){
                $('#add').hide();
                $('#cx01').show();
            } else {
                $('#add').show();
                $('#cx01').hide();
            }
        });
    });
</script>
<!-- Llenar los combos  -->
<script>   
    $(document).ready(function() {  
        // Sexo
        const miVar = "<?php echo $resp->sex ?>";
        $('#sel02').val(miVar).prop('selected', true);
        // Banco
        const miban = "<?php echo $resp->banco ?>";
        $('#sel03').val(miban).prop('selected', true);
        // Plan
        const miplan = "<?php echo $resp->numgru ?>"
        $('#sel01').val(miplan).prop('selected', true);
        // Isapre
        const miisa = "<?php echo $resp->isa ?>"
        $('#sel04').val(miisa).prop('selected', true);
        // Gestion 
        const migt = "<?php echo $resp->gestion ?>";
        $('#sel05').val(migt).prop('selected', true);
        // Tipificacion
        const mitp = "<?php echo $resp->tipificacion ?>";
        $('#sel06').val(mitp).prop('selected', true);
         // subtipifi
         const mist = "<?php echo $resp->subtipif ?>"
        $('#sel07').val(mist).prop('selected', true);
        // Gestion call
        const migtc = "<?php echo $resp->gtcall ?>";
        $('#sel08').val(migtc).prop('selected', true);
        // Tipificacion call
        const mitpc = "<?php echo $resp->tpcall ?>";
        $('#sel09').val(mitpc).prop('selected', true);
        // Check para que pase a llamadas
        const micalla = "<?php echo $resp->is_call ?>";     
        if(micalla==1){           
            $("#is-call").prop("checked", true);
        } else {
            $("#is-call").prop("checked", false);
        }
    });
</script>
<!-- Funcion Grabar -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar las modificaciones hechas?",
            text: "Edicion de Propuestas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Modificar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Actualizado!", "Tu registro fue actualizado.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<!-- Funcion Salir -->
<script>
    function f_salire() {  
        swal({
            title: "Estas Seguro de salir?",
            text: "Edicion de Propuestas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Salir!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                history.go(-1);
            //   window.location.href = "{{ route('buscar')}}";
 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<!-- Funcion Borrar Cargas  -->
<script>
    // function f_borrar() {  
        const animals = [];
        $('.delete').on('click',function () {
         
            var dataId = $(this).attr("data-id");
            // alert(dataId);
            $('.input_valores_provisionales').val(dataId);            
             animals.push(dataId);
            alert(animals);
            var divid = $(this).attr('id');
            var tre = 'divc'+divid;
            var div = document.getElementById(tre);           
            swal({
                title: "Estas Seguro de Borrar la Carga?",
                text: "Edicion de Cargas",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Eliminar!",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {   
                    div.remove();                                 
                    $.ajax({
                            url: "{{route('borrarc')}}",
                            method: 'POST',
                            data: $("#borrarcg").serialize()
                        }).done(function(res){
                            swal("Borrado!", "Carga Borrada.", "success");
                        });          
                } else {
                    swal("Cancelado", "Proceso Cancelado", "error");
                }
            });
        });
    // }
</script>



<!-- Estilos de la pagina  -->
<style>
    #divb {
        display: flex;  
    }
    #bt01a {
        margin-left: 5px;
    }
    .form-groupx {       
        margin-bottom: 5px;
        width: 100%;
    }
    .form-groupx {
        display: flex;
        margin-left: 15px;
        margin-bottom: 0px;
    }  
    #trashc1, #trashc2, #trashc3 {
        background-color: red;
    }
    #trashc1, #trashc2, #trashc3 {
        color: white;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: #007da7;
    }
    #divc1x {
        width: 100px;
    }
    #divc4x,#divc3x,#titc1,#titc4,#titc5,#titc3 {
       
    }

    #divc5x {
        width: 270px;
    }
    #divc6x,#divc2x,#titc6,#titc2 {
        width: 50px;
    }

    #divc7x,#titc7 {
        width: 60px;
    }
    #rowt {
        margin-left: 15px;
        margin-bottom: 0px;
    }
    #titc8,#divc8x {
        width: 130px;
    }
    #cx01 {
        width: 50%;
    }
</style>


<script>

// function validar() {
//         var elemento = document.getElementById("gestion").value
//         alert(elemento);
//       if (elemento == ""){
//         alert("Debes llenar el campo")
//         return false
//       }else {
//         alert("Genial el valor es: "+elemento)
//         return false
//       }
//     }




</script>






@endsection
@endauth

