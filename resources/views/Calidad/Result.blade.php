@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card card-stats">
        <div class="card card-plain table-plain-bg">
            <div class="card-header ">
                <h5 class="card-title">Busqueda: {{ $lbuscar }} </h5>
                <p class="card-category">Se realizo la busqueda por : {{ strtoupper($lopcion) }} </p>
            </div>
            @if($PropCount > 0)
            <div class="card-body">         
                <a href="{{ route('excel',array('lopcion' =>$lopcion,'lbuscar' =>$lbuscar)) }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>  
            </div>            
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover" id="tb01">
                    <thead>                                             
                        <th data-field="id" class="text-center">Clinica</th>
                        <th data-field="name" data-sortable="true">Periodo</th>
                        <th data-field="salary" data-sortable="true">Rut</th>
                        <th data-field="country" data-sortable="true">Asegurado</th>
                        <th data-field="city">Rel</th>
                        <th data-field="gt">Gestion</th>
                        <th data-field="gt">tipif</th>
                        <th data-field="gt">gtCall</th>
                        <th data-field="gt">tpCall</th>
                        <th class="text-right">Acciones</th>
                    </thead>
                    <tbody>
                    @csrf                
                    @foreach($propuestas as $resp) 
                        @php
                            $pe = $resp->mes.$resp->anio;                                      
                        @endphp
                        @if($resp->gestion == 2)      
                            <tr bgcolor=" #fbeee6 ">    
                        @else    
                            <tr>  
                        @endif                                             
                            <td>{!! $resp->clinica !!}</td>
                            @if($period == $pe && $patst == 1)
                            <td style="color: #fa1313 ">{!! $resp->mes !!} / {!! $resp->anio !!}</td>
                            @else
                            <td>{!! $resp->mes !!} / {!! $resp->anio !!}</td>
                            @endif
                            <td>{!! $resp->rutcar !!}</td>
                            <td>{!! $resp->nom !!} {!! $resp->pat !!}  {!! $resp->mat !!}</td>
                            <td>{!! $resp->rel !!}</td>
                            @if($resp->rel == 'AS') 
                                <td>{!! $resp->gt !!}</td>
                                <td>{!! $resp->tipif !!}</td>   
                                <td>{!! $resp->gtcall !!}</td>     
                                <td>{!! $resp->tpcall !!}</td>                                                                                                                     
                                <td class="text-right">
                                    <a href="#PlaceModal-{{$resp->id}}" data-toggle="modal" class="btn btn-link btn-info like"><i class="fa fa-search"></i></a>
                                   
                                    @if($period == $pe && $patst == 1) 
                                    @php
                                        $ldid = $resp->id;
                                    @endphp
                                    <a href="{{ route('editp',$ldid) }}" class="btn btn-link btn-warning edit"><i class="fa fa-edit"></i></a>
                                    <!-- <a href="#" class="btn btn-link btn-danger remove"><i class="fa fa-times"></i></a> -->
                                    @endif
                                </td>
                            @else
                                <td></td> 
                                <td></td>                                               
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="col-md-12"> 
            <br>                         
                <div class="alert alert-warning alert-with-icon" data-notify="container">                       
                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                    <span data-notify="message">NO se encontraron Coincidencias.</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@foreach($propuestas as $resp)
<div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">           
                @if($resp->gestion == 2)
                <h5  id="tit01" class="modal-title" id="myModalLabel"> Detalle de Propuesta #  {{$resp->propuesta}} / Gestion: {{$resp->gt}} </h5>
                @else
                <h5  class="modal-title" id="myModalLabel"> Detalle de Propuesta #  {{$resp->propuesta}} / Gestion: {{$resp->gt}} </h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>               
            </div>
            <div class="modal-body">            
                <div class="row" id="det01">                           
                    <div class="col-sm-8" >Rut-Tit : {{$resp->ruttit}}  /  Rut-Car : {{$resp->rutcar}}</div>
                </div>
                <div class="row" id="det01">
                    <div class="col-sm-8" >Nombre : {{$resp->pat}} {{$resp->mat}} {{$resp->nom}}</div>                           
                </div> 
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Fecha Nac : {{date('d-m-Y', strtotime($resp->fnac))}}</div> 
                </div>                          
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Clinica : {{$resp->clinica}} / Mov : {{$resp->mov}} {{$resp->tipo}} {{$resp->mes}} {{$resp->anio}}</div> 
                </div>              
                <div class="row" id="det01">                             
                    <div class="col-sm-6" >Telefono : {{$resp->telf}}  /  e-mail : {{$resp->email}}</div>
                </div>                 
                <div class="row" id="det01">
                    <div class="col-sm-12" >Pre-existencias: {{$resp->obs}} </div>
                </div>            
                <hr>
                <div class="row" id="det01">
                    @if(empty($resp->nombreter)) 
                        <div class="col-sm-12" >Pagador : 'TITULAR'  / Banco : {{$resp->bank}}  -  N° Cta: {{$resp->nrocta}} </div>
                    @else
                        <div class="col-sm-12" >Pagador : {{$resp->nombreter}}  /  Banco : {{$resp->bank}}   -   N° Cta: {{$resp->nrocta}} </div>
                    @endif
                </div>               
                <hr>
                <div class="row" id="det01">
                    <div class="col-sm-12" > Fecha Vta: {{date('d-m-Y', strtotime($resp->fechavta))}} /  Ejecutiva de Ventas : {{$resp->ejecutiva}} / Supervisor: {{$resp->supervisor}} </div>
                </div> 
                <hr>  
                <div class="row" id="det01">
                    <div class="col-sm-12" > Observaciones: {{$resp->observaciones}}</div>
                </div> 
                <hr>                
                @if($Nrocar > 0)           
                <div class="card-body" >
                    <div class="accordions" id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a data-target="#c01-{{$resp->id}}" href="#" data-toggle="collapse" id="a01" id="a-{{$resp->id}}">
                                        Adicionales: {{$Nrocar}}
                                        <b class="caret"></b>
                                    </a>
                                </h5>
                            </div>
                            <div id="c01-{{$resp->id}}" class="card-collapse collapse">
                                <div class="card-body">
                                    <table class="table table-hover" id="tb01">
                                        <thead>
                                            <th data-field="name" data-sortable="true">Adicional</th>
                                            <th data-field="salary" data-sortable="true">Rut</th>
                                            <th data-field="salary" data-sortable="true">Propuesta</th>
                                            <th data-field="salary" data-sortable="true">Periodo</th>                                      
                                        </thead>
                                        <tbody>
                                            @foreach($adicionales as $resp2)
                                                <tr>
                                                    <td>{{$resp2->pat}} {{$resp2->mat}} {{$resp2->nom}}</td>
                                                    <td>{!! $resp2->rutcar !!}</td>
                                                    <td>{!! $resp2->propuesta !!}</td> 
                                                    <td>{!! $resp2->mes !!} / {!! $resp2->anio !!}</td>                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{ route('pdfmail',array('idx' =>$resp->id,'lbuscar' =>$lbuscar,'lopcion' =>$lopcion)) }}" class="btn btn-warning" target="_blank" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Pdf</a>  
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>             
            </div>
        </div>
    </div>
</div>     
@endforeach
@endsection
@endauth

<style>
td {
  font-size: 11px;
 
}

.modal {
    font-size: 12px;
}

#tit01 {
    color: red;
}

#a01 {
    font-size: 12px;
    color: grey; 
}
</style>