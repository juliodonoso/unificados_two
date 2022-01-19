@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="">  
                {{ csrf_field() }}   
                <div class="card-header ">
                    <h5 class="card-title">Parametro buscado: {{$lbuscar}}</h5>
                    <p class="card-category">Busqueda realizada por: {{strtoupper($lopcion)}}</p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover">
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
                            @foreach($propuestas as $clinics)
                                <tr>
                                    <td>{{$clinics->clinica}}</td>
                                    <td>{{$clinics->mes}}/{{$clinics->anio}}</td>
                                    <td>{{$clinics->rutcar}}</td>
                                    <td>{{$clinics->nom}} {{$clinics->pat}} {{$clinics->mat}}</td>
                                    <td>{{$clinics->rel}}</td>
                                    <td>{{$clinics->gt}}</td>
                                    <td>{{$clinics->tipif}}</td>
                                    <td>{{$clinics->gtcall}}</td>
                                    <td>{{$clinics->tpcall}}</td>
                                    <td class="text-right">
                                        <a href="#PlaceModal-{{$clinics->id}}" data-toggle="modal" class="btn btn-link btn-info like" id="lupa1"><i class="fa fa-search"></i></a>                               
                                        <a href="" class="btn btn-link btn-warning edit"id="edit1" ><i class="fa fa-edit"></i></a> 
                                   </td>                                
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>                               
            </form>
        </div>
    </div>
</div>
<!-- Modal  -->
@foreach($propuestas as $clinics)
<div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$clinics->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">           
                @if($clinics->gestion == 2)
                    <h5  id="tit01" class="modal-title" id="myModalLabel">Detalle de Propuesta #  {{$clinics->propuesta}} / Gestion: {{$clinics->gt}} </h5>              
                @else
                    <h5  class="modal-title" id="myModalLabel">Detalle de Propuesta #  {{$clinics->propuesta}} / Gestion: {{$clinics->gt}} </h5>               
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>               
            </div>
            <div class="modal-body">            
                <div class="row" id="det01">                           
                    <div class="col-sm-8" >Rut-Tit : {{$clinics->ruttit}}  /  Rut-Car : {{$clinics->rutcar}}</div>
                </div>
                <div class="row" id="det01">
                    <div class="col-sm-8" >Nombre : {{$clinics->pat}} {{$clinics->mat}} {{$clinics->nom}}</div>                           
                </div> 
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Fecha Nac : {{date('d-m-Y', strtotime($clinics->fnac))}}</div> 
                </div>                          
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Clinica : {{$clinics->clinica}} / Mov : {{$clinics->mov}} {{$clinics->tipo}} {{$clinics->mes}} {{$clinics->anio}}</div> 
                </div>              
                <div class="row" id="det01">                             
                    <div class="col-sm-6" >Telefono : {{$clinics->telf}}  /  e-mail : {{$clinics->email}}</div>
                </div>                 
                <div class="row" id="det01">
                    <div class="col-sm-12" >Pre-existencias: {{$clinics->obs}} </div>
                </div>            
                <hr>
                <div class="row" id="det01">
                    @if(empty($clinics->nombreter)) 
                        <div class="col-sm-12" >Pagador : 'TITULAR'  / Banco : {{$clinics->bank}}  -  N° Cta: {{$clinics->nrocta}} </div>
                    @else
                        <div class="col-sm-12" >Pagador : {{$clinics->nombreter}}  /  Banco : {{$clinics->bank}}   -   N° Cta: {{$clinics->nrocta}} </div>
                    @endif
                </div>               
                <hr>
                <div class="row" id="det01">
                    <div class="col-sm-12" > Fecha Vta: {{date('d-m-Y', strtotime($clinics->fechavta))}} /  Ejecutiva de Ventas : {{$clinics->ejecutiva}} / Supervisor: {{$clinics->supervisor}} </div>
                </div> 
                <hr>  
                <div class="row" id="det01">
                    <div class="col-sm-12" > Observaciones: @if($clinics->observaciones == '') S/OBSERVACIONES @else {{$clinics->observaciones}}@endif</div>
                </div> 
                <hr>
                @if($Nrocar > 0)                                 
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
                                        <th style="font-size:10px;">Rut</th>
                                        <th style="font-size:10px;">Asegurado</th>
                                        <th style="font-size:10px;">Rel</th>
                                        <th style="font-size:10px;">Fecha Nac</th>                          
                                    </thead>
                                    <tbody>
                                        @foreach($adicionales as $adic)
                                            <tr>                                   
                                                <td>{{$adic->rutcar}}</td>
                                                <td>{{$adic->nom}} {{$adic->pat}} {{$adic->mat}}</td>
                                                <td>{{$adic->rel}}</td>
                                                <td>{{date('d-m-Y', strtotime($clinics->fnac))}} </td>                                                               
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
<style>
    table td {
        font-size:10px;
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
