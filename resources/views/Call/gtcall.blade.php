@extends('layouts.menu')
@auth
@section('content')              
    <div class="col-md-12">           
        <div class="card card-wizard">
            <form method="POST" id="formedit" name="formedit" action="{{ route('grabarcall',array('Nrocar' =>$Nrocar,'ldid' =>$ldid)) }}">  
                {{ csrf_field() }} 
                <div class="card-body ">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item" id="nav1c">
                            <a class="nav-link active" id="tbas4" href="#tab1" data-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">Script</a>
                        </li>
                        <li class="nav-item" id="nav2c">
                            <a class="nav-link" id="tbas4" href="#tab2" data-toggle="tab" role="tab" aria-controls="tab2" aria-selected="true">Datos Asegurado</a>
                        </li>
                        <li class="nav-item" id="nav3c">
                            <a class="nav-link" id="tbas4" href="#tab3" data-toggle="tab" role="tab" aria-controls="tab3" aria-selected="true">Gestion</a>
                        </li>
                        <li class="nav-item" id="nav4c">
                            <a class="nav-link" id="tbas4" href="#tab4" data-toggle="tab" role="tab" aria-controls="tab4" aria-selected="true">Whatsapp</a>
                        </li>
                    </ul>                
                    <div class="tab-content">
                        @foreach($propedit as $resp)
                        @php                          
                            $edad = Carbon\Carbon::parse($resp->fnac)->diff(Carbon\Carbon::now())->format("%y");   
                        @endphp
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">                                                            
                                <!-- scritp -->
                                    <p id="pscript">Buenas dias / Tardes, estoy comunicada con  @if($resp->sex == "F") Doña @else Don @endif: <strong> {{$resp->nom}} {{$resp->pat}} {{$resp->mat}} - [ Edad: {{$edad}} ]  </strong> 
                                    @if(!empty($resp->nombreter)) - [ Pagador: <strong> {{$resp->nombreter}} </strong> ] @endif <br>
                                   
                                    Gusto en saludar mi nombre es   <strong> {{ Auth::user()->name }} </strong>, y lo estoy llamando de  
                                    <strong> METLIFE CHILE SEGUROS DE VIDA SA. </strong> <br></p>
                                     <p id="pgrabar"> <strong> *** LE INFORMAMOS QUE POR MOTIVOS DE SEGURIDAD ESTA LLAMADA ESTA SIENDO GRABADA ***</strong></p>
                                    <p id="tetxp"> El motivo de mi llamada es para realizar la verificación de la reciente contratación 
                                    del seguro con la clínica <strong> {{$resp->clinica}} @if($resp->poliza == "340018711") [ ONCOLOGICO ] @endif</strong>, el cual realizo a través de un ejecutivo el día <strong>{{date('d-m-Y', strtotime($resp->fechavta))}}.</strong> 
                                    <br><strong>¿Es correcta la contracción? (El cliente debe responder SI)</strong><br>
                                    @if($lpagacount > 0)
                                     <p class="card-category">Asegurado como Pagador:</p>                                
                                    <div class="card-body table-full-width table-responsive">
                                            <!-- <table class="table table-hover table-striped">  -->
                                            <table class="table table-hover">                                       
                                                <thead class="thead-dark"> 
                                                    <th>Clinica</th>  
                                                    <th>Prop</th> 
                                                    <th>Asegurado</th>                                             
                                                    <th>Rut</th>                                                     
                                                    <th>Fecha Nac</th>
                                                    <th>Edad</th>
                                                    <th>Pre</th>                                                  
                                                    <th>Fvta</th>  
                                                    <th>Gestion</th>                                            
                                                <!-- </thead>         -->
                                                <tbody>
                                                    @foreach($pagaProp as $paga)
                                                    @php                          
                                                         $edad = Carbon\Carbon::parse($paga->fnac)->diff(Carbon\Carbon::now())->format("%y");   
                     
                                                    @endphp
                                                    @if($resp->gtcall == 5)
                                                    <tr class="success">
                                                    @else 
                                                    <tr class="danger">
                                                    @endif
                                                        <td style="font-size:70%;">{!! $paga->clinica !!}</td>
                                                        <td style="font-size:70%;">{!! $paga->propuesta !!}</td>
                                                        <td style="font-size:70%;">{!! $paga->nom !!} {!! $paga->pat !!} {!! $paga->mat !!}</td>
                                                        <td style="font-size:70%;">{!! $paga->rutcar !!}</td>
                                                        <td style="font-size:70%;">{{date('d-m-Y', strtotime($paga->fnac))}}</td>
                                                        <td style="font-size:70%;">{!! $edad !!}</td>  
                                                        <td style="font-size:70%;">{!! $paga->obs !!}</td>                                                   
                                                        <td style="font-size:70%;">{{date('d-m-Y', strtotime($paga->fechavta))}}</td>
                                                        @if($paga->gt == "") 
                                                        <td style="font-size:70%;">SIN GESTION</td>
                                                        @else 
                                                            <td style="font-size:70%;">{!! $paga->gt !!}
                                                        @endif            
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>   
                                    @endif
                                    <p id="pscript">Perfecto! ahora tendria unos minutos para confirmar algunos datos personales? <br>
                                    <ol>
                                        <!-- <li class="lista1">Rut Titular: <strong>[ {{$resp->rutcar}} - {{$resp->dvcar}} ] </strong></li> -->
                                        <p id="pscript">Verficacion de Rut:  Asegurado / cargas - Fecha Nacimiento / Correo</p>
                                        @if($Nrocar > 0)
                                            
                                        <div class="card-body table-full-width table-responsive">
                                            <!-- <table class="table table-hover table-striped">  -->
                                            <table class="table table-hover">                                       
                                                <thead class="thead-dark">                                              
                                                    <th>Rut</th>                                                
                                                    <th>Asegurado / Carga</th> 
                                                    <th>Fecha Nac</th>
                                                    <th>email</th>
                                                    <th>Rel</th>                                              
                                                <!-- </thead>         -->
                                                <tbody>
                                                    @foreach($lscargas as $cargas)
                                                    <tr>
                                                        <td style="font-size:80%;">{!! $cargas->rutcar !!}</td>
                                                        <td style="font-size:80%;">{!! $cargas->nom !!} {!! $cargas->pat !!} {!! $cargas->mat !!}</td>
                                                        <td style="font-size:80%;">{{date('d-m-Y', strtotime($cargas->fnac))}}</td>
                                                        <td style="font-size:80%;">{!! $cargas->email !!}</td>
                                                        <td style="font-size:80%;">{!! $cargas->rel !!}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>                                       
                                         @endif

                                        <!-- <li class="lista1">Fecha de Nacimiento: <strong>[ {{date('d-m-Y', strtotime($resp->fnac))}} ] </strong></li> -->
                                        <li class="lista1">¿Usted Realizó la declaracion personal de Salud (DPS) ? ¿Declaró alguna enfermedad Pre-existente? <strong> {{$resp->obs}}  </strong></li>
                                        @if($resp->poliza ==  '340018711')                                      
                                        @else
                                         @if($resp->poliza ==  '340015470')                                        
                                         <li class="lista1">¿Recibió el correo electronico para aceptar la contratación del seguro?</li>
                                         @else
                                         <li class="lista1">¿Recibió código de verificación y el correo con el resumen de contratación?</li>
                                         @endif
                                         @endif
                                        <li class="lista1">¿Que medio de pago utilizó?; Banco?, Cuenta Corriente/vista o tarjeta de Credito? - Banco:  <strong> {{$resp->bank}} </strong> - Cuenta: <strong> {{$resp->nrocta}}</strong></li>                                       
                                    </ol></p>
                                    <p class="lista1"> A continuacion reforzaremos la informacion entregada al momento de la venta. <br>
                                    <ol> @php                                 
                                            $lfecha = $resp->vdesde;                                         
                                            $lfechaini = date("d-m-Y",strtotime($lfecha."+ 9 days")); 
                                            $lm = date("m",strtotime($lfecha));
                                            $lme = intval($lm);                                   
                                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                            $lmes = $meses[$lme];                                        
                                        @endphp
                                        @if($resp->poliza ==  '340015470' or $resp->poliza ==  '340018711')    
                                        <li class="lista1">Su fecha de vigencia comenzará a regir el <strong> [ {{date('d-m-Y', strtotime($resp->vdesde))}} ] </strong></li>
                                        @else
                                        <li class="lista1">Su fecha de vigencia comenzará a regir el <strong>[ {{date('d-m-Y', strtotime($resp->vdesde))}} ] </strong>  y en caso de convenio de accidentes el <strong> [ {{ $lfechaini}} ] </strong> </li>
                                        @endif    
                                        <li class="lista1">La cobertura catastrófica tiene una carencia de <strong> 60 dias </strong> desde la vigencia para enfermedades</li>
                                        <li class="lista1">El pago de las primas será cargado los primeros días del mes de <strong> {{$lmes}} </strong> </li>
                                        <li class="lista1">Le recuerdo que el valor de su prima varía según edad, y cantidad de asegurados. - UF: <strong>{{$resp->uf}} </strong></li>
                                        <li class="lista1">Para las preexistencias diagnosticadas con anterioridad a la fecha de contratación del seguro no tendrán cobertura, entendiendo en este punto:</li>
                                            <ul class="lista1"> <li> Enfermedades u accidentes</li> </ul>
                                            <ul class="lista1"> <li> Embarazos </li></ul>
                                            <ul class="lista1"> <li> Intervenciones clínicas programadas </li></ul>                                              
                                        <li class="lista1">Debe considerar algunas exclusiones de tratamientos o cirugías tales como:</li>
                                            <ul class="lista1"> <li>Fertilidad e infertilidad </li></ul>  
                                            <ul class="lista1"> <li>Drogas o Alcohol </li></ul> 
                                            <ul class="lista1"> <li>Psicológicas o Psiquiátricas </li></ul> 
                                            <ul class="lista1"> <li>Esteticas entre otras </li></ul>                                     	 
                                    </ol>                                   
                                    </p> 
                                    <p class="lista1">Estimado <strong> {{$resp->pat}} {{$resp->mat}} {{$resp->nom}} </strong>, de acuerdo a la información entregada y la que recibió de su ejecutivo comercial, usted acepta la contratación del seguro con la Clínica {{$resp->clinica}} ?</p>                       
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios1" value="1" checked>
                                            <span class="form-check-sign"></span>
                                            SI
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio disabled">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios1" value="2">
                                            <span class="form-check-sign"></span>
                                            NO
                                        </label>
                                    </div>
                                    <div id="NO-Acep" style="display:none;">
                                    <strong><p class="lista1">¿Podria indicarme Cual seria el motivo por el cual No Acepta la contratacion?.</strong><br>
                                        <strong>Entiendo!</strong> Nos contactaremos con su ejecutivo para que le entregue la información y posteriormente volveremos a realizar el llamado de Validación para completar su solicitud de contratación. <br>
                                        <p class="lista1"> En nombre de <strong>METLIFE CHILE SEGUROS DE VIDA SA</strong>, agradecemos su atención y que tenga un buen día, <strong>MUCHAS GRACIAS..</strong></p>
                                    </div>
                                    <div id="SI-Acep">
                                        <p class="lista1">"Su solicitud de contratación será enviada a MetLife para que sea evaluado e 
                                        ingresado y dentro de los próximos 10 días hábiles recibirá la póliza en su correo " <strong>{{$resp->email}} </strong>.</p>                                       
                                        <p class="lista1"> En nombre de <strong>METLIFE CHILE SEGUROS DE VIDA SA</strong>, agradecemos su atención y que tenga un buen día, <strong>MUCHAS GRACIAS..</strong></p>
                                    </div>
                                    <script>
                                        $(document).on('change', '#exampleRadios1', function(){
                                            var id=$(this).val();
                                            if (id==1){
                                                $("#NO-Acep").hide();
                                                $("#SI-Acep").show();    
                                                }else{
                                                $("#NO-Acep").show();
                                                $("#SI-Acep").hide(); 
                                            }     
                                        });
                                    </script> 
                            </div>                          
                            <div class="tab-pane fade" id="tab2" role="tabpanel">                                                         
                                <!-- Datos Personales 1 -->
                                    <div class="row">
                                        <div class="col-sm-12" id="datosp">
                                            <div class="row">                                                   
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Rut                                             
                                                        </label>
                                                        <input id="rutcar" name ="rutcar" class="form-control"  value="{{$resp->rutcar}}" disabled/>                                                            
                                                    </div>
                                                </div>   
                                                <div class="col-md-1">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            DvRut                                             
                                                        </label>
                                                        <input id="dvcar" name ="dvcar" class="form-control"  value="{{$resp->dvcar}}"disabled />                                                            
                                                    </div>
                                                </div>                                                
                                                <div class="col-md-3">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Nombres                                                    
                                                        </label>
                                                        <input id="nom" name ="nom" class="form-control"  value="{{$resp->nom}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Apellido Paterno                                                     
                                                        </label>
                                                        <input id="pat"name ="pat" class="form-control"  value="{{$resp->pat}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Apellido Materno                                                     
                                                        </label>
                                                        <input id="mat" name ="mat" name="Pruebaxxxxx" class="form-control"  value="{{$resp->mat}}"  disabled/>                                                            
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
                                                        <input id="email" name="email" class="form-control"  value="{{$resp->email}}" disabled/>                                                            
                                                    </div>
                                                </div>                                                
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Telefono                                                    
                                                        </label>
                                                        <input id="telf" name ="telf" class="form-control"  value="{{$resp->telf}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">                                                      
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Fecha Nacimiento                                                     
                                                        </label>
                                                        <input name ="nac" type="text" class="form-control datepicker" placeholder="Fecha" value="{{date('d-m-Y', strtotime($resp->fnac))}}" disabled/>                                                            
                                                    </div>                                                                                                                                                     
                                                </div>    
                                                <!-- Select sexo -->
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Sexo</label>
                                                        <select class="form-control" id="sel02" name ="ssexo" disabled>
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
                                                        <select class="form-control" id="sel04"name ="sisapre" disabled>
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
                                                        <input id="peso" name ="peso" class="form-control" value="{{$resp->peso}}" disabled/>                                                            
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
                                                        <input id="estat" name ="estat" class="form-control" value="{{$resp->estat}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-1">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            IMC                                                     
                                                        </label>
                                                        <input id="imc" name ="imc" class="form-control" value="{{$resp->imc}}"disabled />                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Direccion                                                     
                                                        </label>
                                                        <input id="dir" name ="dirt" class="form-control" value="{{$resp->dir}}" disabled/>                                                            
                                                    </div>
                                                </div>                                               
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Comuna                                                     
                                                        </label>
                                                        <input id="comuna" name ="comuna" class="form-control" value="{{$resp->comunas}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Ciudad                                                     
                                                        </label>
                                                        <input id="ciudad" name ="ciudad" class="form-control" value="{{$resp->ciudad}}" disabled/>                                                            
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
                                                        <input id="clinica" name ="clinica" class="form-control" value="{{$resp->clinica}}" disabled/>                                                            
                                                    </div>
                                                </div>  
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Poliza                                                     
                                                        </label>
                                                        <input id="poliza" name ="poliza"class="form-control" value="{{$resp->poliza}}" disabled/>                                                            
                                                    </div>
                                                </div>                                               
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            LLave                                                     
                                                        </label>
                                                        <input id="llave" name ="llave" class="form-control"  value="{{$resp->llave}}" disabled/>                                                            
                                                    </div>
                                                </div>                                                    
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Plan</label>
                                                        <select class="form-control" id="sel01" name ="splan" disabled>
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
                                                        <input  id="uf" name ="uf" class="form-control"  value="{{$resp->uf}}" disabled/>                                                            
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Propuesta                                                     
                                                        </label>
                                                        <input  id="propuesta" name ="propuesta" class="form-control"  value="{{$resp->propuesta}}" disabled />                                                            
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
                                                        <input id="obs"  name ="pre" class="form-control" value="{{$resp->obs}}" disabled />                                                                                             
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
                                                        <select class="form-control" id="sel03" name="sbanco" disabled>
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
                                                        <input id="nrocta" name="nrocta" class="form-control" value="{{$resp->nrocta}}" disabled/>                                                                                              
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Rut Pagador                                                   
                                                        </label>                                  
                                                        <input id="rutter" name="rutter" class="form-control" value="{{$resp->rutter}}" disabled/>                                                                                              
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            DvTer                                             
                                                        </label>
                                                        <input id="dvter" name="dvter" class="form-control" name="dir" value="{{$resp->dvter}}" disabled/>                                                            
                                                    </div>
                                                </div>  
                                                <div class="col-md-4">
                                                    <div class="form-group has-label">
                                                        <label>
                                                            Pagador                                                    
                                                        </label>                                  
                                                        <input id="nomter" name="nomter" class="form-control"value="{{$resp->nombreter}}" disabled/>                                                                                              
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
                                                    <input id="montodep" name="montodep" name ="montodep"class="form-control" value="{{$resp->totaldep}}" disabled/>                                                                                               
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Fecha Dep                                                     
                                                    </label>                                    
                                                    <input id="fechadep" name ="fechadep" class="form-control" value="{{$resp->fechadep}}" disabled/>                                                                                               
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Fecha Vta                                                     
                                                    </label>                                    
                                                    <input id="fechavta" name ="fechavta"class="form-control" value="{{$resp->fechavta}}" disabled/>                                                                                               
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Ejecutivo                                                    
                                                    </label>                                    
                                                    <input id="ejec" name ="ejec" class="form-control" value="{{$resp->ejecutivo}}" disabled/>                                                                                               
                                                </div>
                                            </div>   
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Supervisor                                                    
                                                    </label>                                    
                                                    <input id="super" name ="super" class="form-control" value="{{$resp->supervisor}}" disabled/>                                                                                               
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        fecha-imp                                                    
                                                    </label>                                    
                                                    <input id="super" name ="super" class="form-control" value="{{date('d-m-Y', strtotime($resp->created_at))}}" disabled/>                                                                                               
                                                </div>
                                            </div>                                                                             
                                        </div>  
                                    </div>   
                                </div>     
                            </div>                                
                            <div class="tab-pane fade" id="tab3" role="tabpanel">   
                                <!-- Gestion  -->                   
                                    <div class="row">                   
                                        <div class="col-sm-6">
                                        
                                            <label for="exampleFormControlSelect1">Gestion</label>
                                            @if($resp->gtcall == 5)
                                            <select class="form-control" id="sel05" name="gestion" disabled>
                                            @else
                                            <select class="form-control" id="sel05" name="gestion">
                                            @endif
                                                <option value="" selected disabled>Seleccione Gestion</option>                            
                                                <option value=5>BUENA VENTA</option>
                                                <option value=6>VOLVER A LLAMAR</option> 
                                                <option value=7>NO CONTACTADO</option> 
                                                <option value=8>RECHAZA CONTRATACION</option> 
                                                <option value=9>RENUNCIA</option> 
                                                <option value=4>SIN GESTION</option>                                                                             
                                            </select>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="exampleFormControlSelect1">Tipificacion</label>
                                            <select class="form-control" id="sel06" name="tipif">
                                                <option value="" selected >Seleccione Tipificacion</option>                             
                                                <option value=4>APAGADO</option>  
                                                <option value=5>WHATSAPP</option>                        
                                                <option value=6>RESPUESTA NEGATIVA EN LLAMADA</option>
                                                <option value=7>OTROS</option> 
                                                <option value=11>NO CONTESTA</option>
                                                <option value=12>NUMERO NO EXISTE</option>                                                                                                                      
                                            </select>
                                        </div>                  
                                    </div> 
                                    <div class="row">                   
                                        <div class="col-sm-6">
                                            <label for="exampleFormControlSelect1">Ejecutiva</label>
                                            <select class="form-control" disabled  id="ejec01" name="ejec01">
                                                <option value="" selected disabled>Seleccione Ejecutiva</option>                            
                                                <option value=14>ANA LINARES</option>
                                                <option value=15>DESIREE AGUILERA</option> 
                                                <option value=16>MASSIEL MADUEÑO</option>                                                                                                                            
                                            </select>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" id="chk-eje" name="chk-eje"  type="checkbox" value=1>
                                                        <span class="form-check-sign"></span>
                                                        Asignar Ejecutiva
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                <!-- Observaciones y opciones -->
                                <div class="row">                            
                                    <div class="col-sm-12">                                                      
                                        <label for="observa">Observaciones</label> 
                                        <div class="form-group">
                                            <textarea class="form-control" id="observa" name="observa" rows="10" placeholder="Observaciones" style="height: 150px;">{{$resp->observaciones}} </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-sm-4 col-sm-offset-1 checkbox-radios"> -->
                                    <div class="col-sm-5 checkbox-radios">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="chkemail" id="chkemail" type="checkbox" value=1>
                                                <span class="form-check-sign"></span>
                                                Gestion Supervisor
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="chkedit" id="chkedit" type="checkbox" value=1>
                                                <span class="form-check-sign"></span>
                                                Edicion de datos
                                            </label>
                                        </div> 
                                    </div> 
                                    <div class="col-sm-5 checkbox-radios">
                                        <div class="form-check">
                                            <label class="form-check-label">                                            
                                                <input type="number" id="quantity" name="quantity" min="0" max="15" style="width: 60px; border:  0;" value = "{{$resp->is_adic}}">
                                                Gestion Adicional: 
                                            </label>                                            
                                        </div>                                                                           
                                    </div>
                                </div>
                            </div> 
                            <!-- Mensaje de Whatsapp -->
                            <div class="tab-pane fade" id="tab4" role="tabpanel">
                            @php                          
                                                    $edad = Carbon\Carbon::parse($resp->fnac)->diff(Carbon\Carbon::now())->format("%y");                      
                                                @endphp 
                                <div class="row">
                                    <div class="col-sm-12" id="datosp">
                                        <div class="row">                                                   
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Telf                                            
                                                    </label>
                                                    <input id="telfwh" name ="telfwh" class="form-control"  value="{{$resp->telf}}" disabled/>                                                            
                                                </div>
                                            </div>   
                                            <div class="col-md-4">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Asegurado                                            
                                                    </label>
                                                    <input id="namewh" name ="namewh" class="form-control"  value="{{$resp->nom}} {{$resp->pat}} {{$resp->mat}} "disabled />                                                            
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Edad                                            
                                                    </label>
                                                    <input id="namewh" name ="namewh" class="form-control"  value="{{$edad}} "disabled />                                                            
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-label">
                                                    <label>
                                                        Pagador                                            
                                                    </label>
                                                    <input id="namewh" name ="namewh" class="form-control"  value="{{$resp->nombreter}} "disabled />                                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">                            
                                            <div class="col-sm-12">                                                         
                                                <label for="observa">Mensaje</label> 
                                                <div class="form-group">                                                                                      
                                                    <p id="msjewapp">https://api.whatsapp.com/send?phone=56{{$resp->telf}}&text="Hola @if($resp->sex == 'F') Don@ @else Don @endif @if($edad>=18) {{$resp->nom}} @else {{ $resp->nombreter }} @endif, gusto en @if($resp->sex == 'F') saludarlo@ @else saludarlo @endif.%0A
                                                    Nos estamos comunicando del área de calidad y auditoria de Unificados, para realizar la verificación de la reciente contratación del 
                                                    Seguro de Salud @if($edad < 18) de {{$resp->nom}} {{$resp->pat}} @endif con la clínica {{$resp->clinica}} , debido a que no ha sido posible contactarlo telefonicamente. %0A<br>
                                                    Si es correcta la contratación, favor contactarse dentro de las próximas 48 horas al siguiente número: 227120316, para validar su solicitud, o indiquemos por este medio el horario que pueda recibir nuestra llamada para realizar la confirmacion. %0A<br>
                                                    Nuestros Horarios de Atención son de:  lunes a viernes de 9:00 am a las 18:00 pm horas %0A<br>
                                                    Agradeciendo su tiempo, Saludos"</p>
                                                </div>
                                                <hr>
                                                <button type="button" class="btn btn-success btn-wd btn-finish pull-left" onclick="f_copiar()">Copiar</button>                                            
                                            </div>                                 
                                        </div>
                                    </div> 
                                </div>      
                            </div>
                        @endforeach             
                    </div>
                </div>
            </form> 
            <div class="card-footer text-center">
                <a href="{{ route('call')}}" class="btn btn-info btn-wd btn-back pull-left" >Atras</a>                 
                @if($resp->gtcall == 5)
                    <button type="button" class="btn btn-default btn-wd btn-finish pull-right" onclick="f_grabar()" disabled>Grabar</button>
                @else
                    <button type="button" class="btn btn-warning btn-wd btn-finish pull-right" onclick="f_grabar()">Grabar</button>
                @endif                  
            </div>
        </div>                                         
    </div>                  
@endsection
@endauth

<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<!-- Para asignar otra ejecutiva -->
<script>
    $(document).ready(function() {
        $('#chk-eje').click(function(){
        if (this.checked) {
            document.getElementById('ejec01').disabled = false;          
        }else         
            document.getElementById('ejec01').disabled = true;
        });
    });
</script>

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
        const migt = "<?php echo $resp->gtcall ?>";
        if(migt == "") {           
            $('#sel05').val('4').prop('selected', true);         
        } else {
            $('#sel05').val(migt).prop('selected', true);
        }        
        // Tipificacion
        const mitp = "<?php echo $resp->tpcall ?>";
        $('#sel06').val(mitp).prop('selected', true);

         // email
         const miemail = "<?php echo $resp->is_mail ?>";
         if(miemail == 1) {             
            $("#chkemail").prop("checked", true);
         } else {
            $("#chkemail").prop("checked", false);
         }  
           // Edicion de datos
           const miedit = "<?php echo $resp->is_edit ?>";
         if(miedit == 1) {             
            $("#chkedit").prop("checked", true);
         } else {
            $("#chkedit").prop("checked", false);
         }   
           // Gestion adicional
         const miadic= "<?php echo $resp->is_adic ?>";
                
            $("#quantity").value(miadic);
         

    });
</script>
<!-- Funcion Grabar -->
<script>
    function f_grabar() {  
        swal({
            title: "Estas Seguro de Grabar la gestion?",
            text: "Gestion de Llamadas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Actualizado!", "Tu gestion fue grabada.", "success");
              document.formedit.submit() 
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>

<!-- Copiar Mensaje de Whatsapp -->

<script>
    function f_copiar() {
        var codigoACopiar = document.getElementById('msjewapp');
        var seleccion = document.createRange();
        seleccion.selectNodeContents(codigoACopiar);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(seleccion);
        var res = document.execCommand('copy');
        window.getSelection().removeRange(seleccion);
        swal("Mensaje Copiado!", "Mensaje en Porta Papeles!", "success")
    }
</script>

<style>

button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}

.nav-item>a:hover {
    color: white; */
    background-color: #97e6eb;
}
       

#nav1c:hover,#nav2c:hover,#nav3c:hover,#nav4c:hover {
  background-color: orange;
  color: #000000;
}

#msjewapp {
    font-size: 14px;
}
       
#pgrabar {

    text-align:center;
    font-size: 12px;

}
#pscript, #tetxp, .lista1 {
    font-size: 12px;
}

#tebla1 {
    font-size: 12px;
}
</style>