@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="get" id="formedit" name="formedit" action="{{ route('buscarclinics') }}">  
                {{ csrf_field() }}                      
                <div class="form-group"> 
                    <div class="row">
                    <div class="col-5">
                        <select class="form-control" id="select-1" name="select1" required>
                            <option value=""disabled selected>Seleccione opcion</option>
                            <option value="rut">Rut</option>               
                            <option value="propuesta">Propuesta</option>
                            <option value="telf">Telefono</option>
                            <option value="email">email</option>
                            <option value="nrocta">N° Cuenta</option>
                            <option value="ejecutivo">Ejecutivo</option>
                            <option value="supervisor">Supervisor</option> 
                        </select>
                    </div>
                    <div class="col-5">              
                        <input type="text" class="form-control" id="input-id-1"  name="buscar" placeholder="Ingrese datos a buscar" required> 
                    </div> 
                    <div class="col-2">  
                        <button type="submit" class="btn btn-fill btn-info" id="button">Buscar Propuesta</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(isset($propuestas))
    <div class="col-md-12">
        <div class="card ">                                
            <div class="card-body ">            
                <form method="POST" id="formedit" name="formedit" action="">  
                    {{ csrf_field() }}   
                    @if($Nroprop > 0)                 
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;"></th>
                                    <th  class="text-center" style="font-size: 10px;" colspan="2">Gestion de Auditoria</th>
                                    <th  class="text-center" style="font-size: 10px;" colspan="2">Gestion de LLamadas</th>
                                    <th  class="text-center" style="font-size: 10px;"></th>                                   
                                </thead>
                                <thead>
                                    <th  style="font-size: 10px;">id</th>
                                    <th  class="text-center" style="font-size: 10px;">Clinica</th>
                                    <th  style="font-size: 10px;">Periodo</th>
                                    <th  style="font-size: 10px;">Rut</th>
                                    <th  style="font-size: 10px;">Asegurado</th>
                                    <th  style="font-size: 10px;">Rel</th>
                                    <th  style="font-size: 10px;">Gestion</th>
                                    <th  style="font-size: 10px;">tipificacion</th>
                                    <th  style="font-size: 10px;">gtCall</th>
                                    <th  style="font-size: 10px;">tpCall</th>
                                    <th class="text-right" style="font-size: 10px;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($propuestas as $clinics)
                                        <tr>
                                            <td>{{$clinics->id}}</td>
                                            <td>{{$clinics->clinica}}</td>
                                            <td>{{$clinics->mes}}/{{$clinics->anio}}</td>
                                            <td>{{$clinics->rutcar}}</td>
                                            <td>{{$clinics->nom}} {{$clinics->pat}} {{$clinics->mat}}</td>
                                            <td>{{$clinics->rel}}</td>
                                            <td>{{$clinics->gt}}</td>
                                            <td>{{$clinics->tipif}}</td>
                                            <td>{{$clinics->gtcall}}</td>
                                            <td>{{$clinics->tpcall}}</td>
                                            <td class="text-right" style="padding: 4%;">
                                                <a href="#PlaceModal-{{$clinics->id}}" data-toggle="modal" class="btn btn-link btn-info like" id="lupa1"><i class="fa fa-search fa-xs"></i></a>
                                                @php  
                                                    $per = $clinics->mes.$clinics->anio;
                                                    $lid = $clinics->id;
                                                @endphp  
                                                    <!-- falta agregar condicion de periodo  if period = pe && cierre = 1 -->
                                                    <a href="{{ route('editpropuestas',$lid) }}" class="btn btn-link btn-warning edit"id="edit1" ><i class="fa fa-edit"></i></a> 
                                             
                                            </td>                                
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    @else
                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                        <span data-notify="message">No se Encontraron resultados con los parametros ingresados.</span>
                    </div>
                    @endif                               
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  -->
    @foreach($propuestas as $clinics)
        <div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$clinics->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#F59E36;color:#fff; border-radius: 10px 10px 0px 0px;display: table;margin-top:0px;">    
                        <div style="display: table-cell;vertical-align: middle;margin-top:0px;">     
                            @if($clinics->gestion == 2)
                                <h5  id="tit01" class="modal-title" id="myModalLabel">Detalle de Propuesta #  {{$clinics->propuesta}} / Gestion: {{$clinics->gt}} @if(!isset($clinics->tp)) - TIPIF : {{$clinics->tipif}} @endif</h5>              
                                <p></p>
                            @else
                                <h5  class="modal-title" id="myModalLabel">Detalle de Propuesta #  {{$clinics->propuesta}} / Gestion: <b> {{$clinics->gt}}</b> @if(isset($clinics->tp)) - TIPIF : {{$clinics->tipif}} @endif</h5> 
                                <P></P>              
                            @endif                                             
                        </div> 
                    </div>                
                    <div class="modal-body">                                     
                        <div class="row" id="det01">                           
                            <div class="col-sm-8" > <b>RUT-TIT :</b>  {{$clinics->ruttit}}  <b>/ RUT-CAR : </b> {{$clinics->rutcar}} <b> / ASEGURADO:</b> {{$clinics->pat}} {{$clinics->mat}} {{$clinics->nom}}</div>
                        </div>                        
                        <div class="row" id="det01">  
                            <div class="col-sm-12" ><b>FECHA NAC : </b> {{date('d-m-Y', strtotime($clinics->fnac))}}<b> / TELEF :</b>  {{$clinics->telf}} <b> / E-MAIL :</b> {{$clinics->email}} </div> 
                        </div> 
                         <hr>                       
                        <div class="row" id="det01">  
                            <div class="col-sm-12" ><b>CLINICA : </b> {{$clinics->clinica}} [{{$clinics->poliza}}] <b> / MOV :</b> {{$clinics->mov}} {{$clinics->tipo}} <b> / PERIODO : </b>{{$clinics->mes}} {{$clinics->anio}} <b> / UF : </b>{{$clinics->uf}}</div> 
                        </div>                   
                        <div class="row" id="det01">
                            <div class="col-sm-12" ><b>PRE-EXISTENCIAS :</b> @if(isset($clinics->obs)) SIN PRE-EXISTENCIAS DECLARADAS @else {{$clinics->obs}} @endif </div>
                        </div>                     
                        <div class="row" id="det01">                            
                            <div class="col-sm-12" ><b>PAGADOR : </b> @if(empty($clinics->nombreter)) TITULAR @else {{$clinics->nombreter}} @endif <b>/ BANCO :</b> {{$clinics->bank}} <b>/ NRO CTA :</b> {{$clinics->nrocta}} </div>                      
                        </div>                 
                        <div class="row" id="det01">
                            <div class="col-sm-12" > <b>FECHA DE VENTA : </b> {{date('d-m-Y', strtotime($clinics->fechavta))}}<b> / EJECUT VENTAS :</b> {{$clinics->ejecutiva}} <b>/ SUPERVISOR :</b> {{$clinics->supervisor}} </div>
                        </div> 
                        <hr>  
                        <div class="row" id="det01">
                            <div class="col-sm-12" > <b> OBSERVACIONES : </b> @if($clinics->observaciones == '') S/OBSERVACIONES @else {{$clinics->observaciones}}@endif</div>
                        </div>                       
                        @if($Nrocar > 0)  
                        <hr>                               
                            <div class="accordions" id="accordion">
                                
                                <div class="card">                                  
                                    <div class="card-header">                          
                                        <h5 class="card-title">
                                            <a data-target="#c01-{{$clinics->id}}" href="#" data-toggle="collapse" id="a01" id="a-{{$clinics->id}}">
                                                <label for="">Adicionales : {{$Nrocar}}</label>
                                                <b class="caret"></b>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="c01-{{$clinics->id}}" class="card-collapse collapse">                
                                        <table class="table table-hover">
                                            <thead>
                                                <th style="font-size:10px;">Propuesta</th>                                               
                                                <th style="font-size:10px;">Rut</th>
                                                <th style="font-size:10px;">Asegurado</th>
                                                <th style="font-size:10px;">Rel</th>
                                                <th style="font-size:10px;">Fecha Nac</th>                          
                                            </thead>
                                            <tbody>
                                                @foreach($adicionales as $adic)
                                                    <tr>     
                                                        <td>{{$adic->propuesta}}</td>                              
                                                        <td>{{$adic->rutcar}}</td>
                                                        <td>{{$adic->nom}} {{$adic->pat}} {{$adic->mat}}</td>
                                                        <td>{{$adic->rel}}</td>
                                                        <td>{{date('d-m-Y', strtotime($clinics->fnac))}} </td> 
                                                        <td></td>                                                              
                                                    </tr>
                                                @endforeach
                                            </tbody>                        
                                        </table> 
                                    </div>
                                </div>
                            </div>                  
                        @endif             
                    </div>                  
                    <div class="card-footer">                   
                        <button type="button" class="btn btn-fill btn-info" data-dismiss="modal" id="button">Cerrar</button>
                    </div>                
                </div>
            </div>
        </div> 
    @endforeach
@endif

<style>
    table td {
        font-size:8px;
    }

    #edit1,#lupa1 {
        padding: 0px;
        max-width: 20px;
    }

    .modal {
        font-size:10px;
    }
    #button {
        position: relative;
        float: right;
    }


  

 </style>
@endsection
@endauth
