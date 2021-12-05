@extends('layouts.menu')
@auth
@section('content')
    <div class="col-md-12">
        <div class="card ">                                
            <div class="card-body ">            
                <form method="POST" id="formedit" name="formedit" action="{{ route('concept') }}">  
                    {{ csrf_field() }} 
                    <div class="card-body"> 
                        <div class="row"> 
                            <div class="col-sm-6">                         
                                <select multiple data-title="Seleccione los Años"  id="anio"  name="anio[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                                    <option value=2021>2021</option>
                                    <option value=2022>2022</option> 
                                    <option value=2023>2023</option>
                                    <option value=2024>2024</option>
                                    <option value=2025>2025</option>                                                                                                     
                                </select>                            
                            </div>                  
                            <div class="col-sm-6">                           
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
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-sm-12" id="fechas">               
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="title">Fecha Desde</label>
                                        <div class="form-group">
                                            <input type="text" id="datetimepicker" class="form-control datepicker" placeholder="Date Picker Here" name="fdesde"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="title">Fecha Hasta</label>
                                        <div class="form-group">
                                            <input type="text" id="datepicker" class="form-control datepicker" placeholder="Date Picker Here" name="fhasta" />
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6">                        
                                <select multiple data-title="Seleccione los Sponsor"  id="sponsor"  name="sponsor[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                                    @foreach($sponsor as $select)
                                        <option value="{{ $select->id }}">{{ $select->name }}</option>
                                    @endforeach                                                                                              
                                </select>                         
                            </div>                  
                            <div class="col-sm-6">                          
                                <select multiple data-title="Seleccione las Campañas"  id="cia"  name="cia[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
                                    @foreach($cia as $select3)
                                        <option value="{{ $select3->id }}">{{ $select3->name }}</option>
                                    @endforeach                                                                                                       
                                </select>                         
                            </div>                        
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6">                            
                                <select multiple data-title="Seleccione Canal"  id="canal"  name="canal[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                                    @foreach($canal as $select2)
                                        <option value="{{ $select2->id }}">{{ $select2->name }}</option>
                                    @endforeach                                                                                             
                                </select>                            
                            </div>                  
                            <div class="col-sm-6">                            
                                <select multiple data-title="Seleccione Operador"  id="oper"  name="oper[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
                                    @foreach($teleop as $select4)
                                        <option value="{{ $select4->id }}">{{ $select4->name }}</option>
                                    @endforeach                                                                                                         
                                </select>                         
                            </div>                        
                        </div>
                        <div class="row"> 
                            @if( $emp_type <> 8)
                                <div class="col-sm-6">                          
                                    <select multiple data-title="Seleccione Ejecutivo"  id="ejecut"  name="ejecut[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                                        @foreach($usuarios as $select5)
                                            <option value="{{ $select5->id }}">{{ $select5->name }}</option>
                                        @endforeach                                                                                            
                                    </select>                        
                                </div> 
                            @endif                 
                            <div class="col-sm-6">                           
                                <select multiple data-title="Seleccione Estado"  id="estado"  name="estado[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
                                    <option value="ALERTA">ALERTA</option>
                                    <option value="CUMPLE">CUMPLE</option>                                                                                                        
                                </select>                            
                            </div>                        
                        </div>                   
                        <div class="row">                            
                            <div class="col-sm-4">                          
                                <select multiple data-title="Seleccione Resolucion BECS"  id="resol"  name="resol[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                                    @foreach($resolbecs as $select6)
                                        <option value="{{ $select6->id }}">{{ $select6->name }}</option>
                                    @endforeach                                                                                            
                                </select>                        
                            </div>                                        
                            <div class="col-sm-4">                           
                                <select multiple data-title="Seleccione Accion BECS"  id="acciones"  name="acciones[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
                                    @foreach($accbecs as $select7)
                                        <option value="{{ $select7->id }}">{{ $select7->name }}</option>
                                    @endforeach                                                                                                      
                                </select>                            
                            </div> 
                            <div class="col-sm-4">                           
                                <select id="respcall"  name="respcall"  class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue"> 
                                    <option selected disabled>Seleccione opcion ...</option>                                                   
                                    <option value=1>APELACION</option>
                                    <option value=0>SIN APELACION</option>                                                                                                                                          
                                </select>                            
                            </div>                       
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr> 
                    <div class="stats">                   
                        <button type="submit" class="btn btn-fill btn-warning">Generar</button>                  
                    </div>                
                </form>
            </div>
        </div>   
    </div>
@endsection
@endauth
