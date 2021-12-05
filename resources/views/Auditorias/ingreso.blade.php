@extends('layouts.menu')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@auth
@section('content')
                                 
<div class="col-md-12">
    <div class="card ">
        <form method="POST" action="{{ route('gingreso') }}" name="formedit" enctype="multipart/form-data">
            @csrf          
            <div class="card-body ">                                                   
                <!-- Datos de la campaña-->
                    <div class="row">
                        <div class="col-sm-12" id="Camp">  <!-- Sponsor / Campaña -->
                            <div class="row">
                                <div class="col-sm-6">                               
                                    <select id="super" name="sponsor" class="form-control" required>     
                                        <option value="" selected>Seleccione un Sponsor</option>   
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
                                        <option value=''>Seleccione Canal</option>
                                        @foreach($canal as $select3)
                                            <option value="{{ $select3->id }}" id="canalop">{{ $select3->name }}</option>                                        
                                        @endforeach
                                    </select> 
                                    <input type="hidden" value="" id="hicanal" name="hicanal">               
                                </div>
                                <div class="col-sm-6">                              
                                    <select id="telop" data-old="" name="telop" class="form-control" style="display:none;" required></select>       
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
                                        <input type='date' class="form-control datepicker" placeholder="Date Picker Here" name="fventa"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="title">fecha Asignacion</label>
                                    <div class="form-group">
                                        <input type='date'  class="form-control datepicker" placeholder="Date Picker Here" name="fasig" />
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
                                        <input id="rutcar" name ="rutcar" class="form-control"/>                                                            
                                    </div>
                                </div>   
                                <div class="col-sm-1">
                                    <div class="form-group has-label">
                                        <label>
                                            Dv-Rut                                             
                                        </label>
                                        <input id="dvcar" name ="dvcar" class="form-control"/>                                                            
                                    </div>
                                </div> 
                            </div>
                            <div class="row" >   
                                @if($emp_type == 7) 
                                    <div class="col-sm-6">
                                        <div class="form-group"  style="display:none" id="diveje">                                                             
                                            <select data-title="Seleccione Ejecutiva"  id="ejecasig"  name="asigna"  class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue"> 
                                                @foreach ($ejecutivos->chunk(3) as $chunk)                                               
                                                    @foreach ($chunk as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" id="chkasig" name="chkasig" value= 1>
                                                    <span class="form-check-sign"></span>
                                                    Asignar Ejecutiv@
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                        <input id="idgr" name ="idgrab" class="form-control" required  style="text-transform:uppercase" value=""/>                                                            
                                    </div>
                                </div>                                                                                                                                                                      
                            </div>
                        </div>   
                    </div>              
                <!-- MENSAJES DE ALERTAS  -->
                    <div class="row" id="lines">
                        <div class="col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-chart-pie-36 text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">    
                                                <div id="tit">                       
                                                    <h1 class="card-title" id="pct">100</h1><h1 class="card-title" id="pct">%</h1>
                                                </div>
                                                <input type="hidden" name="npct" id="npct" value=100>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-bar-chart"></i> Nota Parcial
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-chart-bar-32 text-danger"></i>                                                
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">                                       
                                                <div id="tit">                       
                                                    <h1 class="card-title" id="pct2">100</h1><h1 class="card-title" id="pct">%</h1>
                                                </div>                                     
                                                <input type="hidden" name="ntlt" id="ntlt" value = 100>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-bar-chart"></i> Nota Final
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="alert alert-info alert-with-icon" data-notify="container" id="cumple">                    
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                        <span><b> Cumple - </b> Auditoria satisfactoria.</span>
                    </div>                
                    <div class="alert alert-danger alert-with-icon" data-notify="container" style="display: none" id="alert">                    
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>                     
                        <span><b> Alerta - </b> La Auditoria no cumple con algun requerimeinto.</span>
                    </div>
                    <br>      
                <!-- PREGUNTAS  -->
                    <div class="card-body">
                        <div class="accordions" id="accordion">
                            <!-- (A) PRESENTACION DEL EJECUTIVO  5  -->      
                                <div class="card">
                                    <input type="hidden" name="pA" id="pA" value=10>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHover" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (A) - PRESENTACION DEL EJECUTIVO - </label><label for="" id="preA" name="prese" class="prefA"> 10 </label><label for="" class="prefA" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHover" class="card-collapse collapse">
                                        <div class="card-body">                     
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkA1" id="chkA1" checked><label for="">1.- Presentación (Ejecutivo se debe presentar con su nombre y apellido). Tal cual aparece en el script. </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkA2" id="chkA2" checked><label for="">2.- Debe mencionar a la Corredora y a la Compañía de Seguros </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkA3" id="chkA3" checked><label for="">3.- Mencionar que la conversación esta siendo grabada tal como lo exige la Comision de Mercado Financiero o CMF.</label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkA4" id="chkA4" checked><label for="">4.- Mencionar Nombre del Seguro a ofrecer. </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkA5" id="chkA5" checked><label for="">5.- Mencionar Fecha de la oferta. </label></div>
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (B) COBERTURAS Y CARGOS  4 -->    
                                <div class="card">
                                    <input type="hidden" name="pB" id="pB" value=20>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverB" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (B) - COBERTURAS Y CARGOS - </label><label for="" class="prefB" id="preB"> 20 </label><label for="" class="prefB" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverB" class="card-collapse collapse">
                                        <div class="card-body">                                             
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkB1" id="chkB1" checked><label for="">1.- Coberturas, Indemnizaciones en UF y pesos. Topes de coberturas.(SI corresponde) </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkB2" id="chkB2" checked> <label for="">2.- Mencionar Convenios adicionales (asistencias) con topes, eventos, telefonos y copago si corresponde.</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkB3" id="chkB3" checked><label for="">3.- Req.Aseg. Edad tope de contratación de titular y/o adicionales (según corresponda al seguro).</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkB4" id="chkB4" checked><label for="">4.- Entrega valor (prima) del seguro dependiendo plan contratado en Uf xxx + pesos + Aprox. + Mensual </label></div>
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (C) PREVIO A LA CONTRATACION  6 -->
                                <div class="card">
                                    <input type="hidden" name="pC" id="pC" value=25>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverC" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (C) PREVIO A LA CONTRATACION  -</label> <label for="" id="preC" class="prefC"> 25 </label><label for="" class="prefC" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverC" class="card-collapse collapse">
                                        <div class="card-body">                                            
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC1" id="chkC1" checked><label for="">1.- Realizar pregunta de DPS (según corresponda de acuerdo al seguro ofrecido.  </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC2" id="chkC2" checked> <label for="">2.- Mencionar claramente carencia y deducible (según corresponda de acuerdo al seguro ofrecido).  </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC3" id="chkC3" checked><label for="">3.- Mencionar las exclusiones y Numero de Poliza.</label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC4" id="chkC4" checked><label for="">4.- Plazo envio de póliza.  </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC5" id="chkC5"  checked><label for="">5.- Parrafo termino anticipado de contrato </label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkC6" id="chkC6" checked><label for="">6.- Realizar pre cierre para detectar interes del cliente.  </label></div>
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (D) DATOS PERDSONALES  8 -->    
                                <div class="card">
                                    <input type="hidden" name="pD" id="pD" value=10>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverD" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (D) CORROBORACION DE DATOS PERSONALES -</label><label for="" id="preD" class="prefD"> 10 </label><label for="" class="prefD" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverD" class="card-collapse collapse">
                                        <div class="card-body">                                                                
                                            <div class="col-sm-12">               
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD1" id="chkD1" checked><label for="">1. - Nombre completo (50% y 50% en foma completa por parte de cliente/ o como este estipulado en la pauta)  </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD2" id="chkD2" checked><label for="">2. - Rut (Ejecutivo sólo podrá indicar los 4 primeros dígitos del rut al Titular) </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD3" id="chkD3" checked><label for="">3. - Rut de adicionales (SOLICITAR) Si cliente no lo tiene puede continuar gestion</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD4" id="chkD4" checked><label for="">4. - Fecha de nacimiento (lo debe indicar el cliente o el ejecutivo mencionar día y mes y el cliente continuar mencionando el año) </label></div>
                                                </div>    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD5" id="chkD5" checked><label for="">5. - E-mail (cliente debe indicarlo y ejecutivo debe parafrasear de ser necesario)  </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD6" id="chkD6" checked><label for="">6. - Dirección (Cliente debe mencionar la dirección completa e indicar si es comercial o particular) </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD7" id="chkD7" checked><label for="">7. - Telefono de Venta (VERIFICAR)</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkD8" id="chkD8" checked><label for="">8. - Telefono de Contacto o celular (SOLICITAR) </label></div>
                                                </div>     
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                            <!-- (E) CONTRATACION  4 -->    
                                <div class="card">
                                    <input type="hidden" name="pE" id="pE" value=25>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverE" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (E) - CONTRATACION -</label><label for="" id="preE" class="prefE"> 25 </label><label for="" class="prefE" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverE" class="card-collapse collapse">
                                        <div class="card-body">                                                      
                                                
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkE1" id="chkE1" checked><label for="">1. - Ejecutivo debe mencionar textual Pregunta de cierre tal cual esta en script.   </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkE2" id="chkE2" checked><label for="">2. - Cliente debe responder claramente con (Sí, Bueno, Acepto, De acuerdo, Ok.)  </label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkE3" id="chkE3" checked><label for="">3. - Ejecutivo debe mencionar en donde se realizara el cargo del seguro (medio de pago)según aparezca en el registro.</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkE4" id="chkE4" checked><label for="">4. - Ejecutivo debe indicar numero de contratacion de la Venta </label></div>
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (F) INFORMACION FINAL DE LA VENTA  3  -->    
                                <div class="card">
                                    <input type="hidden" name="pF" id="pF" value=5>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverF" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (F) - INFORMACION FINAL DE LA VENTA - </label><label for="" id="preF" class="prefF"> 5 </label><label for="" class="prefF" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverF" class="card-collapse collapse">
                                        <div class="card-body">                                                                  
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkF1" id="chkF1" checked><label for="">1. - El ejecutivo debe mencionar el período de retractación del seguro. (Solo como informacion, no como argumento de venta.)// Becs informar % participación Empresas.    </label></div>
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkF2" id="chkF2" checked><label for="">2. - Ejecutivo debe mencionar todos los parrafos informativos  </label></div>
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkF3" id="chkF3" checked><label for="">3. - Ejecutivo debe entregar los teléfonos de servicio al cliente.</label></div>                     
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (G) INFORMACION CUALITATIVA (5%) 5 -->
                                <div class="card">
                                    <input type="hidden" name="pG" id="pG" value=5>   
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverG" href="#" data-toggle="collapse">
                                            <label for="" id="prv"> (G) - INFORMACION CUALITATIVA - </label> <label for="" id="preG" class="prefG"> 5 </label><label for="" class="prefG" > % </label>
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverG" class="card-collapse collapse">
                                        <div class="card-body">                                                                  
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkG1" id="chkG1"  checked><label for="">1. - Ejecutivo realiza escucha Activa, no interrumpe a cliente.</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkG2" id="chkG2" checked><label for="">2. - Ejecutivo maneja una velocidad acorde a la venta telefónica.</label></div>
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkG3" id="chkG3" checked><label for="">3. - Ejecutivo con buena modulación.</label></div>   
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkG4" id="chkG4"  checked><label for="">4. - Ejecutivo con buena dicción.</label></div>      
                                                    <div class="col-md-2"> <input class="form-check-input" type="checkbox" value=1 name="chkG5" id="chkG5" checked><label for="">5. - Ejecutivo con buen vocabulario acorde a la venta telefónica.</label></div>                  
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>
                            <!-- (H) ACCIONES CRITICAS (100%) 7 -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-target="#collapseOneHoverH" href="#" data-toggle="collapse">
                                            <label for="" id="evalAC"> (H) - EVALUACION DE ACCIONES CRITICAS </label> 
                                                <b class="caret"></b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneHoverH" class="card-collapse collapse">
                                        <div class="card-body">                                                                  
                                            <div class="col-sm-12">                                                    
                                                <div class="row">
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkH1" id="chkH1" checked><label for="">1. - El ejecutivo deberá responder clara y directamente ante cualquier pregunta que realice el cliente..</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkH2" id="chkH2" checked><label for="">2. - Ejecutivo utiliza una velocidad alta al mencionar los valores de prima y preguntas de cierre..</label></div>
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkH3" id="chkH3"  checked><label for="">3. - El ejecutivo jamás deberá condicionar la contratación del seguro a la recepción de la póliza.</label></div>   
                                                    <div class="col-md-3"> <input class="form-check-input" type="checkbox" value=1 name="chkH4" id="chkH4"  checked><label for="">4. - El ejecutivo no es claro en la entrega de informacion. (Juego de palabras).</label></div>                        
                                                </div>   
                                                <div class="row">
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkH5" id="chkH5"  checked><label for="">5. - Si la conversación se corta el ejecutivo deberá llamar nuevamente al cliente y comenzar todo de nuevo. (venta completa).</label></div>
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkH6" id="chkH6"  checked><label for="">6. - Grabación con fallas técnicas.</label></div>
                                                    <div class="col-md-4"> <input class="form-check-input" type="checkbox" value=1 name="chkH7" id="chkH7"  checked><label for="">7. - Otros Argumentos.</label></div>                                        
                                                </div>         
                                            </div>                                                      
                                        </div>
                                    </div>
                                </div>         
            
                        </div>
                    </div>
                <!-- Cargar Grabacion de alerta  -->
                    <div id="cargagrab" style="display:none;">               
                        <label for="file-0b">Ingrese Grabacion de Alerta</label>
                        <input id="file-0b"  class="form-control" name="file-0b" type="file" enctype="multipart/form-data" accept="audio/*" required>
                        <br>                     
                    </div>   
               <!-- Observaciones  -->
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observaciones</label>
                        <textarea class="form-control" id="tt01" rows="4" name="observ" style="text-transform:uppercase; height: 90px;"></textarea>
                    </div>       
            </div> 
            <input type="hidden" name="estado" id="estado" value="CUMPLE">        
            <div class="card-footer text-right">
                <button type="button" class="btn btn-info btn-fill pull-left" onclick="f_salire()">Limpiar</button> 
                <button type="button" class="btn btn-warning btn-fill pull-right" onclick="validar()">Grabar</button>                                        
            </div>
        </form>          
    </div>
</div>

                  
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>

<script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js')}}"></script>

<!-- Funcion de Checkbox  y alert -->
<script>
    $('input[type=checkbox]:checked').on('change', function() {
        // VARIABLES 
            var tA = 0;
            var tB = 0;
            var tC = 0;
            var tD = 0;
            var tE = 0;
            var tF = 0;
            var tG = 0;
            var tparcial = 0;
            // hasta aqui toma para el calculo de Nota parcial 
            var tH = 0;
            var lchkA1 = 0;
            var lchkA2 = 0;
            var lchkA3 = 0;
            var lchkA4 = 0;
            var lchkA5 = 0;
            var lchkB1 = 0;
            var lchkB2 = 0;
            var lchkB3 = 0;
            var lchkB4 = 0;
            var lchkC1 = 0;
            var lchkC2 = 0;
            var lchkC3 = 0;
            var lchkC4 = 0;
            var lchkC5 = 0;
            var lchkC6 = 0;
            var lchkD1 = 0;
            var lchkD2 = 0;
            var lchkD3 = 0;
            var lchkD4 = 0;
            var lchkD5 = 0;
            var lchkD6 = 0;
            var lchkD7 = 0;
            var lchkD8 = 0;
            var lchkE1 = 0;
            var lchkE2 = 0;
            var lchkE3 = 0;
            var lchkE4 = 0;
            var lchkF1 = 0;
            var lchkF2 = 0;
            var lchkF3 = 0;
            var lchkG1 = 0;
            var lchkG2 = 0;
            var lchkG3 = 0;
            var lchkG4 = 0;
            var lchkG5 = 0;
            var lchkH1 = 0;
            var lchkH2 = 0;
            var lchkH3 = 0;
            var lchkH4 = 0;
            var lchkH5 = 0;
            var lchkH6 = 0;
            var lchkH7 = 0;
            var lcount = 0;
            var lac = 0;
        $('input[type=checkbox]:checked').each(function() {
            var lid = $(this).prop("id");    
            // A 
                if(lid == "chkA1"){      
                    lchkA1 = 2;  
                    lcount = lcount+1;     
                } 
                if(lid == "chkA2"){       
                    lchkA2 = 2;   
                    lcount = lcount+1;      
                } 
                if(lid == "chkA3"){      
                    lchkA3 = 2;
                    lcount = lcount+1;          
                } 
                if(lid == "chkA4"){       
                    lchkA4 = 2;
                    lcount = lcount+1;         
                } 
                if(lid == "chkA5"){      
                    lchkA5 = 2; 
                    lcount = lcount+1;         
                } 
                tA = lchkA1 + lchkA2 + lchkA3 + lchkA4 + lchkA5;
                $('#pA').val(tA);   
            // B 
                if(lid == "chkB1"){      
                    lchkB1 = 6; 
                    lcount = lcount+1;      
                } 
                if(lid == "chkB2"){       
                    lchkB2 = 6;      
                } 
                if(lid == "chkB3"){      
                    lchkB3 = 2; 
                    lcount = lcount+1;      
                } 
                if(lid == "chkB4"){       
                    lchkB4 = 6;     
                    lcount = lcount+1; 
                }   
                tB = lchkB1 + lchkB2 + lchkB3 + lchkB4;
                $('#pB').val(tB); 
            // C 
                if(lid == "chkC1"){      
                    lchkC1 = 5;   
                    lcount = lcount+1;    
                } 
                if(lid == "chkC2"){       
                    lchkC2 = 4;  
                    lcount = lcount+1;    
                } 
                if(lid == "chkC3"){      
                    lchkC3 = 5; 
                    lcount = lcount+1;      
                } 
                if(lid == "chkC4"){       
                    lchkC4 = 4; 
                    lcount = lcount+1;     
                } 
                if(lid == "chkC5"){      
                    lchkC5 = 2; 
                    lcount = lcount+1;      
                } 
                if(lid == "chkC6"){      
                    lchkC6 = 5;       
                } 
                tC = lchkC1 + lchkC2 + lchkC3 + lchkC4 + lchkC5 + lchkC6;
                $('#pC').val(tC); 
            // D 
                if(lid == "chkD1"){      
                    lchkD1 = 2; 
                    lcount = lcount+1;      
                } 
                if(lid == "chkD2"){       
                    lchkD2 = 2; 
                    lcount = lcount+1;     
                } 
                if(lid == "chkD3"){      
                    lchkD3 = 0.5;       
                } 
                if(lid == "chkD4"){       
                    lchkD4 = 0.5;      
                } 
                if(lid == "chkD5"){      
                    lchkD5 = 2;   
                    lcount = lcount+1;    
                } 
                if(lid == "chkD6"){      
                    lchkD6 = 1;       
                } 
                if(lid == "chkD7"){      
                    lchkD7 = 1;       
                } 
                if(lid == "chkD8"){      
                    lchkD8 = 1;       
                } 
                tD = lchkD1 + lchkD2 + lchkD3 + lchkD4 + lchkD5 + lchkD6 + lchkD7 + lchkD8;
                $('#pD').val(tD); 
            // E 
                if(lid == "chkE1"){      
                    lchkE1 = 8;       
                    lcount = lcount+1;
                } 
                if(lid == "chkE2"){       
                    lchkE2 = 8; 
                    lcount = lcount+1;     
                } 
                if(lid == "chkE3"){      
                    lchkE3 = 7;    
                    lcount = lcount+1;   
                } 
                if(lid == "chkE4"){       
                    lchkE4 = 2;  
                    lcount = lcount+1;    
                } 
                tE = lchkE1 + lchkE2 + lchkE3 + lchkE4;
                $('#pE').val(tE); 
            // F 
                if(lid == "chkF1"){      
                    lchkF1 = 3;  
                    lcount = lcount+1;     
                } 
                if(lid == "chkF2"){       
                    lchkF2 = 1;     
                    lcount = lcount+1; 
                } 
                if(lid == "chkF3"){      
                    lchkF3 = 1;    
                    lcount = lcount+1;   
                }            
                tF = lchkF1 + lchkF2 + lchkF3;
                $('#pF').val(tF); 
            // G 
                if(lid == "chkG1"){      
                    lchkG1 = 1;       
                } 
                if(lid == "chkG2"){       
                    lchkG2 = 1;      
                } 
                if(lid == "chkG3"){      
                    lchkG3 = 1;       
                } 
                if(lid == "chkG4"){       
                    lchkG4 = 1;      
                } 
                if(lid == "chkG5"){      
                    lchkG5 = 1;       
                } 
                tG = lchkG1 + lchkG2 + lchkG3 + lchkG4 + lchkG5;
                $('#pG').val(tG); 
            // H  
                if(lid == "chkH1"){         
                    lcount = lcount+1; 
                    lac = lac + 1;     
                } 
                if(lid == "chkH2"){               
                    lcount = lcount+1;
                    lac = lac + 1;      
                } 
                if(lid == "chkH3"){      
                    lcount = lcount+1; 
                    lac = lac + 1;        
                } 
                if(lid == "chkH4"){       
                    lcount = lcount+1;
                    lac = lac + 1;  
                } 
                if(lid == "chkH5"){                
                    lcount = lcount+1;  
                    lac = lac + 1;    
                } 
                if(lid == "chkH6"){      
                    lcount = lcount+1; 
                }                   
                tH = tA + tB + tC + tD + tE + tF + tG;              
               
        });
        // A 
            $('#preA').text(tA);
            if(tA !== 10) {
                $('.prefA').css("color", "#f90303");
            } else {    
                $('.prefA').removeAttr('style');
            }
        // B 
            $('#preB').text(tB);
            if(tB !== 20) {
                $('.prefB').css("color", "#f90303");
            } else {    
                $('.prefB').removeAttr('style');
            }
        // C
            $('#preC').text(tC);
            if(tC !== 25) {
                $('.prefC').css("color", "#f90303");
            } else {    
                $('.prefC').removeAttr('style');
            }
        // D 
            $('#preD').text(tD);
            if(tD !== 10) {
                $('.prefD').css("color", "#f90303");
            } else {    
                $('.prefD').removeAttr('style');
            }
        // E
            $('#preE').text(tE);
            if(tE !== 25) {
                $('.prefE').css("color", "#f90303");
            } else {    
                $('.prefE').removeAttr('style');
            }
        // F 
            $('#preF').text(tF);
            if(tF !== 5) {
                $('.prefF').css("color", "#f90303");
            } else {    
                $('.prefF').removeAttr('style');
            }
        // G
            $('#preG').text(tG);
            if(tG !== 5) {
                $('.prefG').css("color", "#f90303");
            } else {    
                $('.prefG').removeAttr('style');
            }
        
        // H Evaluacion de Acciones Criticas
        // alert  
            if( lac < 5)   {      
                $( "#alert" ).show(); 
                $( "#cumple" ).hide(); 
                $('#pct2').text("0"); 
                $('#ntlt').val(0); 
                $('#estado').val("ALERTA"); 
                $("#cargagrab").show();           
            } else {   
                $( "#alert" ).hide();
                $( "#cumple" ).show();
                $('#pct2').text(tH);
                $('#ntlt').val(tH); 
                $('#estado').val("CUMPLE"); 
                $("#cargagrab").hide();
            }

            if(tH<100)   {
                $('#pct').text(tH); 
                $('#npct').val(tH);       
            } else {
                $('#pct').text(100);
                $('#npct').val(100);        
            }


            if( lcount < 29)   {      
                $( "#alert" ).show(); 
                $( "#cumple" ).hide();                
                $('#ntlt').val(0);                
                $('#pct2').text(0);
                $('#estado').val("ALERTA");
                $("#cargagrab").show();             
            } else {   
                $( "#alert" ).hide();
                $( "#cumple" ).show();                
                $('#ntlt').val(tH); 
                $('#estado').val("CUMPLE"); 
                $("#cargagrab").hide(); 
            }
            
    });

</script>

<!-- Funcion limpiar -->
<script>
    function f_salire() {  
        swal({
            title: "Estas Seguro de limpiar la ficha?",
            text: "No se guardara ningun dato!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Limpiar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              window.location.href = "{{ route('ingresoaudit')}}"; 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<!-- Funcion Grabar -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar la gestion?",
            text: "Evaluacion de Ventas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Grabado!", "Tu gestion fue grabada.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>
<!-- Funcion para limitar el tamaño de los input Rut y dvrut -->
<script>
    var input=  document.getElementById('rutcar');
    input.addEventListener('input',function(){
    if (this.value.length > 8) 
        this.value = this.value.slice(0,8); 
    })


    var input=  document.getElementById('dvcar');
    input.addEventListener('input',function(){
    if (this.value.length > 1) 
        this.value = this.value.slice(0,1); 
    })
</script>

<!-- funcion para habilitar asignar ejecutiva -->
<script>
    $('#chkasig').on('change', function() {
        if ($(this).is(':checked') ) {
            $( "#diveje" ).show();
        } else {
            $( "#diveje" ).hide();
        }
    });
</script>

<!-- Agregar text al select  -->
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


 <!-- Funcion para llenar los select de los operadores segun el canal  -->
<script>

    $('#canal').on('change', function() {
        var params = {"_token": "{{ csrf_token() }}",
        "id" : this.value};  

        var idx = $(this).attr("id");  // ID del select seleccionado         
        $('#telop').show();
     
        $.ajax({
            type: 'post',
            dataType: 'json',  
            url: "{{route('combos')}}",    
            data: params,
            success: function (data) {              
                $('#telop').empty();
                $('#telop').append("<option value=''>seleccione Operador</option>");
                for (var  x = 0; x < data.length; x++){                 
                    $('#telop').append("<option id='operador' value='" + data[x].id +"' >" + data[x].name + "</option>");
                }
            },
            error: function(data) {
            alert('error');
            }
        });
    });

</script>

<!-- Requerir datos en los select (Sponsor, Campaña y Canal)  -->
<script>
    function validar(){
        var $spon=$('#super');
        var $camp=$('#cia').val();      
        var $cana=$('#canal');
        var $oper=$('#telop');
        var $fgrab=$('#datetimepicker');
        var $fasig=$('#datepicker');
        var $grabid=$('#idgr');
        var cant = 0;
        if($grabid.val() == ""){
            swal("Dato Requerido", "Ingrese ID de Grabacion",'warning');
            cant = cant+1;
        }
        // if($fgrab.val()==""){
        //     swal("Dato Requerido", "Ingrese Fecha de Venta",'warning');
        //     cant = cant+1;
        // }
        if($fasig.val()==""){
            swal("Dato Requerido", "Ingrese Fecha de Asignacion",'warning');
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



@endsection
@endauth

<script>
document.addEventListener('keyup', event => {
  if (event.ctrlKey && event.keyCode === 81) {  
    var observaciones = document.getElementById('tt01').value; 
    var text = observaciones+' '+'[TO]'+' '; 
    document.getElementById('tt01').value =  text;
    // alert(text);
  }
}, false)

</script>



