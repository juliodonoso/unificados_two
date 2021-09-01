@extends('layouts.menu')
@auth
@section('content')
@php
$sep = implode(",", $larray);

@endphp
<div class="col-md-12">
<div class="card card-stats">
    <div class="card card-plain table-plain-bg">
        <div class="card-header ">
            <h5 class="card-title">Detalle de Duplicidad desde Archivo:</h5>
            <p class="card-category">Se realizo la busqueda por :{{ strtoupper($lopcion) }} </p>
        </div>
        @if($lreg >0)
            <div class="card-body">         
                <a href="{{ route('exlduplic',array('sep' =>$sep,'lbuscar' =>$lbuscar,'lopcion' =>$lopcion)) }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>             
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover" id="tb01">
                    <thead> 
                        <tr>                                          
                            <th data-field="id" class="text-center">Clinica</th>
                            <th data-field="name" data-sortable="true">Periodo</th>
                            <th data-field="salary" data-sortable="true">Rut</th>
                            <th data-field="country" data-sortable="true">Asegurado</th>
                            <th data-field="city">Rel</th>
                            <th data-field="gt">Ejecutiva</th>
                            <th data-field="gt">Sup</th>
                            <th>Det</th>
                        </tr> 
                    </thead>
                    <tbody>                        
                    @foreach($propuestas as $resp)    
                        @foreach($resp as  $resp3) 
                            @php
                                $pe = $resp3->mes.$resp3->anio;                                      
                            @endphp
                            @if($resp3->gestion == 2)      
                                <tr bgcolor="#ffeedd" data-id ="{{ $resp3->rutcar}}">    
                            @else    
                                <tr data-id ="{{ $resp3->rutcar }}">  
                            @endif                                           
                            <td>{!! $resp3->clinica !!}</td>
                            @if($period == $pe && $patst == 1)
                                <td style="color: #fa1313 ">{!! $resp3->mes !!} / {!! $resp3->anio !!}</td>
                            @else
                                <td>{!! $resp3->mes !!} / {!! $resp3->anio !!}</td>
                            @endif
                            <td>{!! $resp3->rutcar !!}</td>
                            <td>{!! $resp3->nom !!} {!! $resp3->pat !!}  {!! $resp3->mat !!}</td>
                            <td>{!! $resp3->rel !!}</td>                        
                            @if($resp3->rel == 'AS') 
                                <td>{!! $resp3->ejecutiva !!}</td> 
                                <td>{!! $resp3->supervisor !!}</td>                                                                                                                     
                                <td><a data-id="{{ $resp3->rutcar }}" class="btn-ver" id ="bview" href="#PlaceModal-{{$resp3->id}}" data-target="#PlaceModal-{{$resp3->id}}" data-toggle="modal"><i class="fa fa-search"></i></a></td>
                            @else
                                <td></td> 
                                <td></td>                                               
                            @endif
                        </tr>
                        @endforeach
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
@foreach($propuestas as $resp3)
@foreach($resp3 as  $resp)

    <div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="POST" action="{{route('filtrar')}}" id='form-{{$resp->id}}'>
        @csrf
        <input type="hidden" name="rutbq" id="rutbq" value ="" class="input_valores_provisionales">
    </form>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">                  
                    <h5  id="tit01" class="modal-title" id="myModalLabel"> Detalle de Coincidencia:  {{$resp->rutcar}} </h5>                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>               
                </div>
                @php 
                    $first = "";
                    $first = $resp->rutter;      
                           
                    $ltrue = array_key_exists($first,$larr_actual);
           
                    if($ltrue == true)  {
                        $datosc = $larr_actual[$first];               
                    };
                @endphp
                <div class="modal-body">
                    <div class="row" id="det01">                           
                        <div class="col-sm-8" >Datos Propuesta Consultada : <strong>{{$datosc}}</strong></div>
                    </div>            
                    <div class="row" id="det01">                           
                        <div class="col-sm-8" >Rut-Tit : {{$resp->ruttit}}  /  Rut-Car : {{$resp->rutcar}}</div>
                    </div>
                    <div class="row" id="det01">
                        <div class="col-sm-8" >Asegurado : {{$resp->pat}} {{$resp->mat}} {{$resp->nom}}</div>                           
                    </div> 
                    <div class="row" id="det01">  
                        <div class="col-sm-12" >Fecha Nac : {{date('d-m-Y', strtotime($resp->fnac))}}</div> 
                    </div>                   
                               
                    <!-- <table id="tablecoin"> -->
                    <table class="table table-hover" id="tablecoin" >
                        <thead>             
                            <th>Clinica</th>
                            <th>Plan</th>
                            <th>mes</th>
                            <th>año</th>
                            <th>Ejecutiv@</th> 
                            <th>Supervisor@</th> 
                            <th>rel</th> 
                            <th>FechaVta</th>             
                        </thead>
                        <tbody id="t01-{{$resp->rutcar}}">                    
                        </tbody> 
                    </table>
                    <hr>
                    <div class="row" id="det01">
                        <div class="col-sm-12" > Observaciones: {{$resp->observaciones}}</div>
                    </div> 
                    <hr>    
                    <!-- Cargas                         -->
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
                    <form class="my_form" id="my_form" name="my_form" action="{{ route('gendiario')}}" method="POST"></form>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('pdfmail',array('idx' =>$resp->id,'lbuscar' =>$lbuscar,'lopcion' =>$lopcion)) }}" class="btn btn-warning" target="_blank" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Pdf</a>  
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>               
                </div>
            </div>
        </div>
    </div> 
@endforeach    
@endforeach
@endsection
@endauth

<style>

table td {
  /* border: 1px solid #000; */
  text-align: left;
  padding: 5px;
  /* Alto de las celdas */
  height: 40px;
  font-size: 11px;
}



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

<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
                <!-- Script para Filtrar dentro del modal  -->
             
                <script>
                    $(document).ready(function() {
                        $('.btn-ver').click(function(){
                            var row = $(this).parents('tr');
                            var rut = row.data('id');  
                                        
                            $('.input_valores_provisionales').val(rut) 
                            $("#tablecoin tbody tr").remove();                                     
                            $.ajax({
                                url: "{{route('filtrar')}}",
                                method: 'POST',
                                data: $("#form-{{$resp->id}}").serialize()
                            }).done(function(res){
                                var arreglo = JSON.parse(res);                                                          
                                for (var  x = 0; x < arreglo.length; x++){
                                    var todo = '<tr><td>'+arreglo[x].clinica+'</td>';
                                    todo+='<td>'+arreglo[x].numgru+'</td>';
                                    todo+='<td>'+arreglo[x].mes+'</td>';
                                    todo+='<td>'+arreglo[x].anio+'</td>';
                                    todo+='<td>'+arreglo[x].ejecutiva+'</td>';
                                    todo+='<td>'+arreglo[x].supervisor+'</td>';
                                    todo+='<td>'+arreglo[x].rel+'</td>';
                                    todo+='<td>'+arreglo[x].fechavta+'</td>';
                                    todo+='<td></td></tr>';                            
                                    $('#t01-'+rut).append(todo);                                    
                                }                                
                                
                            });                       
                        });
                    });
                </script>